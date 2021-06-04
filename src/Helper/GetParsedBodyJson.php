<?php


namespace Api\Helper;


class GetParsedBodyJson
{

    public function __construct()
    {
    }

    public function getParsedPost($request): array
    {
        $arrPost = $request->getParsedBody();
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
    }
}
