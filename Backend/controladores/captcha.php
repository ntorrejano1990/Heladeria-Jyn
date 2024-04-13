<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    require_once("../modelos/captcha.php");

    $control = $_GET['control'];

    $captcha = new Captcha();
    switch ($control) {
        case 'captcha' :
            $json = file_get_contents('php://input');
            $token = json_decode($json);
            $vec = $captcha->captcha($token);
        break;
    }

    $datosj = json_encode($vec);
    echo $datosj;
    header('content-Type: application/json');