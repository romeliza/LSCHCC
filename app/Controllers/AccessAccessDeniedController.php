<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AccessDeniedController extends Controller
{
    public function index()
    {
        return view('access/access-denied');
    }
}
