<?php

namespace App\Helpers;

use Firebase\JWT\JWT;

trait JwtIssuer
{
    public function JwtIssuer($user)
    {
        $payload = [
            'iss' => 'p2p-jwt', // Issuer of the token
            'phonenumber' => $user['phonenumber'],
            'walletId' => getWalletId($user['phonenumber']),
            'fullname' => $user['fullname'],
            'status' => $user['status'],
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 3600 * 60, // Expiration time
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }
}
