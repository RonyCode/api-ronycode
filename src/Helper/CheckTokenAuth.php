<?php

namespace Api\Helper;

use Exception;

class CheckTokenAuth
{
    public static function validToken(): bool
    {
        try {
            $httpHeader = apache_request_headers();

            isset($httpHeader['Authorization']) &&
            str_contains($httpHeader['Authorization'], 'Bearer ') ? $token = str_replace(
                'Bearer ',
                '',
                $httpHeader['Authorization']
            ) : $token = false;

            $teste = (new JwtHandler())->jwtDecode($token);
            $teste[0] === false ? throw new Exception() : '';
            return $teste;
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
