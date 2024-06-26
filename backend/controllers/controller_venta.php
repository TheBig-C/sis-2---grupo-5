<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

function controladorInsertarVenta($cv, $fecha, $hora, $estado, $total, $totalEntregado, $tipodepago, $ci_cliente, $Funcionario_cf) {
    try {
        Venta::insertarVenta($cv, $fecha, $hora, $estado, $total, $totalEntregado, $tipodepago, $ci_cliente, $Funcionario_cf);
        echo "Venta insertada correctamente.";
    } catch (Exception $e) {
        echo "Error al insertar venta: " . $e->getMessage();
    }
}
function controladorUltimaVenta() {
    try {
        return Venta::ultimoVenta();
    } catch (Exception $e) {
        echo "Error al seleccionar todos los clientes: " . $e->getMessage();
    }
}
function controladorSeleccionarTodasLasVentas() {
    try {
        return Venta::seleccionarTodasLasVentas();
    } catch (Exception $e) {
        echo "Error al seleccionar todas las ventas: " . $e->getMessage();
    }
}
function controladorSeleccionarVentasPorCliente($ci_cliente) {
    try {
        return Venta::seleccionarVentasPorCliente($ci_cliente);
    } catch (Exception $e) {
        echo "Error al buscar venta por cliente: " . $e->getMessage();
    }
}
function controladorSeleccionarVentasPorFuncionario($funcionario_cf) {
    try {
        return Venta::seleccionarVentasPorFuncionario($funcionario_cf);
    } catch (Exception $e) {
        echo "Error al buscar venta por funcionario: " . $e->getMessage();
    }
}
function controladorseleccionarVentasPorProducto($producto_nombre) {
    try {
        return Venta::seleccionarVentasPorProducto($producto_nombre);
    } catch (Exception $e) {
        echo "Error al buscar venta por producto: " . $e->getMessage();
    }
}
function controladorseleccionarVentasPorFecha($fecha) {
    try {
        return Venta::seleccionarVentasPorFecha($fecha);
    } catch (Exception $e) {
        echo "Error al buscar venta por fecha: " . $e->getMessage();
    }
}

function controladorActualizarVenta($cv, $fecha, $hora, $estado, $total, $totalEntregado, $tipodepago, $ci_cliente, $Funcionario_cf) {
    try {
        Venta::actualizarVenta($cv, $fecha, $hora, $estado, $total, $totalEntregado, $tipodepago, $ci_cliente, $Funcionario_cf);
        echo "Venta actualizada correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar venta: " . $e-> getMessage();
    }
}

function controladorEliminarVenta($cv) {
    try {
        Venta::eliminarVenta($cv);
        echo "Venta eliminada correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar venta: " . $e->getMessage();
    }
}
function controladorSeleccionarVenta($cv) {
    try {
        return Venta::seleccionarVenta($cv);
    } catch (Exception $e) {
        echo "Error al seleccionar la venta: " . $e->getMessage();
    }
}

?>
