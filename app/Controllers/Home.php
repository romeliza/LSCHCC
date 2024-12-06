<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\PhysicianModel;
use App\Models\MedicationModel;
use App\Models\MedicationIntakeModel;
class Home extends BaseController
{
    protected $userModel;
    protected $patientModel;
    protected $physicianModel;
    protected $medicationModel;
    protected $MedicationIntakeModel;
    public function __construct() {
        // Initialize models
        $this->userModel = new UserModel();
        $this->patientModel = new PatientModel();
        $this->physicianModel = new PhysicianModel();
        $this->medicationModel = new MedicationModel();
        $this->MedicationIntakeModel = new MedicationIntakeModel();
        // Load form helper
        helper('form');
    }

    public function index()
{
    // Initialize the models
    $patientModel = new PatientModel();
    $medicationModel = new MedicationModel();
    $physicianModel = new PhysicianModel();
    $medicationIntakeModel = new MedicationIntakeModel();
    // Fetch the count of results from the other models
    $data = [
        'title' => 'Dashboard',
        'PatientData' => $patientModel->countAllResults(),
        'MedicationData' => $medicationModel->countAllResults(),
        'PhysicianData' => $physicianModel->countAllResults(),
    ];

    // Fetch the count of medication intake statuses
    $medicationData = $medicationIntakeModel->select('MedicationID, COUNT(MedicationStatus) as intakeCount')
                                            ->groupBy('MedicationID')
                                            ->findAll();

    // Prepare the data for the chart
    $labels = [];
    $chartData = [];
    foreach ($medicationData as $item) {
        $labels[] = $item->MedicationID;  // You can use MedicationName instead if needed
        $chartData[] = $item->intakeCount;
    }

    // Add chart data to the array
    $data['labels'] = json_encode($labels);
    $data['data'] = json_encode($chartData);

    // Return the view with all data
    return view('layout/header', $data) .
           view('locations', $data) .
           view('dashboard', $data) .
           view('layout/footer', $data);
}

    


  
}
