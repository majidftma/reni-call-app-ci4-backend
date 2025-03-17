<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeader('Authorization');

        if (!$header) {
            return response()->setJSON(['error' => 'Authorization header missing'])->setStatusCode(401);
        }

        $token = str_replace('Bearer ', '', $header->getValue());

        try {
            $key = getenv('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // Store user data in request for controller access
            $request->setGlobal('user', (array) $decoded);
        } catch (Exception $e) {
            return response()->setJSON(['error' => 'Invalid token'])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No changes after request
    }
}
