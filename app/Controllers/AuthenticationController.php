<?php

namespace App\Controllers;

use App\Models\UserModel;


use CodeIgniter\I18n\Time; 
class AuthenticationController extends BaseController
{
    protected $userModel;

   


    public function __construct()
    {
        $this->userModel = new UserModel();
      
      
        helper('form'); 
    }
   
    public function login()
    {
        $data['title'] = 'Login';
    
        // Initialize the session variable for login attempts if not already set
        if (!session()->has('loginAttempts')) {
            session()->set('loginAttempts', 0);
        }
    
        // Check if the form was submitted via POST
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'Username' => ['label' => 'Username', 'rules' => 'required|alpha_numeric'],
                'Password' => ['label' => 'Password', 'rules' => 'required'],
            ];
    
            // Validate the form data
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // Get username and password from the POST request
                $username = $this->request->getPost('Username');
                $result = $this->userModel->where('Username', $username)->first();
    
                // Check if the user exists
                if ($result) {
                    // Check if the user is active
                    if ($result->Status == 0) {
                        session()->setFlashdata('error', 'User is inactive. Please contact the Administrator.');
                        return redirect()->back()->withInput();
                    }
    
                    // Verify the provided password
                    if (password_verify($this->request->getPost('Password'), $result->Password)) {
                        // User authenticated successfully
                        session()->set('isLoggedIn', true);
                        session()->set('userData', $result); // Storing the full user object directly

                        
    
                        // Clear login attempts upon successful login
                        session()->remove('loginAttempts');
    
                        // Redirect to the dashboard
                        return redirect()->to('dashboard');
                    } else {
                        // Incorrect password, increment login attempts
                        session()->set('loginAttempts', session()->get('loginAttempts') + 1);
                        $this->handleLoginAttempts();
                    }
                } else {
                    // Username not found, increment login attempts
                    session()->set('loginAttempts', session()->get('loginAttempts') + 1);
                    session()->setFlashdata('error', 'The provided Username does not exist. Please check and try again.');
                    $this->handleLoginAttempts();
                }
            }
        }
    
        return view('layout/loginheader', $data) . view('login', $data);
    }
    
    
    /**
     * Handle login attempts and display error if max attempts are exceeded.
     */
    private function handleLoginAttempts()
    {
        if (session()->get('loginAttempts') >= 3) {
            session()->setFlashdata('error', 'Exceeded maximum login attempts. PLEASE TRY AGAIN');
            return redirect()->back()->withInput();
        } else {
            return redirect()->back()->withInput();
        }
    }
    
    
    


    
    public function logout()
    {
        $userId = session('userData.UserID'); // Use 'userData.UserID' to get the UserID
    
        session()->destroy();
        return redirect()->to('login');
    }
    
}
