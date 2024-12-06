<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session(); // Obtain the session instance

        if ($session->get('isLoggedIn')) {
            // Retrieve the user role from session data
            $userRole = $session->get('Role'); 

            // Redirect based on user role
            switch ($userRole) {
                case 'Administrator':
                case 'Registered Nurse':
                    return redirect()->to('dashboard');
                default:
                    // Redirect to a generic "access denied" or fallback page
                    return redirect()->to('dashboard');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Optional: Implement post-filter logic here
    }
}
