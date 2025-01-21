<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DocsController extends Controller
{
    public function index()
    {
        // Render the otpdoc.php view located in app/Views/docs/
        return view('api-docs/otpController');
    }
}
