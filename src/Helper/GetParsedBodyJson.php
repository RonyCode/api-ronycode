<?php

namespace Api\Helper;

use Exception;

class GetParsedBodyJson
{

    public function __construct()
    {
    }

    public function getParsedPost($request): array
    {
        try {
            $arrPost = $request->getParsedBody();
            isset($arrPost) ? $keysPost = Key($arrPost) : throw new Exception();
            $keysSanitize = str_replace([',', "\"", "}", "}", "{",], ':', $keysPost);
            $convertPostToArray = array_values(array_filter(explode(':', $keysSanitize)));
            $keys = [];
            $values = [];
            foreach ($convertPostToArray as $key => $value) {
                if ($key % 2 == 0) {
                    unset($convertPostToArray[$key]);
                    $keys[] = $value;
                } else {
                    $values[] = $value;
                }
            }
            $arrayCombined[] = array_combine($keys, $values);
            foreach ($arrayCombined as $postFim) {
                $returnPost = $postFim;
            }
            return $returnPost;
        } catch (Exception) {
            http_response_code(404);
            return [
                'data' => false,
                'status' => 'error',
                'code' => 404,
                'message' => 'Parâmetros inválidos ou error nos verbos HTTPs'
            ];
        }
    }
}
