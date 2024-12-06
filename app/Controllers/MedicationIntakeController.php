<?php

namespace App\Controllers;

use App\Models\MedicationIntakeModel;
use App\Models\PatientModel;
use App\Models\PhysicianModel;
use App\Models\MedicationModel;
use App\Models\MedicationStatusModel;

use DateTime;
use DateInterval;
class MedicationIntakeController extends BaseController
{
    protected $medicationStatusModel;
    public function __construct()
    {
        helper("form");
    
        if (!session()->has('UserID')) {
            return redirect()->to('/login');
        }
    
       
    }
    public function index()
    {
        // Load models
        $medicationIntakeModel = new MedicationIntakeModel();
        $medicationModel = new MedicationModel();
        $medicationStatusModel = new MedicationStatusModel();
    
        // Fetch data with joins
        $medicationIntakes = $medicationIntakeModel
            ->select('
                medicationintake_tbl.MedicationIntakeID, 
                medicationintake_tbl.PatientID, 
                medicationintake_tbl.IntakeTimes,
                medicationintake_tbl.IntakeDates,
                medicationintake_tbl.MedicationStatus,  
                medicationintake_tbl.created_at, 
                patient_tbl.Firstname as PatientFirstname, 
                patient_tbl.Lastname as PatientLastname, 
                physician_tbl.Firstname as PhysicianFirstname, 
                physician_tbl.Lastname as PhysicianLastname,
                medicationintake_tbl.MedicationID,
                GROUP_CONCAT(medicationstatus_tbl.Remark) as Remarks
            ')
            ->join('patient_tbl', 'patient_tbl.PatientID = medicationintake_tbl.PatientID', 'left')
            ->join('physician_tbl', 'physician_tbl.PhysicianID = patient_tbl.PhysicianID', 'left')
            ->join('medicationstatus_tbl', 'medicationstatus_tbl.MedicationIntakeID = medicationintake_tbl.MedicationIntakeID', 'left')
            ->groupBy('medicationintake_tbl.MedicationIntakeID')
            ->findAll();
    
        // Current date and time
        $currentDateTime = new \DateTime();
    
        // Process fetched data
        foreach ($medicationIntakes as $intake) {
            // Process Medication IDs
            $medicationIDs = explode(',', $intake->MedicationID); // Split MedicationIDs into an array
            $intake->MedicationIDs = $medicationIDs; // Set MedicationIDs to the intake object
    
            // Fetch medications based on MedicationIDs
            $medications = $medicationModel
                ->select('MedicationID, MedicationName, Dosage')
                ->whereIn('MedicationID', $medicationIDs)
                ->findAll();
    
            // Prepare medication names
            $medicationNames = [];
            foreach ($medications as $med) {
                $medicationNames[] = $med->MedicationName . ' - ' . $med->Dosage;
            }
            $intake->Medications = implode(', ', $medicationNames);
    
            // Initialize status variables
            $dates = explode(',', $intake->IntakeDates);
            $times = explode(',', $intake->IntakeTimes);
            $status = 'Ended';  // Default to 'Ended' until proven otherwise
            $isStarted = false;
            $latestScheduledDateTime = null;
    
            // Track the status for each date-time pair
            foreach ($dates as $date) {
                foreach ($times as $time) {
                    // Format the date and time to create a DateTime object
                    $dateTimeStr = trim($date) . ' ' . trim($time);
                    $dateTime = \DateTime::createFromFormat('Y-m-d h:i A', $dateTimeStr); // Ensure the format matches
    
                    if ($dateTime === false) {
                        continue; // Skip invalid date-time entries
                    }
    
                    // Checking if current time is within the interval [+0 minutes, +10 minutes] of the scheduled time
                    $timeInterval = new \DateInterval('PT10M'); // 10 minutes interval
                    $timeAfter = (clone $dateTime)->add($timeInterval); // 10 minutes after the scheduled time
    
                    // If current time is exactly during the scheduled time (within the 10-minute window)
                    if ($currentDateTime >= $dateTime && $currentDateTime < $timeAfter) {
                        $status = 'During';
                        break 2; // Exit the loop early if "During" status is set
                    }
    
                    // If current time is beyond 10 minutes after the scheduled time, mark as 'Ended'
                    elseif ($currentDateTime >= $timeAfter) {
                        $status = 'Ended';
                    }
    
                    // If current time is before the scheduled time, mark as 'Started' (if not already started)
                    elseif ($currentDateTime < $dateTime) {
                        if (!$isStarted) {
                            $status = 'Started';
                            $isStarted = true;
                        }
                    }
    
                    // Track the latest scheduled time to compare for 'Ended' status
                    if ($latestScheduledDateTime === null || $dateTime > $latestScheduledDateTime) {
                        $latestScheduledDateTime = $dateTime;
                    }
                }
            }
    
            // If current time is beyond the last scheduled intake date and time, mark as 'Ended'
            if ($latestScheduledDateTime && $currentDateTime > $latestScheduledDateTime) {
                $status = 'Ended';
            }
    
            // **Live update**: Save the updated status back to the database
            $intake->MedicationStatus = $status;
            $medicationIntakeModel->save($intake); // Save the updated status to the database
        }
    
        // Sort medication intakes by status: Started -> During -> Ended
        usort($medicationIntakes, function($a, $b) {
            $statusOrder = ['Started' => 1, 'During' => 2, 'Ended' => 3];
            return $statusOrder[$a->MedicationStatus] <=> $statusOrder[$b->MedicationStatus];
        });
    
        // Pass data to the view
        $data = [
            'title' => 'Medication Intake',
            'medicationIntakes' => $medicationIntakes,
        ];
    
        return view('layout/header', $data) . 
               view('medicationIntake/index', $data) . 
               view('layout/footer', $data);
    }
    
    
    
    
    
    public function add() {
        // Load models
        $medications = new MedicationModel();
        $patients = new PatientModel();
        $medicationIntake = new MedicationIntakeModel();
    
        // Fetching medication and patient data
        $data = [
            'title' => 'Add Medication Intake',
            'MedicationData' => $medications->findAll(),
           'PatientData' => $patients->where('PatientStatus', 'ADMISSION')->findAll(), // Fetching all patient records
        ];
    
        // Check if form is submitted
        if ($this->request->getMethod() === 'POST') {
            // Validation rules
            $rules = [
                'MedicationID' => 'required', // Ensure medication is selected and exists
                'PatientID' => 'required',    // Ensure patient is selected and exists
                'IntakeTimes' => 'required',  // Ensure at least one intake time is selected
                'IntakeDates' => 'required',  // Ensure at least one date is selected
            ];
    
            // Run validation
            if (!$this->validate($rules)) {
                // If validation fails, send error messages
                $data['validation'] = $this->validator;
                return view('layout/header', $data) . 
                       view('medicationIntake/add', $data) . 
                       view('layout/footer', $data);
            } else {
                // If validation is successful, save data
    
                // Get the input data
                $medicationID = $this->request->getPost('MedicationID');
                $patientID = $this->request->getPost('PatientID');
                $intakeTimes = $this->request->getPost('IntakeTimes');
                $intakeDates = $this->request->getPost('IntakeDates');
    
                // Prepare the data to save in the database
                $medicationIntakeData = [
                    'PatientID' => $patientID,
                    'MedicationID' => is_array($medicationID) ? implode(',', $medicationID) : $medicationID, // Handle multiple medications
                    'IntakeTimes' => is_array($intakeTimes) ? implode(',', $intakeTimes) : $intakeTimes, // Handle multiple intake times
                    'IntakeDates' => is_array($intakeDates) ? implode(',', $intakeDates) : $intakeDates, // Handle multiple intake dates
                ];
    
                // Save the medication intake record
                if ($medicationIntake->save($medicationIntakeData)) {
                    // Set a success message if save is successful
                    session()->setFlashdata('success', 'Medication Intake has been successfully added.');
                } else {
                    // Set an error message if saving fails
                    session()->setFlashdata('error', 'There was an issue adding the medication intake.');
                }
    
                // Redirect to the medication intake page
                return redirect()->to(base_url('medicationIntake'));
            }
        }
    
        // Load the view if not POST
        return view('layout/header', $data) . 
               view('medicationIntake/add', $data) . 
               view('layout/footer', $data);
    }
    
    public function mark()
    {
        $medicationStatus = new MedicationStatusModel();

        if ($this->request->getMethod() === 'POST') {
            // Get data from POST request
            $selectedMedications = $this->request->getPost('selectedMedications');
            $statuses = $this->request->getPost('medicationStatus');
            $remarks = $this->request->getPost('remarks');
            $medicationIntakeID = $this->request->getPost('medicationIntakeID');

            // Check if any medications were selected
            if (!empty($selectedMedications)) {
                // Convert the comma-separated values into arrays
                $selectedMedications = explode(',', $selectedMedications);
                $statuses = explode(',', $statuses);
                $remarks = explode(',', $remarks);

                // Validate data length
                if (count($statuses) !== count($selectedMedications) || count($remarks) !== count($selectedMedications)) {
                    session()->setFlashdata('error', 'Mismatched data lengths. Please check your inputs.');
                    return redirect()->to('/medicationIntake');
                }

                // Iterate through each selected medication to update its status
                foreach ($selectedMedications as $index => $medicationID) {
                    $status = $statuses[$index] ?? 'No';
                    $remark = $remarks[$index] ?? '';

                    $data = [
                        'MedicationIntakeID' => $medicationIntakeID,
                        'MedicationID' => $medicationID,
                        'IntakeStatus' => $status,
                        'Remark' => $remark,
                        'Time' => date('H:i:s'),
                        'Date' => date('Y-m-d'),
                    ];
                    if ($medicationStatus->insert($data) === false) {
                        log_message('error', 'Error inserting data: ' . implode(', ', $medicationStatus->errors()));
                        session()->setFlashdata('error', 'An error occurred while updating the status.');
                        return redirect()->to('/medicationIntake');
                    }
                }
                session()->setFlashdata('success', 'Medication status updated successfully.');
            } else {
                session()->setFlashdata('error', 'Please select at least one medication.');
            }

            return redirect()->to('/medicationIntake');
        }
    }
    
    
    public function completedIntakes()
    {
        // Load the necessary models
        $medicationModel = new MedicationModel();
      
    
        // Query to fetch completed intakes with correct joins
        $completedIntakes = $medicationModel
            ->select('
                medication_tbl.MedicationID,
                medication_tbl.MedicationName,
                medication_tbl.Dosage,
                medicationstatus_tbl.Remark,
                medicationstatus_tbl.Time,
                medicationstatus_tbl.Date,
                medicationstatus_tbl.IntakeStatus,
                medicationintake_tbl.*,
                patient_tbl.Firstname,
                patient_tbl.Lastname
            ')
            ->join('medicationstatus_tbl', 'medication_tbl.MedicationID = medicationstatus_tbl.MedicationID', 'left') // Join with medicationstatus_tbl
            ->join('medicationintake_tbl', 'medicationintake_tbl.MedicationIntakeID = medicationstatus_tbl.MedicationIntakeID', 'left') // Join with medicationintake_tbl
            ->join('patient_tbl', 'patient_tbl.PatientID = medicationintake_tbl.PatientID', 'left') // Join with patient_tbl
            ->whereIn('medicationstatus_tbl.IntakeStatus', ['Yes', 'No']) // Filter by completed intakes
            ->orderBy('medicationstatus_tbl.created_at', 'DESC') // Sort by the latest created_at
            ->findAll();
    
        // Pass data to the view
        $data = [
            'title' => 'Completed Intake Medication',
            'completedIntakes' => $completedIntakes,
        ];
    
        return view('layout/header', $data) .
               view('medicationIntake/completed', $data) .
               view('layout/footer', $data);
    }
    
    
    
    
    public function edit()
    {
        $medicationIntakeModel = new MedicationIntakeModel();
        $medications = new MedicationModel();
        $patients = new PatientModel();
        // Get MD5 Patient ID from the query string
        $hashedId = $this->request->getGet('id');
        
        // Fetch the medication intake details using the hashed ID
        $medicationDetails = $medicationIntakeModel
            ->select('
                medicationintake_tbl.MedicationIntakeID, 
                medicationintake_tbl.PatientID, 
                medicationintake_tbl.IntakeTimes,
                medicationintake_tbl.IntakeDates,
                medicationintake_tbl.MedicationStatus,  
                medicationintake_tbl.created_at, 
                patient_tbl.Firstname as PatientFirstname, 
                patient_tbl.Lastname as PatientLastname, 
                physician_tbl.Firstname as PhysicianFirstname, 
                physician_tbl.Lastname as PhysicianLastname,
                medicationintake_tbl.MedicationID,
                GROUP_CONCAT(medicationstatus_tbl.Remark) as Remarks
            ')
            ->join('patient_tbl', 'patient_tbl.PatientID = medicationintake_tbl.PatientID', 'left')
            ->join('physician_tbl', 'physician_tbl.PhysicianID = patient_tbl.PhysicianID', 'left')
            ->join('medicationstatus_tbl', 'medicationstatus_tbl.MedicationIntakeID = medicationintake_tbl.MedicationIntakeID', 'left')
            ->groupBy('medicationintake_tbl.MedicationIntakeID')
            ->where('MD5(CONCAT(medicationintake_tbl.MedicationIntakeID, "edit"))', $hashedId)
            ->first();
    
        if (!$medicationDetails) {
            // Redirect if no details are found
            return redirect()->to('/medicationIntake')->with('error', 'Patient not found.');
        }
        
        $data = [
            "title" => "Edit Patient",
            'MedicationData' => $medications->findAll(),
            "MedicationDetails" => $medicationDetails,
            'PatientData' => $patients->findAll(),  // Pass fetched details to the view
        ];
    
        // Handle POST request for updating
        if ($this->request->getMethod() == 'POST') {
            $medicationIntakeID = $this->request->getPost('MedicationIntakeID');
              // Get the input data
              $medicationID = $this->request->getPost('MedicationID');
              $patientID = $this->request->getPost('PatientID');
              $intakeTimes = $this->request->getPost('IntakeTimes');
              $intakeDates = $this->request->getPost('IntakeDates');
  
            $updatedData = [
                'PatientID' => $patientID,
                'MedicationID' => is_array($medicationID) ? implode(',', $medicationID) : $medicationID, // Handle multiple medications
                'IntakeTimes' => is_array($intakeTimes) ? implode(',', $intakeTimes) : $intakeTimes, // Handle multiple intake times
                'IntakeDates' => is_array($intakeDates) ? implode(',', $intakeDates) : $intakeDates, // Handle multiple intake dates
            ];
    
            // Validate the input (optional: add validation rules)
            if ($medicationIntakeModel->update($medicationIntakeID, $updatedData)) {
                return redirect()->to('/medicationIntake')->with('success', 'Medication intake updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update medication intake.');
            }
        }
    
        // Load the edit view with the fetched details
        return view('layout/header', $data)
            . view('medicationIntake/edit', $data)
            . view('layout/footer', $data);
    }
    
}
