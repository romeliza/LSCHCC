<?php

namespace App\Controllers;


use CodeIgniter\Controller;
use App\Models\MedicationModel;
class MedicationController extends BaseController
{
    protected $medicationModel ;
    public function __construct()
    {
        helper('form');
        $this->medicationModel =  new MedicationModel();
        // Check if the user is logged in, redirect to login if not
        if (!session()->has('UserID')) {
            return redirect()->to('/login');
        }
    }
    public function index(){
        $data = [
            'title'=> 'Medicine',
            'MedicationData'=> $this->medicationModel->findAll(),
        ] ;
        return view('layout/header', $data).
        view('medication/index', $data) .
        view('layout/footer', $data) ;
    }
    public function add()
    {
        // Initialize the MedicationModel
        $medicationModel = new MedicationModel();

        // Prepare the data to be passed to the view
        $data = [
            'title' => 'Add Medicine', // Set the page title
            'MedicationData' => $medicationModel->findAll(), // Fetch all medication data (optional)
        ];

        // Check if the request method is POST (form submission)
        if ($this->request->getMethod() === 'POST') {
            // Define validation rules for form fields
            $rules = [
                'MedicationName' => ['label' => 'Medication Name', 'rules' => 'required'],
                'Dosage'         => ['label' => 'Dosage', 'rules' => 'required'],
             
            ];

            // Validate the form data
            if (!$this->validate($rules)) {
                // Validation failed, pass the validation errors to the view
                $data['validation'] = $this->validator;
            } else {
                // Validation passed, process the form data
                $newMedicationData = [
                    'MedicationName'           => $this->request->getPost('MedicationName'),
                    'Dosage'                   => $this->request->getPost('Dosage'),
                    'created_at'               => date('Y-m-d H:i:s'), // Capture the current timestamp
                ];
                // Insert the new medication data into the database
                $medicationModel->insert($newMedicationData);
                // Set a success flash message and redirect to the medication list
                session()->setFlashdata('success', 'Medication successfully added.');
                return redirect()->to('/medication');
            }
        }
        // Return the views, passing the data to them
        return view('layout/header', $data) . 
               view('medication/add', $data) . 
               view('layout/footer', $data);
    }

    public function edit()
    {
        $MedicationModel = new MedicationModel();
        $data['title'] = 'Edit Medication';
    
        // Handle POST request for updating physician details
        if ($this->request->getMethod() === 'POST') {
            $medicationID = $this->request->getPost('MedicationID'); // Ensure name matches form
    
            log_message('debug', 'Medication ID for update: ' . $medicationID);
    
            // Validation rules
            $rules = [
                'MedicationName' => ['label' => 'Medication Name', 'rules' => 'required'],
                'Dosage'         => ['label' => 'Dosage', 'rules' => 'required'],
            ];
    
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // Prepare updated data
                $updatedData = [
                    'MedicationName'           => $this->request->getPost('MedicationName'),
                    'Dosage'                   => $this->request->getPost('Dosage'),
                    'updated_at'               => date('Y-m-d H:i:s'), // Capture the current timestamp
                ];
    
                // Update physician details
                if ($MedicationModel->update($medicationID, $updatedData)) {
                    session()->setFlashdata('success', 'Medication details updated successfully.');
                    return redirect()->to('medication');
                } else {
                    session()->setFlashdata('error', 'Failed to update medication details.');
                }
            }
        }
    
        // Fetch physician details for GET request
        $medicationID = $this->request->getGet('id');
        $MedicationDetails = $MedicationModel->where('MD5(CONCAT(MedicationID, "edit"))', $medicationID)->first();
    
        if (!$MedicationDetails) {
            session()->setFlashdata('error', 'Unable to find physician.');
            return redirect()->to('medication');
        }
    
        $data['MedicationDetails'] = $MedicationDetails;
        return view('layout/header',  $data) .
               view('medication/edit', $data) .
               view('layout/footer', $data);
    }
}