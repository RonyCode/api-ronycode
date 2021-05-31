<?php


namespace Api\Helper;


use Firebase\JWT\JWT;

class CheckAuth
{
    public static function validToken(): bool
    {
        $httpHeader = apache_request_headers();
        if (JWT::decode($httpHeader['Authorization'], JWTKEY, ['HS256'])) {
            return true;
        }
        return false;
    }
}
