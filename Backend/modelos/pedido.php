<?php
    class pedido{
        //atributo
        public $conexion;

        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //metodos
        public function consulta(){
            $con = "SELECT v.*,c.nombre AS nombrecl,u.nombre as nombreus 
            FROM ventas v
            INNER JOIN cliente c ON v.fo_cliente=c.id_cliente
            INNER JOIN ciudad ci ON c.fo_ciudad=ci.id_ciudad
            INNER JOIN dpto d ON ci.fo_dpto=d.id_dpto
            INNER JOIN usuario u ON v.fo_vendedor=u.id_usuario
            ORDER BY v.fecha DESC, v.id_venta DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function eliminar($id){
            $del = "DELETE FROM venta WHERE id_venta = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "La venta ha sido eliminado";
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO ventas(fecha, fo_cliente, productos,subtotal, total, fo_vendedor)
                    VALUES('$params->fecha', '$params->fo_cliente', '" . json_encode($params->productos) . "', $params->subtotal,
                    $params->total, $params->fo_vendedor)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "La venta ha sido insertada";
            return $vec;
        }

        public function editar($id, $params){
            $editar = "UPDATE pedido SET codigo = '$params->codigo', nombre = '$params->nombre', fo_categoria =
            $params->fo_categoria, precio_compra = $params->precio_compra, precio_venta = $params->precio_venta, stock =
            $params->stock, fo_proveedor = $params->fo_proveedor WHERE id_pedido = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec['resultado'] = "ok";
            $vec['mensaje'] = "El pedido ha sido editado";
            return $vec;
        }

        public function filtro($valor){
            $filtro = "SELECT p.*, c.nombre AS categoria, pr.nombre AS proveedor FORM pedido p 
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

        public function consultap($id){
            $con = "SELECT productos, total from ventas WHERE id_venta = $id";
            $res = mysqli_query($this->conexion, $con);
            $row = mysqli_fetch_array($res); 
            $vec ['productos']= json_decode($row[0]); 
            $vec['total'] = $row[1];      
                      
            return $vec;
            }
    }  

