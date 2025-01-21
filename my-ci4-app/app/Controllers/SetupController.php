<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class SetupController extends Controller
{
    public function createAdmin()
    {
        $model = new UserModel();
        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_BCRYPT)
        ];
        $model->insert($data);
        echo "Admin user created.";
    }
}
