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
            $request->getParsedBody() !== null ? $arrPost = $request->getParsedBody() : throw new Exception();
            $keysPost = Key($arrPost);
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
            return [
                'data' => false,
                'status' => 'error',
                'code' => 404,
                'message' => 'Não autenticado ou error nos verbos HTTPs'
            ];
        }
    }
}
