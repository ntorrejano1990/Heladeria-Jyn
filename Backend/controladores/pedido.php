<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/pedido.php");

    $control = $_GET['control'];

    $pedido = new pedido($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $pedido->consulta();
            $datosj = json_encode($vec);
            echo $datosj;
        header('content-type: application/json');
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Prueba 2"}'; //para hacer pruebas datos directos
            $params = json_decode($json);
            $texto_arreglo = serialize($params->productos);//convertir datos a texto
            $params->productos = $texto_arreglo;
            $vec = $pedido->insertar($params);
            echo $datosj;
            header('Content-Type: application/json');
        break;

        case 'productos':       
          $id = $_GET['id'];
          $vec = $pedido->consultap($id);
          $datosj = json_encode($vec);
         echo $datosj;
         header('Content-Type: application/json');
          break;
        
    }

    

?>