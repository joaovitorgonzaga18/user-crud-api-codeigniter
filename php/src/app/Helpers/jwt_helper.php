<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateJWT($user) {

    $key = getenv('JWT_SECRET');
    $payload = [
        'iss' => 'localhost',
        'aud' => 'localhost',
        'iat' => time(),
        'nbf' => time(),
        'exp' => time() + getenv('JWT_EXPIRATION_TIME'), // 1 hour
        'uid' => $user->id,
        'email' => $user->email,
        'level' => $user->access_level,
    ];

    return JWT::encode($payload, $key, 'HS256');
}

function validateJWT($token) {
    try {
        return JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
    } catch (\Exception $e) {
        return null;
    }
}
