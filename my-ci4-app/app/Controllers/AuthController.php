<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\UserTokenModel;
use App\Models\UserModel;
class AuthController extends BaseController
{
    use ResponseTrait;

    // Generate Access Token & Refresh Token
    public function generateTokens($userId, $mobile)
    {
        $key = getenv('JWT_SECRET'); // JWT Secret from .env

        // Generate Access Token (expires in 1 hour)
        $accessTokenPayload = [
            "id" => $userId,
            "mobile" => $mobile,
            "iat" => time(), // Issued at
            "exp" => time() + 3600 // Token expires in 1 hour
        ];
        $accessToken = JWT::encode($accessTokenPayload, $key, 'HS256');

        // Generate Refresh Token (expires in 30 days)
        $refreshTokenPayload = [
            "id" => $userId,
            "mobile" => $mobile,
            "iat" => time(),
            "exp" => time() + 2592000 // Token expires in 30 days
        ];
        $refreshToken = JWT::encode($refreshTokenPayload, $key, 'HS256');

        // Save refresh token in the database
        $userTokenModel = new UserTokenModel();
        $userTokenModel->saveToken($userId, $refreshToken, date('Y-m-d H:i:s', time() + 2592000));

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ];
    }

    // Generate New Access and Refresh Tokens
    public function updateTokensWithRefreshToken()
    {
        $refreshToken = $this->request->getVar('refresh_token');

        if (!$refreshToken) {
            return $this->fail('Refresh token is required', 400);
        }

        $key = getenv('JWT_SECRET'); // JWT Secret from .env

        try {
            // Decode the provided Refresh Token
            $decoded = JWT::decode($refreshToken, new Key($key, 'HS256'));

            // Validate token details
            $userId = $decoded->id;
            $userModel = new UserModel();
            $user = $userModel->find($userId);

            if (!$user) {
                return $this->fail('User not found', 404);
            }else{
                return $this->fail('User  found'.$userId.''.$refreshToken.''.date('Y-m-d H:i:s'), 404);

            }

            // Check if the refresh token exists in the database
            $userTokenModel = new UserTokenModel();
            $tokenEntry = $userTokenModel->where('user_id', $userId)
                                         ->where('refresh_token', $refreshToken)
                                         ->where('expires_at >=', date('Y-m-d H:i:s'))
                                         ->first();

            if (!$tokenEntry) {
                return $this->fail('Invalid or expired refresh token', 401);
            }

            // Generate new tokens
            $newAccessTokenPayload = [
                "id" => $userId,
                "mobile" => $user['mobile'],
                "iat" => time(),
                "exp" => time() + 3600 // Expires in 1 hour
            ];
            $newAccessToken = JWT::encode($newAccessTokenPayload, $key, 'HS256');

            $newRefreshTokenPayload = [
                "id" => $userId,
                "mobile" => $user['mobile'],
                "iat" => time(),
                "exp" => time() + 2592000 // Expires in 30 days
            ];
            $newRefreshToken = JWT::encode($newRefreshTokenPayload, $key, 'HS256');

            // Update Refresh Token in Database
            $userTokenModel->update($tokenEntry['id'], [
                'refresh_token' => $newRefreshToken,
                'expires_at' => date('Y-m-d H:i:s', time() + 2592000)
            ]);

            return $this->respond([
                'access_token' => $newAccessToken,
                'refresh_token' => $newRefreshToken
            ]);

        } catch (\Exception $e) {
            return $this->fail('Invalid refresh token', 401);
        }
    }
}
