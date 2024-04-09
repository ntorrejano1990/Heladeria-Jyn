<?php
    class ciudad{
        //atributo
        public $conexion;

        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //metodos 
        public function consulta(){
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