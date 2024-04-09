<?php
class Ventas {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consulta() {
        $con = "SELECT v.fecha, v.fo_cliente, v.productos, v.subtotal, v.total, v.fo_vendedor, c.* FROM ventas v 
        INNER JOIN cliente c ON v.fo_cliente = c.id_cliente;";
        $result = mysqli_query($this->conexion, $con);
        $ventas = [];
        
        while ($row = mysqli_fetch_array($result)) {
            $ventas[] = $row;
        }

        return $ventas;
    }

    public function eliminar($id) {
        $del = "DELETE FROM ventas WHERE id_venta = $id";
        mysqli_query($this->conexion, $del);

        $response = [
            'resultado' => 'OK',
            'mensaje' => 'La venta ha sido eliminada'
        ];

        return $response;
    }

    public function insertar($params) {
        $ins = "INSERT INTO ventas(fecha, fo_cliente, productos, subtotal, total, fo_vendedor)
                        VALUES('$params->fecha', $params->fo_cliente, '$params->productos', $params->subtotal, $params->total, $params->fo_vendedor)";
        mysqli_query($this->conexion, $ins);

        $response = [
            'resultado' => 'OK',
            'mensaje' => 'La venta ha sido registrada'
        ];

        return $response;
    }

    public function editar($id, $params) {
        $editar = "UPDATE ventas SET fecha = '$params->fecha', fo_cliente = $params->fo_cliente, 
                      productos = '$params->productos', subtotal = $params->subtotal, total = $params->total,
                      fo_vendedor = $params->fo_vendedor
                      WHERE id_venta = $id";
        mysqli_query($this->conexion, $editar);

        $response = [
            'resultado' => 'OK',
            'mensaje' => 'La venta ha sido editada'
        ];

        return $response;
    }

    public function filtro($valor) {
        $filtro = "SELECT v.*, c.nombre AS cliente, CONCAT(u.nombre, ' ', u.apellido) AS vendedor FROM ventas v
                        INNER JOIN cliente c ON v.fo_cliente = c.id_cliente
                        INNER JOIN usuario u ON v.fo_vendedor = u.id_usuario
                        WHERE v.id_venta LIKE '%$valor%' OR v.fecha LIKE '%$valor%' OR c.nombre LIKE '%$valor%' OR u.nombre LIKE '%$valor%'
                        ORDER BY v.fecha DESC";
        $result = mysqli_query($this->conexion, $filtro);
        $ventas = [];

        while ($row = mysqli_fetch_array($result)) {
            $ventas[] = $row;
        }

        return $ventas;
    }
}
?>
