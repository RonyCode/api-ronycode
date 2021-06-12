<?php

//CONFIG OF DATABASE
const DBDRIVE = 'mysql';
const DBHOST = 'localhost';
const DBNAME = 'projeto_db';
const DBUSER = 'root';
const DBPASS = '170286P@ra';

///CONFIG DATA JWT
const JWTKEY = 'Ronyc0d3';

/// CONFIG PHPMAILER
const    HOST_MAIL = 'smtp.gmail.com';
const    PORT_MAIL = '587';
const    USER_MAIL = 'espaco.educar.palmas@gmail.com';
const    PASS_MAIL = 'woapqaboslwicuai';
const    FROM_NAME_MAIL = 'Espaço Educar';
const    FROM_EMAIL_MAIL = 'espaco.educar.palmas@gmail.com';
const    SUBJET_MAIL = 'Email solicitação recuperação de senha.';
const    ALT_BODY = 'Email solicitação recuperação de senha.Caso o remetente não use HTML';

//CONFIG BODY HTML FOR EMAIL
const BODY = "<div>
<p>Email para recuperar sua senha</p>
<a href='localhost/api-ronycode/public/login/recuperar/?hash=12345'>Clique aqui </a>
</div>";
