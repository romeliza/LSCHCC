<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\PhysicianModel;
use App\Models\MedicationIntakeModel;
use App\Models\MedicationModel;
use App\Models\MedicationStatusModel;
use App\Models\PatientDetailsModel;

class ReportController extends BaseController
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
        // Load models
        $patientModel = new PatientModel();
        $physicianModel = new PhysicianModel();
        $medicationIntakeModel = new MedicationIntakeModel();
        $medicationModel = new MedicationModel();
        $medicationStatusModel = new MedicationStatusModel();
        
        // Fetch total data
        $patientData = $patientModel->countAllResults();
        $physicianData = $physicianModel->countAllResults();
        $medicationIntakeData = $medicationIntakeModel->countAllResults();
        $completedMedicationIntakeData = $medicationStatusModel->countAllResults();
        $medicationData = $medicationModel->countAllResults();
        
        // Fetch data by status for OPD, Admission, and Discharged
        $opdData = $patientModel->where('PatientStatus', 'OPD')->countAllResults();
        $admissionData = $patientModel->where('PatientStatus', 'ADMISSION')->countAllResults();
        $dischargedData = $patientModel->where('PatientStatus', 'DISCHARGED')->countAllResults();

        // Pass data to the view
        $data = [
            'title' => 'Reports',
            'PatientData' => $patientData,
            'PhysicianData' => $physicianData,
            'MedicationIntakeData' => $medicationIntakeData,
            'CompletedMedicationIntakeData' => $completedMedicationIntakeData,
            'MedicationData' => $medicationData,
            'OPDData' => $opdData,
            'AdmissionData' => $admissionData,
            'DischargedData' => $dischargedData,
        ];

        return view('layout/header', $data) . 
               view('report/index', $data) . 
               view('layout/footer', $data);
    }

    public function patient()
{
    $patientModel = new PatientModel();
    $patientData = $patientModel->findAll();  // Fetch all patient data

    // Prepare data for the view
    $data = [
        'title' => 'Patient Report',
        'patients' => $patientData,  // Pass patient data to view as 'patients'
    ];

    return view('layout/header', $data) . 
           view('report/patient', $data) . 
           view('layout/footer', $data);
}

    

 // Controller method for displaying the physician report
