<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generate_jwt($user)
{
    $key = getenv('JWT_SECRET'); // Store this securely
    $payload = [
        "id" => $user['id'],
        "mobile" => $user['mobile'],
        "exp" => time() + 3600 // Token expires in 1 hour
    ];
    
    return JWT::encode($payload, $key, 'HS256');
}

function validate_jwt($token)
{
    $key = getenv('JWT_SECRET');
    
    try {
        return JWT::decode($token, new Key($key, 'HS256'));
    } catch (Exception $e) {
        return null;
    }
}
