<?php
class ProductoVendido {
    
    private $cpv;
    private $venta_cv;
    private $producto_cp;
    private $cantidad;
    public function __construct($cpv,$cantidad, $venta_cv, $producto_cp) {
        $this->cpv = $cpv;
        $this->venta_cv = $venta_cv;
        $this->producto_cp = $producto_cp;
        $this->cantidad = $cantidad;

    }
    public function getProductoCp() {
        return $this->producto_cp;
    }

    public function setProductoCp($producto_cp) {
        $this->cpv = $producto_cp;
    }
    public function getCpv() {
        return $this->cpv;
    }

    public function setCpv($cpv) {
        $this->cpv = $cpv;
    }
    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    public function getVentaCv() {
        return $this->venta_cv;
    }

    public function setVentaCv($venta_cv) {
        $this->cpv = $venta_cv;
    }
    
    // Métodos CRUD con formato estático
    public static function insertarProductoVendido($cpv, $cantidad,$venta_cv, $producto_cp) {
        $conn = conexion();

        $cpv = pg_escape_string($conn, $cpv);
        $venta_cv = pg_escape_string($conn, $venta_cv);
        $producto_cp = pg_escape_string($conn, $producto_cp);
        $cantidad = pg_escape_string($conn, $cantidad);

        $query = "INSERT INTO ProductoVendido (cpv,cantidad, venta_cv, producto_cp) VALUES ('$cpv','$cantidad', '$venta_cv', '$producto_cp')";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al insertar en los productos vendidos.\n";
            exit;
        }
    }

    public static function seleccionarProductosVendidos() {
        $conn = conexion();
        $query = "SELECT * FROM ProductoVendido";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar los productos vendidos.\n";
            exit;
        }

        $productosVendidos = [];
        while ($productoVendidoData = pg_fetch_assoc($result)) {
            $productosVendidos[] = new ProductoVendido(
                $productoVendidoData['cpv'],
                $productoVendidoData['cantidad'],

                $productoVendidoData['venta_cv'],
                $productoVendidoData['producto_cp']
            );
        }

        return $productosVendidos;
    }
    public static function seleccionarProductosVendidosPorVenta($venta_cv) {
        $conn = conexion();
        $venta_cv = pg_escape_string($conn, $venta_cv);
        
        $query = "SELECT * FROM ProductoVendido WHERE venta_cv = '$venta_cv'";
        
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar los productos vendidos para la venta $venta_cv.\n";
            exit;
        }
        
        $productosVendidos = [];
        while ($productoVendidoData = pg_fetch_assoc($result)) {
            // Aquí podrías incluir la lógica necesaria para obtener más detalles del producto
            $productosVendidos[] = new ProductoVendido(
                $productoVendidoData['cpv'],
                $productoVendidoData['cantidad'],

                $productoVendidoData['venta_cv'],
                $productoVendidoData['producto_cp']
            );
        }
        
        return $productosVendidos;
    }
    public static function ulitmoProductovendido(){
        $conexion=conexion();
        $ultimoCustomer = 0;
    
        $query = "SELECT cpv FROM productovendido ORDER BY cpv DESC LIMIT 1";
        $result = pg_query($conexion, $query);
    
        if ($row = pg_fetch_assoc($result)) {
            $ultimoCustomer = (int)$row['cpv'];
        }
    $ultimoCustomer++;
    //pg_close($conexion);
    
        return $ultimoCustomer;
    
    
    }
    public static function actualizarProductoVendido($cpv,$cantidad, $venta_cv, $producto_cp) {
        $conn = conexion();

        $cpv = pg_escape_string($conn, $cpv);
        $venta_cv = pg_escape_string($conn, $venta_cv);
        $producto_cp = pg_escape_string($conn, $producto_cp);

        $query = "UPDATE ProductoVendido SET venta_cv = '$venta_cv',cantidad = '$cantidad', producto_cp = '$producto_cp' WHERE cpv = '$cpv'";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al actualizar el producto vendido.\n";
            exit;
        }
    }

    public static function eliminarProductoVendido($cpv) {
        $conn = conexion();

        $cpv = pg_escape_string($conn, $cpv);

        $query = "DELETE FROM ProductoVendido WHERE cpv = '$cpv'";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al eliminar del producto vendido.\n";
            exit;
        }
    }
}
?>
