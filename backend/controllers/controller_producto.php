<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

function controladorInsertarProducto($cp, $nombre, $cantidad, $estado, $precioCompra, $precioVenta, $inventario, $categoria, $sucursal_csucursal, $Proveedor_cprovee) {
    try {
        Producto::insertarProducto($cp, $nombre, $cantidad, $estado, $precioCompra, $precioVenta, $inventario, $categoria, $sucursal_csucursal, $Proveedor_cprovee);
        echo "Producto insertado correctamente.";
    } catch (Exception $e) {
        echo "Error al insertar producto: " . $e->getMessage();
    }
}

function controladorSeleccionarTodosLosProductos() {
    try {
        return Producto::seleccionarTodosLosProductos();
    } catch (Exception $e) {
        echo "Error al seleccionar todos los productos: " . $e->getMessage();
    }
}

function controladorActualizarProducto($cp, $nombre, $cantidad, $estado, $precioCompra, $precioVenta, $inventario, $categoria, $sucursal_csucursal, $Proveedor_cprovee) {
    try {
        Producto::actualizarProducto($cp, $nombre, $cantidad, $estado, $precioCompra, $precioVenta, $inventario, $categoria, $sucursal_csucursal, $Proveedor_cprovee);
        echo "Producto actualizado correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar producto: " . $e-> getMessage();
    }
}

function controladorEliminarProducto($cp) {
    try {
        Producto::eliminarProducto($cp);
        echo "Producto eliminado correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar producto: " . $e->getMessage();
    }
}

function controladorSeleccionarProducto($cp) {
    try {
        return Producto::seleccionarProducto($cp);
    } catch (Exception $e) {
        echo "Error al seleccionar el producto: " . $e->getMessage();
    }
}

?>
