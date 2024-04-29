<?php
// Archivo update_product_details.php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\controllers\controllers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cp = $_POST['cp'];
    $cinv = $_POST['cinv'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $precioVenta = $_POST['precioVenta'];
    $precioCompra = $_POST['precioCompra'];
    $estado = $_POST['inventario'] ; // Asumiendo 'false' como valor predeterminado
    $categoria = $_POST['categoria'];
    echo 'estado: ';
    echo $estado;
    $serializedSucursal = $_COOKIE['sucursal'];
    $suc = unserialize($serializedSucursal);
    $aux= $suc->getCsucursal();
    $prov=controladorSeleccionarProducto($cp);
    // Asumiendo que tienes un identificador de producto y de inventario disponible
    controladorActualizarProducto($cp, $nombre, $precioCompra, $precioVenta, $categoria, $prov->getProveedorCproveedor());
    controladorActualizarInventario($cinv, $cantidad, $estado, $aux, $cp);

    echo 'Datos actualizados correctamente.';
}
?>
