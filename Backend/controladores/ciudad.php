<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/ciudad.php");

    $control = $_GET['control'];

    $ciudad = new ciudad($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $ciudad->consulta();
        break;
       
    }

    $datosj = json_encode($vec);
    echo $datosj;
    //header('Content-Type: application/json');

?>