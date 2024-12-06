<?php

namespace App\Controllers;

use App\Models\PhysicianModel;
use CodeIgniter\Controller;

class PhysicianController extends BaseController
{
    protected $validation;

    public function __construct()
    {
        helper("form");

        // Check if the user is logged in, redirect to login if not
        if (!session()->has('UserID')) {
            return redirect()->to('/login');
        }
    }

    // Display the list of physicians
    public function index()
    {
        $PhysicianModel = new PhysicianModel();
        $data = [
            "PhysicianData" => $PhysicianModel->orderBy('created_at', 'DESC')->findAll(),
            "title" => "Physician Management"
            
        ];

        // Load the view
        return view('layout/header', $data) .
      
            view('physician/index', $data) .
               view('physician/view', $data) .
       
            view('layout/footer', $data);
    }

    // Add a new physician
    public function add()
    {
        $data['title'] = 'Add Physician';
        $PhysicianModel = new PhysicianModel();
    
        if ($this->request->getMethod() === 'POST') {
            // Adjust the validation rules to match the form fields
            $rules = [
                'Lastname'     => ['label' => 'Last Name', 'rules' => 'required'],
                'Firstname'    => ['label' => 'First Name', 'rules' => 'required'],
                'ContactNumber' => ['label' => 'Phone Number', 'rules' => 'required|numeric|min_length[10]|max_length[15]'],
                'Email'        => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'Specialization' => ['label' => 'Specialization', 'rules' => 'required'],
            ];
    
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $newPhysicianData = [
                    'Lastname'     => strtoupper($this->request->getPost('Lastname')),
                    'Firstname'    => strtoupper($this->request->getPost('Firstname')),
                    'Middlename'   => strtoupper($this->request->getPost('Middlename')),
                    'ContactNumber' => $this->request->getPost('ContactNumber'),
                    'Specialization' => strtoupper($this->request->getPost('Specialization')),
                    'Email'        => $this->request->getPost('Email'),
                    'created_at'   => date('Y-m-d H:i:s')
                ];
    
                // Insert new physician record
                $PhysicianModel->insert($newPhysicianData);
    
                session()->setFlashdata('success', 'Physician successfully added.');
                return redirect()->to('physician');
            }
        }
    
        return view('layout/header', $data) . 
               view('physician/add', $data) .
               view('layout/footer', $data);
    }
    

    public function edit()
    {
        $PhysicianModel = new PhysicianModel();
        $data['title'] = 'Edit Physician';
    
        // Handle POST request for updating physician details
        if ($this->request->getMethod() === 'POST') {
            $physicianID = $this->request->getPost('physicianID'); // Ensure name matches form
    
            log_message('debug', 'Physician ID for update: ' . $physicianID);
    
            // Validation rules
            $rules = [
                'Lastname'      => 'required',
                'Firstname'     => 'required',
                'ContactNumber' => 'required|numeric|min_length[10]|max_length[15]',
                'Email'         => 'required|valid_email',
                'Specialization'=> 'required',
            ];
    
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // Prepare updated data
                $updatedData = [
                    'Lastname'      => strtoupper($this->request->getPost('Lastname')),
                    'Firstname'     => strtoupper($this->request->getPost('Firstname')),
                    'Middlename'    => strtoupper($this->request->getPost('Middlename')),
                    'ContactNumber' => $this->request->getPost('ContactNumber'),
                    'Specialization'=> strtoupper($this->request->getPost('Specialization')),
                    'Email'         => $this->request->getPost('Email'),
                ];
    
                // Update physician details
                if ($PhysicianModel->update($physicianID, $updatedData)) {
                    session()->setFlashdata('success', 'Physician details updated successfully.');
                    return redirect()->to('physician');
                } else {
                    session()->setFlashdata('error', 'Failed to update physician details.');
                }
            }
        }
    
        // Fetch physician details for GET request
        $physicianID = $this->request->getGet('id');
        $PhysicianDetails = $PhysicianModel->where('MD5(CONCAT(PhysicianID, "edit"))', $physicianID)->first();
    
        if (!$PhysicianDetails) {
            session()->setFlashdata('error', 'Unable to find physician.');
            return redirect()->to('physician');
        }
    
        $data['PhysicianDetails'] = $PhysicianDetails;
        return view('layout/header',  $data) .
             
               view('physician/edit', $data) .
               view('layout/footer', $data);
    }
    
    // Delete a physician
    public function delete()
    {
        // Load the Physician model
        $PhysicianModel = new PhysicianModel();
    
        if ($this->request->getMethod() === 'POST') {
            $physicianID = $this->request->getPost('PhysicianID');
            $rules = [
                'PhysicianID' => 'required',
            ];
           
            if (!$this->validate($rules)) {
                session()->setFlashdata('error', 'Invalid Physician ID.');
                return redirect()->to('physician');
            }
    
            $existingPhysician = $PhysicianModel->find($physicianID);
            if ($existingPhysician) {
              
                $fullName = "{$existingPhysician->Firstname} {$existingPhysician->Lastname} {$existingPhysician->Middlename}";
    
                // Attempt to delete the physician
                $result = $PhysicianModel->delete($physicianID);
                if ($result) {
                    session()->setFlashdata('success', 'Physician successfully deleted.');
                    return redirect()->to('physician');
                } else {
                    session()->setFlashdata('error', 'Physician failed to delete.');
                    return redirect()->to('physician');
                }
            } else {
                session()->setFlashdata('error', 'Physician not found.');
                return redirect()->to('physician');
            }
        }
    
        // Redirect back if the request method is not POST
        return redirect()->to('physician');
    }
    
}
