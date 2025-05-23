<?php

namespace App\Controllers\admin;

use CodeIgniter\Controller;
use App\Models\admin\AdminUserModel;
use App\Models\PlanModel;
use App\Models\UserModel;

use CodeIgniter\RESTful\ResourceController;
class AdminController extends ResourceController
{
    public function index()
    {
        
        if (session()->get('isAdminLoggedIn')) {
            return view('admin/dashboard');
        }
        return redirect()->to('admin/login');
    }
    public function settings(){
        return view('admin/settings');

    }

    public function login()
    {
        return view('admin/login');
    }

    public function authenticate()
    {
        $model = new AdminUserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                session()->set([
                    'isAdminLoggedIn' => true,
                    'username' => $user['username']
                ]);
                return redirect()->to('/admin');
            } else {
                session()->setFlashdata('error', 'Invalid password.');
            }
        } else {
            session()->setFlashdata('error', 'User not found.');
        }
        return redirect()->to('admin/login');
    } 

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login');
    }

    public function createAdmin()
    {
        $adminModel = new AdminUserModel();
        $data = $this->request->getJSON(true); // Get input data as an associative array

        // Validate input data
        if (!$this->validate([
            'username' => 'required|min_length[3]|max_length[20]',
            'email'    => 'required|valid_email|is_unique[admin_users.email]',
            'password' => 'required|min_length[8]',
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Hash the password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Insert admin user into the database
        $adminId = $adminModel->insert($data);

        if (!$adminId) {
            return $this->failServerError('Failed to create admin.');
        }

        return $this->respondCreated([
            'message' => 'Admin user created successfully.',
            'admin_id' => $adminId,
        ]);
    }
    public function getPlans()
    {
        $planModel = new PlanModel();
        $plans = $planModel->getActivePlans(); // Fetch only active plans

        return view('admin/plans/list', ['plans' => $plans]);
    }

    public function postPlans()
    {
        $planModel = new PlanModel();
        $plans = $planModel->findAll();

        return view('admin/plans/create', ['plans' => $plans]);
    }

    public function getUsers(){
        
        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('admin/users/list', ['users' => $users]);
    }
}
