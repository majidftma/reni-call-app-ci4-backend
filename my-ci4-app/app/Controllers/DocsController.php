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

    public function userDoc(){
        return view('api-docs/userController');
    }
    public function plansDoc(){
        return view('api-docs/plansController');

    }
    public function paymentsDoc(){
        return view('api-docs/paymentsController');

    }

    public function languagesDoc(){
        return view('api-docs/languagesController');

    }

    public function walletsDoc(){
        return view('api-docs/walletController');

    }

    public function teleCallerDoc(){
        return view('api-docs/teleCallerController');

    }
}
