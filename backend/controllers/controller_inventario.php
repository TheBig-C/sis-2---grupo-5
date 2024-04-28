<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

function controladorInsertarInventario( $cantidad, $estado, $sucursal_csucursal, $Producto_cp) {
    try {
        Inventario::insertarInventario( $cantidad, $estado, $sucursal_csucursal, $Producto_cp);
        echo "Inventario insertado correctamente.";
    } catch (Exception $e) {
        echo "Error al insertar en el inventario: " . $e->getMessage();
    }
}

function controladorSeleccionarInventario() {
    try {
        return Inventario::seleccionarInventario();
    } catch (Exception $e) {
        echo "Error al seleccionar el inventario: " . $e->getMessage();
    }
}
function controladorSeleccionarInventarioIndividual($civ) {
    try {
        return Inventario::seleccionarInventarioIndividual($civ);
    } catch (Exception $e) {
        echo "Error al seleccionar el inventario: " . $e->getMessage();
    }
}
function controladorSeleccionarInventarioPorProductoYSucursal($cp,$csu) {
    try {
        return Inventario::seleccionarInventarioPorProductoYSucursal($cp,$csu);
    } catch (Exception $e) {
        echo "Error al seleccionar el inventario: " . $e->getMessage();
    }
}
function controladorActualizarInventario($cinv, $cantidad, $estado, $sucursal_csucursal, $Producto_cp) {
    try {
        Inventario::actualizarInventario($cinv, $cantidad, $estado, $sucursal_csucursal, $Producto_cp);
        echo "Inventario actualizado correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar el inventario: " . $e->getMessage();
    }
}
function controladorEliminarInventario($cinv) {
    try {
        Inventario::eliminarInventario($cinv);
        echo "Registro de inventario eliminado correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar del inventario: " . $e->getMessage();
    }
}

?>