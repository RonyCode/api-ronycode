<?php

use Api\Infra\GlobalConn;
use Api\Infra\UploadImages;
use Api\Model\Image;

require __DIR__ . "/../src/Model/Student.php";
require __DIR__ . "/../vendor/autoload.php";
//closure ROTAS

//$rotas = function ($name) {
//    echo $name;
//};
//$name = 'Rony';
//
//call_user_func($rotas, $name);
$pdo = GlobalConn::conn();

//$niv = new Student(
//    null,
//    'denis@sd345%$#$==+++<pre/>',
//    '(63)981270951',
//    'denis@gmail.com',
//    'sobradinho 2',
//    '17/02/1985',
//    'bacharelado em ciencias conabeis',
//    'ensino superior',
//    "28/05/2021",
//    "12/12/2021",
//    null
//);
//
//$user = new \Api\Model\User(null, 'rony@gmail.com', '17028PAR');
//
//var_dump($user->getEmail());
//var_dump($niv->getName());
//var_dump($niv->getBirthday());

//$test = "
//            <style>
//    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap');
//
//    .body_mail {
//        max-width: 70%;
//        max-height: 100vh;
//        display: grid;
//        background: url('https://i.ibb.co/rdK5Gtf/02.jpg') center / cover no-repeat;
//       grid-template-columns: 1fr 1fr;
//        grid-template-rows: 8rem auto auto 5rem;
//        z-index: -1;
//        margin: auto;
//    }
//
//    .header {
//        grid-column:  1/3;
//        grid-row: 1/1;
//        background: #3f271a;
//    }
//
//    .nav {
//        display: flex;
//        justify-content: space-between;
//        align-items: center;
//        margin: 1rem 2rem;
//    }
//
//    .nav_link {
//        text-decoration: none;
//        font-size: 1.5rem;
//        color: #f1f1f1;
//        font-family: 'Raleway Black', sans-serif;
//    }
//
//    .main {
//        grid-column:  1/3;
//        grid-row: 2/2;
//        background: #a71dbf;
//        width: 100%;
//        height: 50vh;
//    }
//
//    .colum_left {
//        background: red;
//        grid-column:  1/1;
//        grid-row: 3/3;
//    }
//
//    .colum_right {
//        grid-column:  2/3;
//        grid-row: 3/3;
//    }
//
//    .footer {
//        grid-column:  1/3;
//        grid-row: 4/4;
//        background: #e5f8d3;
//    }
//
//</style>
//
//<div class='body_mail'>
//
//  <div class='header'>
//    <nav class='nav'>
//      <img src='https://i.ibb.co/68nRmqb/logotipo-papagaiado.png' alt='logotipo' width='130' height='100'>
//      <a class='nav_link' href=''>Contato</a>
//    </nav>
//  </div>
//
//  <div class='main'>
//  </div>
//
//  <div class='colum_left'>
//    <h1>coluna esquerda</h1>
//  </div>
//
//  <div class='colum_right'>
//    <h1>Descrição</h1>
//    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
//    Culpa dolorum facilis itaque libero magni molestiae nemo nesciunt pariatur recusandae sequi!</p>
//  </div>
//
//  <footer class='footer'>
//    <p>Ronycode &copy;2021 todos os direitos reservados.</p>
//  </footer>
//
//</div>

//
$img = new Image($_FILES['photo'], 1, 300, 300);
$uploaded = (new UploadImages())->saveImgResized($img, true);
$imgName = $img->getPhotoSrc();
$imgSrc = $img->getPhotoSrc();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<h1>Fotos</h1>
<img src="<?= $imgSrc ?>" alt="">
<form method="post" enctype="multipart/form-data">
  <input type="file" name="photo">
  <button>Enviar</button>
</form>

</body>
</html>
