<?php

namespace App\Controllers;

use App\Models\ActivityLogModel;
use App\Models\UserModel;
use App\Models\DancerModel;
use App\Models\AdministratorModel;
use App\Models\CoachModel;
class UserController extends BaseController
{
    protected $validation;

    public function __construct()
    {
        helper("form");
        if (!session()->has('UserID')) {
            return redirect()->to('/login');
        }
    } 
    public function index()
    {
       
        $UserModel = new UserModel();
        $data = [
            "UserData" => $UserModel->orderBy('Updated_at', 'DESC')->findAll(),
            "title" => "User Management"
        ];
        return view('layout/header', $data) .
               view('user/view', $data) .
               view('user/index', $data) .
               view('user/delete', $data) .
               view('layout/footer', $data);
    }
    public function add()
    {
        $data['title'] = 'User Add';
        $UserModel = new UserModel();
    
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'LastName' => ['label' => 'Last Name', 'rules' => 'required'],
                'FirstName' => ['label' => 'First Name', 'rules' => 'required'],
                'MiddleName' => ['label' => 'Middle Name', 'rules' => 'required'],
                'region' => ['label' => 'Region', 'rules' => 'required'],
                'province' => ['label' => 'Province', 'rules' => 'required'],
                'municipality' => ['label' => 'Municipality', 'rules' => 'required'],
                'barangay' => ['label' => 'Barangay', 'rules' => 'permit_empty'],
                'Username' => ['label' => 'Username', 'rules' => 'required|alpha_numeric|is_unique[user_tbl.Username]'],
                'PhoneNumber' => ['label' => 'Phone Number', 'rules' => 'required|numeric|min_length[10]|max_length[11]|is_unique[user_tbl.PhoneNumber]'],
                'Role' => ['label' => 'Role', 'rules' => 'required'],
                'Password' => ['label' => 'Password', 'rules' => 'required|min_length[8]'],
                'ConfirmedPassword' => [
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[Password]',
                ],
            ];
    
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $username = strtolower($this->request->getPost('Username'));
                $existingUser = $UserModel->where('LOWER(Username)', $username)->first();
                $phoneNumber = $this->request->getPost('PhoneNumber');
                $existingPhoneNumber = $UserModel->where('PhoneNumber', $phoneNumber)->first();
    
