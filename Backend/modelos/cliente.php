<?php
class Cliente {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consulta() {
        $con = "SELECT c.*, ci.nombre AS ciudad FROM cliente c
                  INNER JOIN ciudad ci ON c.fo_ciudad = ci.id_ciudad
                  ORDER BY c.nombre";
        $result = mysqli_query($this->conexion, $con);
        $cliente = [];
        
        while ($row = mysqli_fetch_array($result)) {
            $cliente[] = $row;
        }

        return $cliente;
    }

    public function eliminar($id) {
        $del = "DELETE FROM cliente WHERE id_cliente = $id";
        mysqli_query($this->conexion, $del);

        $response = [
            'resultado' => 'OK',
            'mensaje' => 'El cliente ha sido eliminado'
        ];

        return $response;
    }

    public function insertar($params) {
        $ins = "INSERT INTO cliente(ident, nombre, direccion, celular, email, fo_ciudad)
                        VALUES('$params->ident', '$params->nombre', '$params->direccion', '$params->celular', '$params->email', $params->fo_ciudad)";
        mysqli_query($this->conexion, $ins);

        $response = [
            'resultado' => 'OK',
            'mensaje' => 'El cliente ha sido guardado'
        ];

        return $response;
    }

    public function editar($id, $params) {
        $editar = "UPDATE cliente SET ident = '$params->ident', nombre = '$params->nombre', 
                      direccion = '$params->direccion', celular = '$params->celular', 
                      email = '$params->email', fo_ciudad = $params->fo_ciudad
                      WHERE id_cliente = $id";
        mysqli_query($this->conexion, $editar);

        $response = [
            'resultado' => 'OK',
            'mensaje' => 'El cliente ha sido editado'
        ];

        return $response;
    }

    public function filtro($dato){
        $con = "SELECT c.*, ci.nombre AS ciudad, d.nombre AS dpto FROM cliente c
                        INNER JOIN ciudad ci ON c.fo_ciudad = ci.id_ciudad
                        INNER JOIN dpto d ON ci.fo_dpto = d.id_dpto
                        WERE c.ident LIKE '%datos%' OR c.nombre LIKE '%datos%' OR c.email like '%datos%' 
                        ORDER BY c.nombre";
                $res = mysqli_query($this->conexion, $con);
                $vec = [];
        while($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }
        public function consultar_cliente($dato){
            $con = "SELECT c.*, ci.nombre AS ciudad, d.nombre AS dpto FROM cliente c
                            INNER JOIN ciudad ci ON c.fo_ciudad = ci.id_ciudad
                            INNER JOIN dpto d ON ci.fo_dpto = d.id_dpto
                            WHERE c.ident = '$dato'";
                            $res = mysqli_query($this->conexion, $con);
                            $vec = [];
                        
                    while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
    
            return $vec;
    }
}

?>
