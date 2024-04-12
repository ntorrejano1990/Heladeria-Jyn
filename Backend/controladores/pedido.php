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
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            /*$json = '{
                "fecha":"2024-4-8",
                "fo_cliente":123,
                "fo_vendedor":5,
                "productos":[
                    ["001", "Coca cola 1.5 lts", 5522, 3, 16566],
                    ["001", "Coca cola 1.5 lts", 5522, 3, 16566]
                ],
                "subtotal":16566,
                "total":16566}'; //para hacer pruebas datos directos
                */
                $params = json_decode($json);
                $vec = $pedido->insertar($params);
                break;

        case 'productos':       
          $id = $_GET['id'];
          $vec = $pedido->consultap($id);
          break;
        case 'eliminar':
            $id = $_GET['id'];
            $vec = $pedido->eliminar($id);
            break;
        
    }
    $datosj = json_encode($vec);
    echo $datosj;

    

?>