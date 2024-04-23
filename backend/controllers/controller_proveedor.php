<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

function controladorInsertarProveedor($cproveedor, $nombre) {
    try {
        Proveedor::insertarProveedor($cproveedor, $nombre);
        echo "Proveedor insertado correctamente.";
    } catch (Exception $e) {
        echo "Error al insertar proveedor: " . $e->getMessage();
    }
}

function controladorSeleccionarTodosLosProveedores() {
    try {
        return Proveedor::seleccionarTodosLosProveedores();
    } catch (Exception $e) {
        echo "Error al seleccionar todos los proveedores: " . $e->getMessage();
    }
}

function controladorActualizarProveedor($cproveedor, $nombre) {
    try {
        Proveedor::actualizarProveedor($cproveedor, $nombre);
        echo "Proveedor actualizado correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar proveedor: " . $e->getMessage();
    }
}

function controladorEliminarProveedor($cproveedor) {
    try {
        Proveedor::eliminarProveedor($cproveedor);
        echo "Proveedor eliminado correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar proveedor: " . $e->getMessage();
    }
}

function controladorSeleccionarProveedor($cproveedor) {
    try {
        return Proveedor::seleccionarProveedor($cproveedor);
    } catch (Exception $e) {
        echo "Error al seleccionar el proveedor: " . $e->getMessage();
    }
}


?>
