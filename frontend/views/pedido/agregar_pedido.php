<?php
// Incluir el archivo que contiene la clase DetallePedido y la función de conexión
include_once '../../../backend/core/conexion.php';
include_once '../../../backend/models/DetallePedido.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han recibido datos de productos
    if (isset($_POST['productos']) && !empty($_POST['productos'])) {
        try {
            // Iterar sobre los productos recibidos
            foreach ($_POST['productos'] as $producto) {
                // Separar los datos del producto (nombre, cantidad, proveedor, Producto_cp)
                $datosProducto = explode(',', $producto);
                $nombreProducto = $datosProducto[0];
                $cantidadProducto = $datosProducto[1];
                $proveedorProducto = $datosProducto[2];
                $productoCP = $datosProducto[3]; // Obtener el Producto_cp
                
                // Insertar el detalle del pedido en la base de datos
                DetallePedido::insertarDetallePedido($cantidadProducto, $productoCP, $proveedorProducto);
            }
            echo "Pedido realizado correctamente.";
        } catch (Exception $e) {
            echo "Error al realizar el pedido: " . $e->getMessage();
        }
    } else {
        echo "No se han recibido productos para realizar el pedido.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
