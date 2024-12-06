<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\PhysicianModel;
use App\Models\PatientDetailsModel;
use CodeIgniter\Controller;
use App\Models\MedicationModel;

class PatientController extends BaseController
{
    public function __construct()
    {
        helper('form');
      
        // Check if the user is logged in, redirect to login if not
        if (!session()->has('UserID')) {
            return redirect()->to('/login');
        }
    }

    public function index()
{
    $PatientModel = new PatientModel();
  
    $data = [
        "PatientData" => $PatientModel
            ->select('patient_tbl.*, 
                      CONCAT(physician_tbl.Lastname, ", ", physician_tbl.Firstname, " ", physician_tbl.Middlename) as PhysicianName, 
                      physician_tbl.Specialization,
                      pd.HeadofFamily, 
                      pd.AdultHistory, 
                      pd.PediatricHistory, 
                      pd.PatientDateTime, 
                      pd.ChiefComplaint, 
                      pd.InitialDiagnosis, 
                      pd.Treatment, 
                      pd.Bp, 
                      pd.T, 
                      pd.CR, 
                      pd.RR, 
                      pd.O2Sat, 
                      pd.Wt, 
                      pd.Ht')
            ->join('physician_tbl', 'patient_tbl.PhysicianID = physician_tbl.PhysicianID', 'left')
            ->join('(SELECT PatientID, MAX(PatientDateTime) as LatestDate FROM patientdetails_tbl GROUP BY PatientID) as subquery', 'patient_tbl.PatientID = subquery.PatientID', 'left')
            ->join('patientdetails_tbl as pd', 'subquery.PatientID = pd.PatientID AND subquery.LatestDate = pd.PatientDateTime', 'left')
            ->groupBy('patient_tbl.PatientID') // Ensures one row per patient
            ->orderBy('patient_tbl.created_at', 'DESC')
            ->findAll(),
        "title" => "Patient Management",
    ];

   
    // Load the view
    return view('layout/header', $data) . 
           view('patient/index', $data) . 
           view('patient/view', $data) . 
           view('layout/footer', $data);
}



    
    
public function add()
{
    // Initialize PhysicianModel
    $physicianModel = new PhysicianModel();

    // Prepare data for the view
    $data = [
        "title" => "Add Patient",
        "physicians" => $physicianModel->findAll(),
    ];

    // Check if the form is submitted and validated
    if ($this->request->getMethod() === 'POST') {
        // Get patient data from form
        $patientData = [
            'HostipalCaseNo' => $this->request->getPost('HostipalCaseNo'),
            'Lastname' => $this->request->getPost('Lastname'),
            'Firstname' => $this->request->getPost('Firstname'),
            'Middlename' => $this->request->getPost('Middlename'),
            'Sex' => $this->request->getPost('Sex'),
            'region' => $this->request->getPost('region'),
            'province' => $this->request->getPost('province'),
            'municipality' => $this->request->getPost('municipality'),
            'barangay' => $this->request->getPost('barangay'),
            'CivilStatus' => $this->request->getPost('CivilStatus'),
            'PlaceofBirth' => $this->request->getPost('PlaceofBirth'),
            'Occupation' => $this->request->getPost('Occupation'),
            'Religion' => $this->request->getPost('Religion'),
            'ContactNumber' => $this->request->getPost('ContactNumber'),
            'DateofBirth' => $this->request->getPost('DateofBirth'),
            'PatientStatus' => $this->request->getPost('PatientStatus'),
            'PhysicianID' => $this->request->getPost('PhysicianID'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Load Patient model
        $patientModel = new PatientModel();

        // Save the data to the patient_tbl
        if ($patientModel->save($patientData)) {
            // Retrieve the Patient ID of the newly inserted record
            $patientID = $patientModel->getInsertID();
            if (!$patientID) {
                return redirect()->back()->with('error', 'Failed to retrieve Patient ID.');
            }

            $adultHistory = $this->request->getPost('AdultHistory');
            $pediatricHistory = $this->request->getPost('PediatricHistory');

            // Process Adult History - check "OTHERS" input
            $adultHistoryOthersInput = $this->request->getPost('AdultHistoryOtherInput');
            if (is_array($adultHistory)) {
                // Remove duplicates and filter out empty values, including empty "OTHERS" input
                $adultHistory = array_filter($adultHistory, function($value) {
                    return !empty($value) && $value !== 'OTHERS';
                });

                // If "OTHERS" is selected and input is provided, add the custom value
                if (!empty($adultHistoryOthersInput)) {
                    $adultHistory[] = $adultHistoryOthersInput;
                }
            }

            // Process Pediatric History - check "OTHERS" input
            $pediatricHistoryOthersInput = $this->request->getPost('PediatricHistoryOtherInput');
            if (is_array($pediatricHistory)) {
                // Remove duplicates and filter out empty values, including empty "OTHERS" input
                $pediatricHistory = array_filter($pediatricHistory, function($value) {
                    return !empty($value) && $value !== 'OTHERS';
                });

                // If "OTHERS" is selected and input is provided, add the custom value
                if (!empty($pediatricHistoryOthersInput)) {
                    $pediatricHistory[] = $pediatricHistoryOthersInput;
                }
            }

            // Prepare patient details data
            $patientDetailsData = [
                'PatientID' => $patientID,
                'HeadofFamily' => $this->request->getPost('HeadofFamily'),
                'AdultHistory' => !empty($adultHistory) ? implode(',', $adultHistory) : '',
                'PediatricHistory' => !empty($pediatricHistory) ? implode(',', $pediatricHistory) : '',
                'ChiefComplaint' => $this->request->getPost('ChiefComplaint'),
                'InitialDiagnosis' => $this->request->getPost('InitialDiagnosis'),
                'Treatment' => $this->request->getPost('Treatment'),
                'Bp' => $this->request->getPost('Bp'),
                'T' => $this->request->getPost('T'),
                'CR' => $this->request->getPost('CR'),
                'RR' => $this->request->getPost('RR'),
                'O2Sat' => $this->request->getPost('O2Sat'),
                'Wt' => $this->request->getPost('Wt'),
                'Ht' => $this->request->getPost('Ht'),
                'PatientDateTime' => date('Y-m-d H:i:s') // Optional: Current date and time
            ];

            // Load PatientDetails model
            $patientDetailsModel = new PatientDetailsModel();

            // Save the data to the patientdetails_tbl
            if ($patientDetailsModel->save($patientDetailsData)) {
                // If everything is successful, redirect with success message
                return redirect()->to('/patient')->with('success', 'Patient added successfully');
            } else {
                // Handle failure in patient details insertion
                return redirect()->back()->with('error', 'Failed to add patient details. Please try again.');
            }
        } else {
            // Handle failure in patient insertion
            return redirect()->back()->with('error', 'Failed to add patient. Please try again.');
        }
    }

    // Return the view
    return view('layout/header', $data) .
        view('patient/locations', $data) .
        view('patient/add', $data) .
        view('layout/footer', $data);
}



public function edit()
{
    // Initialize models
    $patientModel = new PatientModel();
    $patientDetailsModel = new PatientDetailsModel();
    $physicianModel = new PhysicianModel();

    // Get MD5 Patient ID from the query string
    $hashedId = $this->request->getGet('id');
   
    // Find the patient using the hashed ID
    $patientDetails = $patientModel
        ->select('patient_tbl.*, patientdetails_tbl.*')
        ->join('patientdetails_tbl', 'patientdetails_tbl.PatientID = patient_tbl.PatientID', 'left')
        ->where('MD5(CONCAT(patient_tbl.PatientID, "edit"))', $hashedId)
        ->first();
  
    // Prepare data for the view
    $data = [
        "title" => "Edit Patient",
        "patientDetails" => $patientDetails,
        "physicians" => $physicianModel->findAll(),
    ];
  
    // Handle form submission for update
    if ($this->request->getMethod() === 'POST') {
        // Retrieve the Patient ID (not hashed)
        $patientId = $this->request->getPost('PatientID');

        // Ensure the patient ID is valid
        if (!$patientId) {
            return redirect()->back()->with('error', 'Invalid patient ID.');
        }

        // Prepare updated patient data
        $patientData = [
            'HostipalCaseNo' => $this->request->getPost('HostipalCaseNo'),
            'Lastname' => $this->request->getPost('Lastname'),
            'Firstname' => $this->request->getPost('Firstname'),
            'Middlename' => $this->request->getPost('Middlename'),
            'Sex' => $this->request->getPost('Sex'),
            'region' => $this->request->getPost('region'),
            'province' => $this->request->getPost('province'),
            'municipality' => $this->request->getPost('municipality'),
            'barangay' => $this->request->getPost('barangay'),
            'CivilStatus' => $this->request->getPost('CivilStatus'),
            'PlaceofBirth' => $this->request->getPost('PlaceofBirth'),
            'Occupation' => $this->request->getPost('Occupation'),
            'Religion' => $this->request->getPost('Religion'),
            'ContactNumber' => $this->request->getPost('ContactNumber'),
            'PhysicianID' => $this->request->getPost('PhysicianID'),
            'DateofBirth' => $this->request->getPost('DateofBirth'),
            'PatientStatus' => $this->request->getPost('PatientStatus'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Update patient data
        $updatePatient = $patientModel->update($patientId, $patientData);

        if ($updatePatient) {
            // Handle AdultHistory
            $adultHistory = $this->request->getPost('AdultHistory');
            $adultHistoryOthersInput = $this->request->getPost('AdultHistoryOtherInput');
            if (is_array($adultHistory)) {
                $adultHistory = array_filter($adultHistory, function($value) {
                    return $value !== 'OTHERS';
                });

                if (!empty($adultHistoryOthersInput)) {
                    $adultHistory[] = $adultHistoryOthersInput;
                }
            }

            // Handle PediatricHistory
            $pediatricHistory = $this->request->getPost('PediatricHistory');
            $pediatricHistoryOthersInput = $this->request->getPost('PediatricHistoryOtherInput');
            if (is_array($pediatricHistory)) {
                $pediatricHistory = array_filter($pediatricHistory, function($value) {
                    return $value !== 'OTHERS';
                });

                if (!empty($pediatricHistoryOthersInput)) {
                    $pediatricHistory[] = $pediatricHistoryOthersInput;
                }
            }

            // Prepare final data
            $patientDetailsData = [
                'HeadofFamily' => $this->request->getPost('HeadofFamily'),
                'AdultHistory' => is_array($adultHistory) ? implode(',', $adultHistory) : '',
                'PediatricHistory' => is_array($pediatricHistory) ? implode(',', $pediatricHistory) : '',
                'ChiefComplaint' => $this->request->getPost('ChiefComplaint'),
                'InitialDiagnosis' => $this->request->getPost('InitialDiagnosis'),
                'Treatment' => $this->request->getPost('Treatment'),
                'Bp' => $this->request->getPost('Bp'),
                'T' => $this->request->getPost('T'),
                'CR' => $this->request->getPost('CR'),
                'RR' => $this->request->getPost('RR'),
                'O2Sat' => $this->request->getPost('O2Sat'),
                'Wt' => $this->request->getPost('Wt'),
                'Ht' => $this->request->getPost('Ht'),
                'PatientDateTime' => date('Y-m-d H:i:s'),
            ];

            // Update or insert the patient details as needed
            $existingDetails = $patientDetailsModel->where('PatientID', $patientId)->first();
            if ($existingDetails && $existingDetails->PatientDetailsID) {
                $updateDetails = $patientDetailsModel->update($existingDetails->PatientDetailsID, $patientDetailsData);
                if (!$updateDetails) {
                    return redirect()->back()->with('error', 'Failed to update patient details. Please try again.');
                }
            } else {
                $patientDetailsData['PatientID'] = $patientId;
                $insertDetails = $patientDetailsModel->insert($patientDetailsData);
                if (!$insertDetails) {
                    return redirect()->back()->with('error', 'Failed to insert patient details. Please try again.');
                }
            }

            return redirect()->to('/patient')->with('success', 'Patient updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update patient. Please try again.');
        }
    }

    // Pass patient data to the view
    $data['PatientDetails'] = $patientDetails;
    $data['PhysicianID'] = $patientDetails->PhysicianID;
  
    // Render the view
    return view('layout/header', $data) . 
        view('patient/locations', $data) . 
        view('patient/edit', $data) . 
        view('layout/footer', $data);
}






    // Delete a patient
    public function delete()
    {
        $PatientModel = new PatientModel();

        if ($this->request->getMethod() === 'POST') {
            $patientID = $this->request->getPost('PatientID');
            $rules = [
                'PatientID' => 'required',
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('error', 'Invalid Patient ID.');
                return redirect()->to('patient');
            }

            $existingPatient = $PatientModel->find($patientID);
            if ($existingPatient) {
                $result = $PatientModel->delete($patientID);
                if ($result) {
                    session()->setFlashdata('success', 'Patient successfully deleted.');
                } else {
                    session()->setFlashdata('error', 'Failed to delete patient.');
                }
            } else {
                session()->setFlashdata('error', 'Patient not found.');
            }

            return redirect()->to('patient');
        }

        return redirect()->to('patient');
    }

    public function status()
    {
        // Initialize models
        $patientModel = new PatientModel();
        $patientDetailsModel = new PatientDetailsModel();
        $physicianModel = new PhysicianModel();
        $medicationModel = new MedicationModel();
        
        // Get MD5 Patient ID from the query string
        $hashedId = $this->request->getGet('id');
         
        // Find the patient using the hashed ID
        $patientDetails = $patientModel
            ->select(
                'patient_tbl.*, 
                CONCAT(physician_tbl.Lastname, ", ", physician_tbl.Firstname, " ", physician_tbl.Middlename) as PhysicianName, 
                physician_tbl.Specialization,
                patientdetails_tbl.*'
            )
            ->join('physician_tbl', 'patient_tbl.PhysicianID = physician_tbl.PhysicianID', 'left')
            ->join('patientdetails_tbl', 'patient_tbl.PatientID = patientdetails_tbl.PatientID', 'left')
            ->where('MD5(CONCAT(patient_tbl.PatientID, "status"))', $hashedId)
            ->first();
         
        if (!$patientDetails) {
            return redirect()->to(base_url('patient'))->with('error', 'Patient not found.');
        }
        
        // Prepare data for the view
        $data = [
            "title" => "Update Patient Status",
            "patientDetails" => $patientDetails,
            "physicians" => $physicianModel->findAll(),
            "PhysicianID" => $patientDetails->PhysicianID ?? null,
            "MedicationData" => $medicationModel->findAll(),
        ];
        
        // Handle form submission for status update
        if ($this->request->getMethod() === 'POST') {
            // Retrieve the Patient ID (not hashed)
            $patientId = $this->request->getPost('PatientID');
            
            // Ensure the patient ID is valid
            if (!$patientId) {
                return redirect()->back()->with('error', 'Invalid patient ID.');
            }
        
            // Prepare updated patient data for the main patient table
            $patientData = [
                'PatientID' => $patientId,
                'PatientStatus' => 'DISCHARGED',  // Patient status from the form
                'updated_at' => date('Y-m-d H:i:s'),  // Update timestamp
            ];
            
            // Update patient data
            $updatePatient = $patientModel->update($patientId, $patientData);
            
            if ($updatePatient) {
                // Prepare updated patient details data
                $patientDetailsData = [
                    'PatientID' => $patientId,  // Ensure you're using the current `PatientID`
                    'ChiefComplaint' => $this->request->getPost('ChiefComplaint'),
                    'Medication' => implode(', ', $this->request->getPost('Medication')),
                    'DischargedDate' => $this->request->getPost('DischargedDate'),
                    'LaboratoryFindings' => $this->request->getPost('LaboratoryFindings'),
                    'FinalDiagnosis' => $this->request->getPost('FinalDiagnosis'),
                    'Disposition' => $this->request->getPost('Disposition'),
                ];
                
               
                
                // Check if patient details already exist
                $existingDetails = $patientDetailsModel->where('PatientID', $patientId)->first();
            
                if ($existingDetails && $existingDetails->PatientDetailsID) {
                    // Update patient details
                    $updateDetails = $patientDetailsModel->update($existingDetails->PatientDetailsID, $patientDetailsData);
                    if (!$updateDetails) {
                        return redirect()->back()->with('error', 'Failed to update patient details. Please try again.');
                    }
                } else {
                    // Insert patient details if not found
                    $patientDetailsData['PatientID'] = $patientId;  // Ensure PatientID is set
                    $insertDetails = $patientDetailsModel->insert($patientDetailsData);
                    if (!$insertDetails) {
                        return redirect()->back()->with('error', 'Failed to insert patient details. Please try again.');
                    }
                }
        
                return redirect()->to(base_url('patient'))->with('success', 'Patient status updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update patient. Please try again.');
            }
        }
        
        // Pass patient data to the view
        $data['PatientDetails'] = $patientDetails;
        $data['PhysicianID'] = $patientDetails->PhysicianID;
        
        return view('layout/header', $data) .
            view('patient/status', $data) .
            view('layout/footer', $data);
    }
    
    

    
    
    

}
