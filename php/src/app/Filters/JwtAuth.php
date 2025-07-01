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
                ->setJSON(['error' => 'JWT Token not provided.'])
                ->setStatusCode(401);
        }

        $token = explode(' ', $authHeader)[1];
        $decoded = validateJWT($token);

        if (!$decoded) {
            return service('response')
                ->setJSON(['error' => 'Invalid or expired JWT Token.'])
                ->setStatusCode(401);
        }

        $request->user = $decoded;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {

    }

}
