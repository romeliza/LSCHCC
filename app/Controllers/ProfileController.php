<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ActivityLogModel;

class ProfileController extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        helper("form");
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $userSessionData = session()->get('userData');
        if (!$userSessionData || !isset($userSessionData->UserID)) {
            return redirect()->to('login')->with('error', 'Session expired. Please log in again.');
        }
        $userID = $userSessionData->UserID;
        $user = $this->userModel->find($userID);
        if ($user) {
            $data = [
                "title" => "Profile Account",
                "user" => $user,
            ];
            return view('layout/header', $data)
                 . view('locations', $data)
                 . view('profile/index', $data)
                 . view('layout/footer', $data);
        } else {
            return redirect()->to('error')->with('error', 'User not found.');
        }
    }
    

    public function edit()
    {
        $userId = $this->request->getPost('UserID');

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'UserID' => 'required',
                'LastName' => ['label' => 'Last Name', 'rules' => 'required'],
                'FirstName' => ['label' => 'First Name', 'rules' => 'required'],
                'MiddleName' => ['label' => 'Middle Name', 'rules' => 'required'],
                'Username' => [
                    'rules' => 'required|is_unique[user_tbl.Username,UserID,{UserID}]',
                    'label' => 'Username'
                ],
                'Password' => [
                    'rules' => 'permit_empty|min_length[6]',
                    'label' => 'New Password'
                ],
                'ConfirmedPassword' => [
                    'rules' => 'permit_empty|matches[Password]',
                    'label' => 'Confirm Password'
                ],
                'PhoneNumber' => [
                    'rules' => 'required|min_length[10]|max_length[15]',
                    'label' => 'Contact Number'
                ],
                'region' => ['label' => 'Region', 'rules' => 'required'],
                'province' => ['label' => 'Province', 'rules' => 'required'],
                'municipality' => ['label' => 'Municipality', 'rules' => 'required'],
                'barangay' => ['label' => 'Barangay', 'rules' => 'permit_empty'],
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            $updateData = [
                'LastName' => strtoupper($this->request->getPost('LastName')),
                'FirstName' => strtoupper($this->request->getPost('FirstName')),
                'MiddleName' => strtoupper($this->request->getPost('MiddleName')),
                'Username' => $this->request->getPost('Username'),
                'PhoneNumber' => $this->request->getPost('PhoneNumber'),
                'region' => strtoupper($this->request->getPost('region')),
                'province' => strtoupper($this->request->getPost('province')),
                'municipality' => strtoupper($this->request->getPost('municipality')),
                'barangay' => strtoupper($this->request->getPost('barangay')),
            ];

            if ($this->request->getPost('Password')) {
                $updateData['Password'] = password_hash($this->request->getPost('Password'), PASSWORD_DEFAULT);
            }

            if ($this->userModel->update($userId, $updateData)) {
                $user = $this->userModel->find($userId);
                $this->session->set('userData', (object) $user);
                $this->session->setFlashdata('success', 'Profile successfully updated.');
             
            } else {
                $this->session->setFlashdata('error', 'Failed to update profile.');
            }

            return redirect()->to('profile');
        }

        $userData = $this->userModel->find($userId);
        return view('profile/index', ['user' => $userData]).   view('locations',['user' => $userData]) ;
    }

    public function deactivate()
    {
        $userData = $this->session->get('userData');

        if (isset($userData->UserID)) {
            $userId = $userData->UserID;

            $this->userModel->update($userId, ['Status' => 0]);
            $this->session->setFlashdata('success', 'User has been successfully deactivated.');
            $this->session->destroy();

            return redirect()->to('login');
        }

        return redirect()->back()->with('error', 'User data not found. Please log in again.');
    }

 
}
