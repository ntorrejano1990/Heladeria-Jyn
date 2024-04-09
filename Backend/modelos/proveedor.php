<?php
    class proveedor{
        //atributo
        public $conexion;

        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //metodos 
        public function consulta(){
            $con = "SELECT p.*, cd.nombre AS ciudad, dp.nombre AS Departamento 
            FROM proveedor p
            INNER JOIN Ciudad cd ON (p.fo_ciudad=cd.id_ciudad) 
            INNER JOIN DPTO dp ON (cd.fo_dpto=dp.id_dpto)
            ORDER BY nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function eliminar($id){
            $del = "DELETE FROM proveedor WHERE id_prov = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "El proveedor ha sido eliminado";
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO proveedor(ident, nombre, direccion, celular, email, fo_ciudad)
                    VALUES('$params->ident', '$params->nombre', '$params->direccion',
                    '$params->celular', '$params->email', $params->fo_ciudad)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "EL proveedor ha sido insertado";
            return $vec;
        }

        public function editar($id, $params){
            $editar = "UPDATE proveedor SET ident = '$params->ident', nombre = '$params->nombre', direccion =
            '$params->direccion', celular = '$params->celular', email = '$params->email', fo_ciudad =
            $params->fo_ciudad WHERE id_prov = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "El proveedor ha sido editado";
            return $vec;
        }

        public function filtro($valor){
            $filtro = "SELECT p.*, cd.nombre AS Ciudad, dp.nombre AS Departamento FROM proveedor p
                INNER JOIN Ciudad cd ON (p.fo_ciudad=cd.id_ciudad) 
                INNER JOIN DPTO dp ON (cd.fo_dpto=dp.id_dpto)
                WHERE p.id_prov LIKE '%$valor%' OR .p.nombre LIKE '%$valor%' OR categoria LIKE '%$valor%' OR
                proveedor LIKE '%$valor%' ";

            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function con_ciudad(){
            $con = "SELECT c.*, d.nombre AS dpto 
            FROM ciudad c
            INNER JOIN dpto d ON c.fo_dpto=d.id_dpto 
            ORDER BY nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }
    }  

?>