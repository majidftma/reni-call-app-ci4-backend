<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\WalletModel;
use App\Models\LanguageModel;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $format = 'json';

    public function create()
    {
        $userModel = new UserModel();
        $walletModel = new WalletModel();
        $languageModel = new LanguageModel();

        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'name' => 'required|string|max_length[255]',
            'mobile' => 'required|string|max_length[15]|is_unique[users.mobile]',
            'age' => 'required|integer|greater_than[0]',
            'preferred_language' => 'required|integer|greater_than[0]', // Assuming preferred_language refers to language_id
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $language = $languageModel->find($data['preferred_language']);
        if (!$language) {
            return $this->failNotFound('Invalid preferred_language ID.');
        }

        $userId = $userModel->insert($data);
        if (!$userId) {
            return $this->failServerError('Failed to create user.');
        }

        $walletData = [
            'user_id' => $userId,
            'balance' => 100.00,
        ];

        if (!$walletModel->insert($walletData)) {
            $userModel->delete($userId);
            return $this->failServerError('Failed to create wallet for the user.');
        }

        return $this->respondCreated([
            'message' => 'User and wallet created successfully.',
            'user_id' => $userId,
        ]);
    }

    public function createOrUpdateUser()
    {
        $walletModel = new WalletModel();
        $userModel = new UserModel();
        $mobile = $this->request->getVar('mobile');

        if (!$mobile) {
            return $this->fail('Mobile number is required', 400);
        }
        $user = $userModel->where('mobile', $mobile)->first();
        $data = [
            'name' => $this->request->getVar('name'),
            'dob' => $this->request->getVar('dob'),
            'preferred_language' => $this->request->getVar('preferred_language'),
            'last_login' => date('Y-m-d H:i:s')
        ];

        if ($user) {
            // Update existing user
            $updated = $userModel->update($user['id'], $data);
    
            if (!$updated) {
                return $this->fail('Update failed', 500);
            }
            $userId = $user['id'];
            // return $userModel->find($user['id']);
            if (!$userId) {
                return $this->failServerError('Failed to create user.');
            }
    
            $walletData = [
                'user_id' => $userId,
                'balance' => 100.00,
            ];
    
            if (!$walletModel->insert($walletData)) {
                $userModel->delete($userId);
                return $this->failServerError('Failed to create wallet for the user.');
            }
    
            return $this->respondCreated([
                'message' => 'User and wallet Updated successfully.',
                'user_id' => $userId,
            ]);
        } else {
            // Create new user
            $data['mobile'] = $mobile;
            $data['row_creayedAt'] = date('Y-m-d H:i:s');
            $userId = $userModel->insert($data);
            // return $userModel->find($userId);
            

            return $this->respondCreated([
                'message' => 'User and wallet created successfully.',
                'user_id' => $userId,
            ]);
        }
    }

    public function getUsers()
    {
        $userModel = new UserModel();
        $languageModel = new LanguageModel();

        $users = $userModel->findAll();

        if (!$users) {
            return $this->failNotFound('No users found.');
        }

        // Add language names to each user
        foreach ($users as &$user) {
            $language = $languageModel->find($user['preferred_language']);
            $user['language'] = $language ? $language['name'] : null;
        }

        return $this->respond($users);
    }

    public function getUserById($id = null)
    {
        $userModel = new UserModel();
        $languageModel = new LanguageModel();

        $user = $userModel->find($id);
        if (!$user) {
            return $this->failNotFound("User with ID $id not found.");
        }

        $language = $languageModel->find($user['preferred_language']);
        $user['language'] = $language ? $language['name'] : null;

        return $this->respond($user);
    }
}
