<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\WalletModel;
use App\Models\LanguageModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\UserTokenModel;

class UserController extends ResourceController
{
    protected $format = 'json';
    protected $walletModel;
    protected $userModel;
    protected $languageModel;

    public function __construct()
    {
        $this->walletModel = new WalletModel();
        $this->userModel = new UserModel();
        $this->languageModel = new LanguageModel();


    }

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
            if(!$user['preferred_language']){
                continue;
            }
            $language = $languageModel->find($user['preferred_language']);
            $user['language'] = $language ? $language['name'] : null;

            $wallet = $this->walletModel->where('user_id', $user['id'])->first();
            $user['balance'] = $wallet['balance'];

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

    public function getUser()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');

        if (!$authHeader) {
            return $this->failUnauthorized('Access token is required');
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
            $user = $this->userModel->find($decoded->id);
            if (!$user) {
                return $this->failNotFound('User not found');
            }
            if(!$user['preferred_language']){
                return $this->fail('User Profile not completed, Add language', 500);


            }

            $language = $this->languageModel->find($user['preferred_language']);


            // $user['language'] = $language ? $language['name'] : null;
            $user['language'] = $language['name'] ?? null;


            $wallet = $this->walletModel->where('user_id', $user['id'])->first();
            if(!$wallet){
                return $this->fail('User Profile not completed, Wallet details not found', 500);


            }
            $user['balance'] = $wallet['balance'];



          

            return $this->respond($user);
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid or expired token'.$e->getMessage());
        }
    }

    public function updateOnlineStatus()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return $this->fail('Authorization token is required', 401);
        }

        $accessToken = $matches[1];
        $key = getenv('JWT_SECRET');

        try {
            $decoded = JWT::decode($accessToken, new Key($key, 'HS256'));
            $userId = $decoded->id;

            $status = $this->request->getVar('status');
            if (!in_array($status, [0, 1])) {
                return $this->fail('Invalid status value. Use 1 for online and 0 for offline.', 400);
            }

            $userModel = new UserModel();
            if ($userModel->updateOnlineStatus($userId, $status)) {
                return $this->respond(['message' => 'Online status updated successfully.']);
            }

            return $this->fail('Failed to update online status', 500);

        } catch (\Exception $e) {
            return $this->fail('Invalid access token', 401);
        }
    }
}