public function physician()
{
    $physicianModel = new PhysicianModel();
    $physicianData = $physicianModel->findAll();  // Fetch all physician data

    $data = [
        'title' => 'Physician Report',
        'physicianData' => $physicianData,  // Pass physician data to view
    ];
    return view('layout/header', $data) . 
           view('report/physician', $data) . 
           view('layout/footer', $data);
}

    public function medication()
    {
        $medicationModel = new MedicationModel();
        $medicationData = $medicationModel->findAll();  // Fetch all medication data

        $data = [
            'title' => 'Medication Report',
            'medicationData' => $medicationData,  // Pass medication data to view
        ];
        return view('layout/header', $data) . 
               view('report/medication', $data) . 
               view('layout/footer', $data);
    }

    public function medicationintake()
    {
        // Load the MedicationIntakeModel
        $medicationIntakeModel = new MedicationIntakeModel();
        
        // Raw SELECT query with JOIN to get data from medicationintake_tbl, medication_tbl, and patient_tbl
        $medicationIntakeData = $medicationIntakeModel->builder()
        ->select('medicationintake_tbl.*, medication_tbl.MedicationName, medication_tbl.Dosage, 
                 CONCAT(patient_tbl.Firstname, " ", patient_tbl.Lastname) as PatientName, 
                 medicationintake_tbl.IntakeTimes, medicationintake_tbl.MedicationStatus, medicationintake_tbl.IntakeDates')
        ->join('medication_tbl', 'medication_tbl.MedicationID = medicationintake_tbl.MedicationID', 'left')
        ->join('patient_tbl', 'patient_tbl.PatientID = medicationintake_tbl.PatientID', 'left')
        ->get()->getResult();
    
        
        // Pass the fetched data to the view
        $data = [
            'title' => 'Medication Intake Report',
            'medicationIntakeData' => $medicationIntakeData,  // Pass medication intake data to view
        ];
        
        // Return the complete view with header, report, and footer
        return view('layout/header', $data) . 
               view('report/intake', $data) . 
               view('layout/footer', $data);
    }
    

    protected $allowedFields = ["PatientID", "MedicationID", "MedicationIntakeID", "Remark", "Time", "Date", "IntakeStatus"];

    public function completedintake() 
    {
        // Load the MedicationStatusModel
        $medicationStatusModel = new MedicationStatusModel();
        
        // Raw SELECT query with JOIN to get data from medicationstatus_tbl, medication_tbl, and patient_tbl
        $completedIntakes = $medicationStatusModel
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
            ->join('medication_tbl', 'medication_tbl.MedicationID = medicationstatus_tbl.MedicationID', 'left') // Join with medication_tbl
            ->join('medicationintake_tbl', 'medicationintake_tbl.MedicationIntakeID = medicationstatus_tbl.MedicationIntakeID', 'left') // Join with medicationintake_tbl
            ->join('patient_tbl', 'patient_tbl.PatientID = medicationintake_tbl.PatientID', 'left') // Join with patient_tbl
            ->whereIn('medicationstatus_tbl.IntakeStatus', ['Yes', 'No']) // Filter by completed intakes
            ->orderBy('medicationstatus_tbl.created_at', 'DESC') // Sort by the latest created_at
            ->findAll();
    
        // Debugging - Check if data exists
        if (empty($completedIntakes)) {
            log_message('error', 'No completed medication intake data found.');
        }
    
        // Pass the fetched data to the view
        $data = [
            'title' => 'Completed Medication Intake Report',
            'completedIntakes' => $completedIntakes,  // Corrected variable name
        ];
    
        // Return the complete view with header, report, and footer
        return view('layout/header', $data) . 
               view('report/completed', $data) . 
               view('layout/footer', $data);
    }
    

    
    
    public function opd()
    {
        $patientModel = new PatientModel();
        $opdData = $patientModel->getPatientWithDetailsByStatus('OPD');  // Fetch all OPD patients with details
    
        $data = [
            'title' => 'OPD Report',
            'OPDData' => $opdData,  // Pass OPD data to view
        ];
    
        return view('layout/header', $data) . 
               view('report/opd', $data) . 
               view('layout/footer', $data);
    }
    

    public function admission()
    {
        $patientModel = new PatientModel();
        $admissionData = $patientModel->getPatientWithDetailsByStatus('ADMISSION');  // Fetch all admission patients with details
    
        $data = [
            'title' => 'Admission Report',
            'AdmissionData' => $admissionData,  // Pass admission data to view
        ];
    
        return view('layout/header', $data) . 
               view('report/admission', $data) . 
               view('layout/footer', $data);
    }
    
    public function discharged()
    {
        $patientModel = new PatientModel();
        $dischargedData = $patientModel->getPatientWithDetailsByStatus('DISCHARGED');
        $data = [
            'title' => 'Discharged Report',
            'DischargedData' => $dischargedData,  // Pass discharged data to view
        ];
        return view('layout/header', $data) . 
               view('report/discharged', $data) . 
               view('layout/footer', $data);
    }

    public function dischargedsummary()
    {
        // Load the models for patient and patient details
        $patientModel = new PatientModel();
        $patientDetailsModel = new PatientDetailsModel();
    
        // Fetch all discharged patients along with their patient details
        $dischargedData = $patientModel->select('patient_tbl.*, patientdetails_tbl.*')  // Select all patient and details columns
                                      ->join('patientdetails_tbl', 'patient_tbl.PatientID = patientdetails_tbl.PatientID', 'left')  // Join with patientdetails_tbl on PatientID
                                      ->where('patient_tbl.PatientStatus', 'DISCHARGED')  // Filter discharged patients
                                      ->findAll();
    
        // Prepare the data to be passed to the view
        $data = [
            'title' => 'Discharged Report',
            'DischargedData' => $dischargedData,  // Pass the combined data to the view
        ];
    
        // Return the view with header, content, and footer
        return view('layout/header', $data) . 
               view('report/dischargedsummary', $data) . 
               view('layout/footer', $data);
    }
    
}
