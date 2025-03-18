<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTokenModel extends Model
{
    protected $table = 'user_tokens';
    protected $primaryKey = 'user_id';
    
    protected $allowedFields = [
        'user_id',
        'refresh_token',
        'expires_at',
        'created_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = false;

    /**
     * Insert or Update Refresh Token
     */
    public function saveToken($userId, $refreshToken, $expiresAt)
    {
        $existingToken = $this->where('user_id', $userId)->first();

        if ($existingToken) {
            return $this->update($userId, [
                'refresh_token' => $refreshToken,
                'expires_at' => $expiresAt
            ]);
        } else {
            return $this->insert([
                'user_id' => $userId,
                'refresh_token' => $refreshToken,
                'expires_at' => $expiresAt
            ]);
        }
    }

    /**
     * Validate Refresh Token
     */
    public function validateToken($userId, $refreshToken)
    {
        return $this->where('user_id', $userId)
                    ->where('refresh_token', $refreshToken)
                    ->where('expires_at >=', date('Y-m-d H:i:s'))
                    ->first();
    }

    /**
     * Delete Token (for logout or token revocation)
     */
    public function deleteToken($userId)
    {
        return $this->where('user_id', $userId)->delete();
    }
}
