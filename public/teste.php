<?php

//closure ROTAS

$rotas = function ($name) {
    echo $name;
};
$name = 'Rony';

call_user_func($rotas, $name);
