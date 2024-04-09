<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/ventas.php");

    $control = $_GET['control'];

    $ventas = new Ventas($conexion);

    switch ($control) {
        case 'consulta' :
           $vec = $ventas->consulta();
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Prueba 2"}';
            $params = json_decode($json);
            $vec = $ventas->insertar($params); 
        break;
        case 'eliminar' : 
            $id = $_GET ['id'];
            $vec = $ventas->eliminar($id);
        break;
        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id= $_GET['id'];
            $vec = $ventas->editar($id,$params); 
        break;
        case 'filtro':
            $dato = $_GET ['dato'];
            $vec = $ventas->filtro($dato);
        break;
    }

    $datosj = json_encode($vec);
    echo $datosj;
    header('content-Type: application/json');
    

    
?>