<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use Api\Infra\EmailForClient;

//Load Composer's autoloader
require '../vendor/autoload.php';
//
$body = "<div>
    <p>Clique no Link Abaixo de você solicitou a troca de senhar, esse link tem validade de 24horas após este prazo é
        preciso refazer o processo para recuperar sua senha</p>
    <a href='localhost/api-ronycode/public/login/resetar-senha/?hash=123'></a>
</div>";

$mail = (new EmailForClient())
    ->add('Teste de titulo email', $body, 'ronyandersonpc@gmail.com', 'Ronycode')
    ->send();
