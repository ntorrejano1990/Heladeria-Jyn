<?php
    class producto{
        //atributo
        public $conexion;

        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //metodos
        public function consulta(){
            $con = "SELECT p.*, c.nombre AS categoria, pr.nombre AS proveedor FROM prodcuto p
                INNER JOIN categoria c ON p.fo_categoria = c.id_categoria
                INNER JOIN proveedor pr ON p.fo_proveedor = pr.id_prov
                ORDER BY p.codigo";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function eliminar($id){
            $del = "DELETE FROM prodcuto WHERE id_producto = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "El producto ha sido eliminado";
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO prodcuto(codigo, nombre, fo_categoria, precio_compra, precio_venta, stock, fo_proveedor)
                    VALUES('$params->codigo', '$params->nombre', $params->fo_categoria, $params->precio_compra,
                    $params->precio_venta, $params->stock, $params->fo_proveedor)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "EL producto ha sido insertado";
            return $vec;
        }

        public function editar($id, $params){
            $editar = "UPDATE prodcuto SET codigo = '$params->codigo', nombre = '$params->nombre', fo_categoria =
            $params->fo_categoria, precio_compra = $params->precio_compra, precio_venta = $params->precio_venta, stock =
            $params->stock, fo_proveedor = $params->fo_proveedor WHERE id_producto = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "El producto ha sido editado";
            return $vec;
        }

        public function filtro($valor){
            $filtro = "SELECT p.*, c.nombre AS categoria, pr.nombre AS proveedor FORM prodcuto p 
                INNER JOIN categoria c ON p.fo_categoria = c.id_categoria
                INNER JOIN proveedor pr ON p.fo_proveedor = pr.id_prov
                WHERE p.codigo LIKE '%$valor%' OR .p.nombre LIKE '%$valor%' OR categoria LIKE '%$valor%' OR
                proveedor LIKE '%$valor%' ";

            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }
    }  

?>