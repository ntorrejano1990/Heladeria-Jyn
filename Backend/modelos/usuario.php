<?php
class Usuario {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consulta() {
        $con = "SELECT * FROM usuario
                  ORDER BY nombre";
        $result = mysqli_query($this->conexion, $con);
        $usuarios = [];
        
        while ($row = mysqli_fetch_array($result)) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }

    public function eliminar($id) {
        $del = "DELETE FROM usuario WHERE id_usuario = $id";
        mysqli_query($this->conexion, $del);

        $response = [
            'resultado' => 'OK',
            'mensaje' => 'El usuario ha sido eliminado'
        ];

        return $response;
    }

    public function insertar($params) {
        $ins = "INSERT INTO usuario(ident, nombre, direccion, celular, email, rol, clave)
                        VALUES('$params->ident', '$params->nombre', '$params->direccion', '$params->celular', '$params->email', '$params->rol', '" . sha1($params->clave) . "')";
        mysqli_query($this->conexion, $ins);

        $response = [
            'resultado' => 'OK',
            'mensaje' => 'El usuario ha sido registrado'
        ];

        return $response;
    }

    public function editar($id, $params) {
        $editar = "UPDATE usuario SET ident = '$params->ident', nombre = '$params->nombre', 
                      direccion = '$params->direccion', celular = '$params->celular', 
                      email = '$params->email', rol = '$params->rol', clave = '" . sha1($params->clave) . "'
                      WHERE id_usuario = $id";
        mysqli_query($this->conexion, $editar);

        $response = [
            'resultado' => 'OK',
            'mensaje' => 'El usuario ha sido editado'
        ];

        return $response;
    }

    public function filtro($valor) {
        $filtro = "SELECT * FROM usuario
                        WHERE ident LIKE '%$valor%' OR nombre LIKE '%$valor%' OR email LIKE '%$valor%'
                        ORDER BY nombre";
        $result = mysqli_query($this->conexion, $filtro);
        $usuarios = [];

        while ($row = mysqli_fetch_array($result)) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }
}
?>
