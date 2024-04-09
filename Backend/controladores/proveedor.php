<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/proveedor.php");

    $control = $_GET['control'];

    $proveedor = new proveedor($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $proveedor->consulta();
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Prueba 2"}'; //para hacer pruebas datos directos
            $params = json_decode($json);
            $vec = $proveedor->insertar($params);
        break;
        case 'eliminar':
            $id = $_GET['id']; // tenia el signo en ID estaba mal
            $vec = $proveedor->eliminar($id);
        break;
        case 'editar':
            $json = file_get_contents('php://input');
            /* $json = '{"ident":"123","nombre":"jhonatan","direccion":"calle 63","celular":"3105320943",
                "email":"jhonatan@gmail.com","fo_ciudad":"fo_ciudad"}'; */
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $proveedor->editar($id, $params);
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $proveedor->filtro($dato);
        break;
        case 'ciudad':
            $vec = $proveedor->con_ciudad();
        break;
    }

    $datosj = json_encode($vec);
    echo $datosj;
    header('Content-Type: application/json'); /* lo quito para que funcione */

?>