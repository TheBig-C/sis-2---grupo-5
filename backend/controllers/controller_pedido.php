<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

function controladorInsertarPedido($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $sucursal_csucursal, $Pedido_producto_cpp) {
    try {
        Pedido::insertarPedido($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $sucursal_csucursal, $Pedido_producto_cpp);
        echo "Pedido insertado correctamente.";
    } catch (Exception $e) {
        echo "Error al insertar pedido: " . $e->getMessage();
    }
}

function controladorSeleccionarTodosLosPedidos() {
    try {
        return Pedido::seleccionarTodosLosPedidos();
    } catch (Exception $e) {
        echo "Error al seleccionar todos los pedidos: " . $e->getMessage();
    }
}

function controladorActualizarPedido($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $sucursal_csucursal, $Pedido_producto_cpp) {
    try {
        Pedido::actualizarPedido($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $sucursal_csucursal, $Pedido_producto_cpp);
        echo "Pedido actualizado correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar pedido: " . $e->getMessage();
    }
}

function controladorEliminarPedido($cpe) {
    try {
        Pedido::eliminarPedido($cpe);
        echo "Pedido eliminado correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar pedido: " . $e->getMessage();
    }
}

function controladorSeleccionarPedido($cpe) {
    try {
        return Pedido::seleccionarPedido($cpe);
    } catch (Exception $e) {
        echo "Error al seleccionar el pedido: " . $e->getMessage();
    }
}
?>
