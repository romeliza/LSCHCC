<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $isLoggedIn = $session->get('isLoggedIn');
        $userId = $session->get('userID'); // Assuming you have userID in session
    
        if (!$isLoggedIn) {
            return redirect()->to('login');
        }
    
        // Check the user's status
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($userId);
    
        // Log the user data for debugging
        log_message('debug', 'User Data: ' . print_r($user, true));
    
        if ($user && isset($user['Status']) && $user['Status'] == 0) {
            // Log the user out
            $session->destroy();
            
            // Redirect to login with a message
            return redirect()->to('login')->with('error', 'Account is Inactive');
        }

        // Check for user role based on route argument
        if ($arguments) {
            // Checking role-based access
            $roleRequired = $arguments[0]; // Assuming role is passed as argument to route
            if ($user['Role'] != $roleRequired) {
                // Redirect if the user does not have the required role
                return redirect()->to('access-denied');
            }
        }
    }
    

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
