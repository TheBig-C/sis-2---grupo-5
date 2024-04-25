<?php
class DetallePedido {
    
    private $cpp;
    private $cantidad;
    private $Producto_cp;
    private $Pedido_cpe;

    public function __construct($cpp, $cantidad, $Producto_cp, $Pedido_cpe) {
        $this->cpp = $cpp;
        $this->cantidad = $cantidad;
        $this->Producto_cp = $Producto_cp;
        $this->Pedido_cpe = $Pedido_cpe;
    }

    // Métodos CRUD con formato estático
    public static function insertarDetallePedido($cpp, $cantidad, $Producto_cp, $Pedido_cpe) {
        $conn = conexion();

        $cpp = pg_escape_string($conn, $cpp);
        $cantidad = pg_escape_string($conn, $cantidad);
        $Producto_cp = pg_escape_string($conn, $Producto_cp);
        $Pedido_cpe = pg_escape_string($conn, $Pedido_cpe);

        $query = "INSERT INTO pedido_producto (cpp, cantidad, Producto_cp, Pedido_cpe) VALUES ('$cpp', '$cantidad', '$Producto_cp', '$Pedido_cpe')";

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
                $detallePedidoData['Producto_cp'],
                $detallePedidoData['Pedido_cpe']
            );
        }

        return $detallesPedido;
    }

    public static function actualizarDetallePedido($cpp, $cantidad, $Producto_cp, $Pedido_cpe) {
        $conn = conexion();

        $cpp = pg_escape_string($conn, $cpp);
        $cantidad = pg_escape_string($conn, $cantidad);
        $Producto_cp = pg_escape_string($conn, $Producto_cp);
        $Pedido_cpe = pg_escape_string($conn, $Pedido_cpe);

        $query = "UPDATE pedido_producto SET cantidad = '$cantidad', Producto_cp = '$Producto_cp', Pedido_cpe = '$Pedido_cpe' WHERE cpp = '$cpp'";

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
