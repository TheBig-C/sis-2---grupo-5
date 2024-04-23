<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

function controladorInsertarSucursal($csucursal, $zona) {
    try {
        Sucursal::insertarSucursal($csucursal, $zona);
        echo "Sucursal insertada correctamente.";
    } catch (Exception $e) {
        echo "Error al insertar sucursal: " . $e->getMessage();
    }
}

function controladorSeleccionarTodasLasSucursales() {
    try {
        return Sucursal::seleccionarTodasLasSucursales();
    } catch (Exception $e) {
        echo "Error al seleccionar todas las sucursales: " . $e->getMessage();
    }
}

function controladorActualizarSucursal($csucursal, $zona) {
    try {
        Sucursal::actualizarSucursal($csucursal, $zona);
        echo "Sucursal actualizada correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar sucursal: " . $e->getMessage();
    }
}

function controladorEliminarSucursal($csucursal) {
    try {
        Sucursal::eliminarSucursal($csucursal);
        echo "Sucursal eliminada correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar sucursal: " . $e->getMessage();
    }
}
function controladorSeleccionarSucursal($csucursal) {
    try {
        return Sucursal::seleccionarSucursal($csucursal);
    } catch (Exception $e) {
        echo "Error al seleccionar la sucursal: " . $e->getMessage();
    }
}


?>
