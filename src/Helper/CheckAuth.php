<?php

namespace Api\Helper;

use Exception;
use Firebase\JWT\JWT;

class CheckAuth
{
    public static function validToken(): bool
    {
        try {
            $httpHeader = apache_request_headers();
            isset($httpHeader['Authorization']) ? $token = str_replace(
                'Bearer ',
                '',
                $httpHeader['Authorization']
            ) : $token = false;
            json_encode(JWT::decode($token, JWTKEY, ['HS256']));
            return true;
        } catch (Exception) {
            http_response_code(404);
            echo json_encode(
                [
                    'data' => false,
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Token inválido ou inexistente'
                ],
                JSON_UNESCAPED_UNICODE
            );
            exit();
        }
    }
}