                if ($existingUser) {
                    $data['validation'] = $this->validator;
                    $data['validation']->setError('Username', 'Username already exists.');
                } elseif ($existingPhoneNumber) {
                    $data['validation'] = $this->validator;
                    $data['validation']->setError('PhoneNumber', 'Phone Number already exists.');
                } else {
                    $password = password_hash($this->request->getPost('Password'), PASSWORD_DEFAULT);
                    $newUserData = [
                        'LastName' => strtoupper($this->request->getPost('LastName')),
                        'FirstName' => strtoupper($this->request->getPost('FirstName')),
                        'MiddleName' => strtoupper($this->request->getPost('MiddleName')),
                        'region' => strtoupper($this->request->getPost('region')),
                        'province' => strtoupper($this->request->getPost('province')),
                        'municipality' => strtoupper($this->request->getPost('municipality')),
                        'barangay' => strtoupper($this->request->getPost('barangay')),
                        'Username' => $this->request->getPost('Username'),
                        'Role' => $this->request->getPost('Role'),
                        'PhoneNumber' => $phoneNumber,
                        'Password' => $password,
                        'Status' => 1,
                    ];
    
                    $userID = $UserModel->insert($newUserData);
                    if ($userID) {
                        session()->setFlashdata('success', 'User successfully added.');
                        return redirect()->to('user');
                    } else {
                        session()->setFlashdata('error', 'User failed to add.');
                    }
                }
            }
        }
        return view('layout/header', $data) .
            view('locations', $data) .
            view('user/add', $data) .
            view('layout/footer', $data);
    }
    
    public function edit()
    {
        $UserModel = new UserModel();
        $data['title'] = 'User Edit';
    
        if ($this->request->getMethod() === 'POST') {
            $userId = $this->request->getPost('UserID');
    
            $rules = [
                'UserID' => 'required',
                'LastName' => ['label' => 'Last Name', 'rules' => 'required'],
                'FirstName' => ['label' => 'First Name', 'rules' => 'required'],
                'MiddleName' => ['label' => 'Middle Name', 'rules' => 'required'],
                'Username' => 'required|alpha_numeric|is_unique[user_tbl.Username,UserID,' . $userId . ']',
                'region' => ['label' => 'Region', 'rules' => 'required'],
                'province' => ['label' => 'Province', 'rules' => 'required'],
                'municipality' => ['label' => 'Municipality', 'rules' => 'required'],
                'barangay' => ['label' => 'Barangay', 'rules' => 'permit_empty'],
                'PhoneNumber' => 'required|numeric|min_length[11]|max_length[11]|is_unique[user_tbl.PhoneNumber,UserID,' . $userId . ']',
                'Role' => ['label' => 'Role', 'rules' => 'required'],
                'Password' => 'permit_empty',
                'ConfirmedPassword' => 'permit_empty|matches[Password]',
            ];
    
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $existingUser = $UserModel->find($userId);
    
                if ($existingUser) {
                 
                    $newRole = $this->request->getPost('Role');
    
                    $update_data = [
                        'LastName' => strtoupper($this->request->getPost('LastName')),
                        'FirstName' => strtoupper($this->request->getPost('FirstName')),
                        'MiddleName' => strtoupper($this->request->getPost('MiddleName')),
                        'region' => strtoupper($this->request->getPost('region')),
                        'province' => strtoupper($this->request->getPost('province')),
                        'municipality' => strtoupper($this->request->getPost('municipality')),
                        'barangay' => strtoupper($this->request->getPost('barangay')),
                        'Username' => $this->request->getPost('Username'),
                        'PhoneNumber' => $this->request->getPost('PhoneNumber'),
                        'Role' => $newRole,
                    ];
    
                    if ($this->request->getPost('Password')) {
                        $update_data['Password'] = password_hash($this->request->getPost('Password'), PASSWORD_DEFAULT);
                    }
    
                    $result = $UserModel->update($userId, $update_data);
                    if ($result) {
                        session()->setFlashdata('success', 'User successfully updated.');
                        return redirect()->to('user');
                    } else {
                        session()->setFlashdata('error', 'User failed to update.');
                    }
                } else {
                    session()->setFlashdata('error', 'User not found for update.');
                    return redirect()->to('user');
                }
            }
        }
    
        $userId = $this->request->getGet('id');
        $UserDetails = $UserModel->where('MD5(CONCAT(UserID, "edit"))', $userId)->first();
    
        if (!$UserDetails) {
            session()->setFlashdata('error', 'Unable to find user.');
            return redirect()->to('user');
        }
    
        $data['UserDetails'] = $UserDetails;
    
        return view('layout/header', $data) .
            view('locations', $data) .
            view('user/edit', $data) .
            view('layout/footer', $data);
    }
    

    public function delete()
    {
       
        $UserModel = new UserModel();
    
        if ($this->request->getMethod() === 'POST') {
            $userID = $this->request->getPost('UserID');
            $rules = [
                'UserID' => 'required',
            ];
    
            if (!$this->validate($rules)) {
                session()->setFlashdata('error', 'Invalid User ID.');
                return redirect()->to('user');
            }
            $existingUser = $UserModel->find($userID);
            if ($existingUser) {
                if ($existingUser->UserID == session()->get('UserID')) {
                    session()->setFlashdata('error', 'You cannot delete your own account.');
                    return redirect()->to('user');
                }
    
              
                $fullName = "{$existingUser->FirstName} {$existingUser->LastName} {$existingUser->MiddleName}";
                $result = $UserModel->delete($userID);
                if ($result) {
                   
                    session()->setFlashdata('success', 'User successfully deleted.');
                    return redirect()->to('user');
                } else {
                    session()->setFlashdata('error', 'User failed to delete.');
                    return redirect()->to('user');
                }
            } else {
                session()->setFlashdata('error', 'User not found.');
                return redirect()->to('user');
            }
        }
    
        return redirect()->to('user');
    }
    public function toggleStatus()
    {
        $UserModel = new UserModel();
        if ($this->request->getMethod() === 'POST') {
            $userID = $this->request->getPost('UserID');
            $rules = [
                'UserID' => 'required|is_numeric',
            ];

            if (!$this->validate($rules)) {
                return redirect()->to('user')->with('error', 'Invalid User ID.');
            }

            $result = $UserModel->toggleStatus($userID);
            if ($result) {
               
                return redirect()->to('user')->with('success', 'User status updated successfully.');
            } else {
                return redirect()->to('user')->with('error', 'Failed to toggle user status.');
            }
        }
        return redirect()->to('user');
    }

  
}
