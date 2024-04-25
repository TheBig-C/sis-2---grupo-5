<?php
include_once('ProductoVendido.php');

function controladorInsertarProductoVendido($cpv, $venta_cv, $producto_cp) {
    try {
        ProductoVendido::insertarProductoVendido($cpv, $venta_cv, $producto_cp);
        echo "Producto vendido insertado correctamente.";
    } catch (Exception $e) {
        echo "Error al insertar en los productos vendidos: " . $e->getMessage();
    }
}

function controladorSeleccionarProductosVendidos() {
    try {
        return ProductoVendido::seleccionarProductosVendidos();
    } catch (Exception $e) {
        echo "Error al seleccionar los productos vendidos: " . $e->getMessage();
    }
}

function controladorActualizarProductoVendido($cpv, $venta_cv, $producto_cp) {
    try {
        ProductoVendido::actualizarProductoVendido($cpv, $venta_cv, $producto_cp);
        echo "Producto vendido actualizado correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar el producto vendido: " . $e->getMessage();
    }
}

function controladorEliminarProductoVendido($cpv) {
    try {
        ProductoVendido::eliminarProductoVendido($cpv);
        echo "Producto vendido eliminado correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar del producto vendido: " . $e->getMessage();
    }
}
?>
