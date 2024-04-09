<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/producto.php");

    $control = $_GET['control'];

    $producto = new producto($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $producto->consulta();
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Prueba 2"}'; //para hacer pruebas datos directos
            $params = json_decode($json);
            $vec = $producto->insertar($params);
        break;
        case 'eliminar':
            $id = $_GET['id']; // tenia el signo en ID estaba mal
            $vec = $producto->eliminar($id);
        break;
        case 'editar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Prueba 2khgjh"}';
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $producto->editar($id, $params);
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $producto->filtro($dato);
        break;
    }

    $datosj = json_encode($vec);
    echo $datosj;
    header('Content-Type: application/json');

?>