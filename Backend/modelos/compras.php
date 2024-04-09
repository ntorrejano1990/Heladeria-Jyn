<?php
    class compras{
        //atributo
        public $conexion;

        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //metodos 
        public function consulta(){
            $con = "SELECT c.*, p.nombre AS proveedor, u.nombre AS usuario 
            FROM compras c 
            INNER JOIN proveedor p ON (c.fo_proveedor=p.id_prov) 
            INNER JOIN usuario u ON (c.fo_usuario=u.id_usuario)
            ORDER BY c.id_compras; ";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function eliminar($id){
            $del = "DELETE FROM compras WHERE id_compras = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "La compra ha sido eliminado";
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO compras(id_compras, fecha, fo_proveedor, productos, subtotal, total, fo_usuario)
                    VALUES('$params->id_compras', '$params->fecha', $params->fo_proveedor, $params->productos,
                    $params->subtotal, $params->total, $params->fo_usuario)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "La compra ha sido insertada";
            return $vec;
        }

        public function editar($id, $params){
            $editar = "UPDATE compras SET id_compras = '$params->id_compras', fecha = '$params->fecha', fo_proveedor =
            $params->fo_proveedor, productos = $params->productos, subtotal = $params->subtotal, total =
            $params->total, fo_usuario = $params->fo_usuario WHERE id_compras = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "La compra ha sido editada";
            return $vec;
        }

        public function filtro($valor){
            $filtro = "SELECT c.*, p.fecha AS Proveedor, u.fecha AS Usuario 
                FROM compras c 
                INNER JOIN proveedor p ON (c.fo_proveedor=p.id_prov) 
                INNER JOIN usuario u ON (c.fo_usuario=u.id_usuario)
                ORDER BY c.id_compras
                WHERE p.id_compras LIKE '%$valor%' OR p.fecha LIKE '%$valor%' OR c.total LIKE '%$valor%' OR
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