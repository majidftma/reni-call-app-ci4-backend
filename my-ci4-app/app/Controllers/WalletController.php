<?php
namespace App\Controllers;

use App\Models\WalletModel;
use CodeIgniter\RESTful\ResourceController;

class WalletController extends ResourceController
{
    protected $walletModel;

    public function __construct()
    {
        $this->walletModel = new WalletModel();
    }

    public function getBalance($user_id)
    {
        $wallet = $this->walletModel->where('user_id', $user_id)->first();
        
        if (!$wallet) {
            return $this->failNotFound('Wallet not found');
        }

        return $this->respond(['balance' => $wallet['balance']]);
    }

    public function creditWallet()
    {
        $user_id = $this->request->getPost('user_id');
        $amount = $this->request->getPost('amount');

        if (!$user_id || !$amount || $amount <= 0) {
            return $this->fail('Invalid request data', 400);
        }

        $wallet = $this->walletModel->where('user_id', $user_id)->first();

        if (!$wallet) {
            $this->walletModel->insert(['user_id' => $user_id, 'balance' => $amount]);
        } else {
            $newBalance = $wallet['balance'] + $amount;
            $this->walletModel->update($wallet['id'], ['balance' => $newBalance]);
        }

        return $this->respond(['message' => 'Wallet credited successfully', 'balance' => $newBalance]);
    }

    public function debitWallet()
    {
        $user_id = $this->request->getPost('user_id');
        $amount = $this->request->getPost('amount');

        if (!$user_id || !$amount || $amount <= 0) {
            return $this->fail('Invalid request data', 400);
        }

        $wallet = $this->walletModel->where('user_id', $user_id)->first();

        if (!$wallet || $wallet['balance'] < $amount) {
            return $this->fail('Insufficient balance', 400);
        }

        $newBalance = $wallet['balance'] - $amount;
        $this->walletModel->update($wallet['id'], ['balance' => $newBalance]);

        return $this->respond(['message' => 'Wallet debited successfully', 'balance' => $newBalance]);
    }
}

