<?php
include_once('DetallePedido.php');

function controladorInsertarDetallePedido($cpp, $cantidad, $Producto_cp, $Pedido_cpe) {
    try {
        DetallePedido::insertarDetallePedido($cpp, $cantidad, $Producto_cp, $Pedido_cpe);
        echo "Detalle del pedido insertado correctamente.";
    } catch (Exception $e) {
        echo "Error al insertar en el detalle del pedido: " . $e->getMessage();
    }
}

function controladorSeleccionarDetallePedido() {
    try {
        return DetallePedido::seleccionarDetallePedido();
    } catch (Exception $e) {
        echo "Error al seleccionar el detalle del pedido: " . $e->getMessage();
    }
}

function controladorActualizarDetallePedido($cpp, $cantidad, $Producto_cp, $Pedido_cpe) {
    try {
        DetallePedido::actualizarDetallePedido($cpp, $cantidad, $Producto_cp, $Pedido_cpe);
        echo "Detalle del pedido actualizado correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar el detalle del pedido: " . $e->getMessage();
    }
}

function controladorEliminarDetallePedido($cpp) {
    try {
        DetallePedido::eliminarDetallePedido($cpp);
        echo "Detalle del pedido eliminado correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar del detalle del pedido: " . $e->getMessage();
    }
}
?>
