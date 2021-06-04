<?php

namespace Api\Helper;

use Firebase\JWT\JWT;

class CheckAuth
{
    public static function validToken(): bool
    {
        $httpHeader = apache_request_headers();
        isset($httpHeader['Authorization']) ? $token = str_replace(
            'Bearer ',
            '',
            $httpHeader['Authorization']
        ) : $token = false;
        return JWT::decode($token, JWTKEY, ['HS256']);
    }
}
