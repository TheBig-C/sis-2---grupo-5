<?php
include_once '../../../backend/core/conexion.php'; // Incluir el archivo de conexión

// Obtener datos del formulario
$fecha_pedido = $_POST['fecha_pedido'];
$fecha_entrega = $_POST['fecha_entrega'];
$estado = $_POST['estado'];
$funcionario_cf = $_POST['funcionario_cf'];
$sucursal_csucursal = $_POST['sucursal_csucursal'];
$pedido_producto_cpp = $_POST['pedido_producto_cpp'];

$conn = conexion();

// Verificar la conexión
if (!$conn) {
    die("Error en la conexión: " . pg_last_error());
}

// Verificar si el producto seleccionado ya está asociado a algún pedido registrado
$query = "SELECT COUNT(*) FROM Pedido WHERE Pedido_producto_cpp = $pedido_producto_cpp";
$result = pg_query($conn, $query);
$row = pg_fetch_assoc($result);
if ($row['count'] > 0) {
    echo "El producto seleccionado ya ha sido pedido.";
    exit; // Detener la ejecución del script
}

$sql = "INSERT INTO Pedido (fecha_pedido, fecha_entrega, estado, Funcionario_cf, sucursal_csucursal, Pedido_producto_cpp) 
        VALUES ('$fecha_pedido', '$fecha_entrega', '$estado', $funcionario_cf, $sucursal_csucursal, $pedido_producto_cpp)";


$result = pg_query($conn, $sql);
if ($result) {
    echo "Pedido guardado correctamente";
} else {
    echo "Error al guardar el pedido: " . pg_last_error($conn);
}

pg_close($conn);

?>
