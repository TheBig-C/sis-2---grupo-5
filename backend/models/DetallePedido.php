<?php
class DetallePedido {
    
    private $cpp;
    private $cantidad;
    private $producto_cp;
    private $proveedor_cproveedor;

    public function __construct($cpp, $cantidad, $producto_cp, $proveedor_cproveedor) {
        $this->cpp = $cpp;
        $this->cantidad = $cantidad;
        $this->producto_cp = $producto_cp;
        $this->proveedor_cproveedor = $proveedor_cproveedor;
    }

    // Métodos CRUD con formato estático
    public static function insertarDetallePedido($cantidad, $producto_cp, $proveedor_cproveedor) {
        $conn = conexion();
    
        $cantidad = pg_escape_string($conn, $cantidad);
        $producto_cp = pg_escape_string($conn, $producto_cp);
        $proveedor_cproveedor = pg_escape_string($conn, $proveedor_cproveedor);
    
        $query = "INSERT INTO pedido_producto (cantidad, Producto_cp, Proveedor_cproveedor) VALUES ('$cantidad', '$producto_cp', '$proveedor_cproveedor')";
    
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al insertar en el detalle del pedido.\n";
            exit;
        }
    }
    
    public static function seleccionarDetallePedido() {
        $conn = conexion();
        $query = "SELECT * FROM pedido_producto";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar el detalle del pedido.\n";
            exit;
        }

        $detallesPedido = [];
        while ($detallePedidoData = pg_fetch_assoc($result)) {
            $detallesPedido[] = new DetallePedido(
                $detallePedidoData['cpp'],
                $detallePedidoData['cantidad'],
                $detallePedidoData['producto_cp'],
                $detallePedidoData['proveedor_cproveedor']
            );
        }

        return $detallesPedido;
    }

    public static function actualizarDetallePedido($cpp, $cantidad, $producto_cp, $proveedor_cproveedor) {
        $conn = conexion();

        $cpp = pg_escape_string($conn, $cpp);
        $cantidad = pg_escape_string($conn, $cantidad);
        $producto_cp = pg_escape_string($conn, $producto_cp);
        $proveedor_cproveedor = pg_escape_string($conn, $proveedor_cproveedor);

        $query = "UPDATE pedido_producto SET cantidad = '$cantidad', Producto_cp = '$producto_cp', Proveedor_cproveedor = '$proveedor_cproveedor' WHERE cpp = '$cpp'";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al actualizar el detalle del pedido.\n";
            exit;
        }
    }

    public static function eliminarDetallePedido($cpp) {
        $conn = conexion();

        $cpp = pg_escape_string($conn, $cpp);

        $query = "DELETE FROM pedido_producto WHERE cpp = '$cpp'";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al eliminar del detalle del pedido.\n";
            exit;
        }
    }
}
?>
