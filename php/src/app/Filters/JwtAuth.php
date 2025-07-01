<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class JwtAuth implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return service('response')
                ->setJSON(['status' => 401, 'messages' => ['error' => 'JWT Token not provided.']])
                ->setStatusCode(401);
        }

        $token = explode(' ', $authHeader)[1];
        $decoded = validateJWT($token);

        if (!$decoded) {
            return service('response')
                ->setJSON(['status' => 401, 'messages' => ['error' => 'Invalid or Expired JWT Token.']])
                ->setStatusCode(401);
        }

        $db = \Config\Database::connect();
        $blacklisted = $db->table('token_blacklist')
            ->where('token', $token)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->countAllResults();

        if ($blacklisted > 0) {
            return service('response')
                ->setJSON(['error' => 'JWT Token refused.'])
                ->setStatusCode(401);
        }

        $request->user = $decoded;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {

    }

}
