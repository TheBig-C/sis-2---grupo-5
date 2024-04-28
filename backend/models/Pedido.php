<?php

class Pedido {
    private $cpe;
    private $fecha_pedido;
    private $fecha_entrega;
    private $estado;
    private $Funcionario_cf;
    private $sucursal_csucursal;
    private $Pedido_producto_cpp;

    public function __construct($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $sucursal_csucursal, $Pedido_producto_cpp) {
        $this->cpe = $cpe;
        $this->fecha_pedido = $fecha_pedido;
        $this->fecha_entrega = $fecha_entrega;
        $this->estado = $estado;
        $this->Funcionario_cf = $Funcionario_cf;
        $this->sucursal_csucursal = $sucursal_csucursal;
        $this->Pedido_producto_cpp = $Pedido_producto_cpp;
    }

    // Getters and setters...
    public function getCpe() {
        return $this->cpe;
    }

    public function setCpe($cpe) {
        $this->cpe = $cpe;
    }

    public function getFechaPedido() {
        return $this->fecha_pedido;
    }

    public function setFechaPedido($fecha_pedido) {
        $this->fecha_pedido = $fecha_pedido;
    }

    public function getFechaEntrega() {
        return $this->fecha_entrega;
    }

    public function setFechaEntrega($fecha_entrega) {
        $this->fecha_entrega = $fecha_entrega;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getFuncionarioCf() {
        return $this->Funcionario_cf;
    }

    public function setFuncionarioCf($Funcionario_cf) {
        $this->Funcionario_cf = $Funcionario_cf;
    }

    public function getSucursalCsucursal() {
        return $this->sucursal_csucursal;
    }

    public function setSucursalCsucursal($sucursal_csucursal) {
        $this->sucursal_csucursal = $sucursal_csucursal;
    }

    public function getPedidoProductoCpp() {
        return $this->Pedido_producto_cpp;
    }

    public function setPedidoProductoCpp($Pedido_producto_cpp) {
        $this->Pedido_producto_cpp = $Pedido_producto_cpp;
    }

    // Métodos CRUD
    public static function insertarPedido($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $sucursal_csucursal, $Pedido_producto_cpp) {
        $conn = conexion();
        $cpe = pg_escape_string($conn, $cpe);
        $fecha_pedido = pg_escape_string($conn, $fecha_pedido);
        $fecha_entrega = pg_escape_string($conn, $fecha_entrega);
        $estado = pg_escape_string($conn, $estado);
        $Funcionario_cf = pg_escape_string($conn, $Funcionario_cf);
        $sucursal_csucursal = pg_escape_string($conn, $sucursal_csucursal);
        $Pedido_producto_cpp = pg_escape_string($conn, $Pedido_producto_cpp);

        $query = "INSERT INTO Pedido (cpe, fecha_pedido, fecha_entrega, estado, Funcionario_cf, sucursal_csucursal, Pedido_producto_cpp) VALUES ('$cpe', '$fecha_pedido', '$fecha_entrega', '$estado', '$Funcionario_cf', '$sucursal_csucursal', '$Pedido_producto_cpp')";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al insertar el pedido.\n";
            exit;
        }
    }

    public static function seleccionarTodosLosPedidos() {
        $conn = conexion();
        $query = "SELECT * FROM Pedido";
        $result = pg_query($conn, $query);
        $pedidos = [];

        while ($pedidoData = pg_fetch_assoc($result)) {
            $pedidos[] = new Pedido($pedidoData['cpe'], $pedidoData['fecha_pedido'], $pedidoData['fecha_entrega'], $pedidoData['estado'], $pedidoData['Funcionario_cf'], $pedidoData['sucursal_csucursal'], $pedidoData['Pedido_producto_cpp']);
        }

        return $pedidos;
    }

    public static function actualizarPedido($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $sucursal_csucursal, $Pedido_producto_cpp) {
        $conn = conexion();
        $cpe = pg_escape_string($conn, $cpe);
        $fecha_pedido = pg_escape_string($conn, $fecha_pedido);
        $fecha_entrega = pg_escape_string($conn, $fecha_entrega);
        $estado = pg_escape_string($conn, $estado);
        $Funcionario_cf = pg_escape_string($conn, $Funcionario_cf);
        $sucursal_csucursal = pg_escape_string($conn, $sucursal_csucursal);
        $Pedido_producto_cpp = pg_escape_string($conn, $Pedido_producto_cpp);

        $query = "UPDATE Pedido SET fecha_pedido = '$fecha_pedido', fecha_entrega = '$fecha_entrega', estado = '$estado', Funcionario_cf = '$Funcionario_cf', sucursal_csucursal = '$sucursal_csucursal', Pedido_producto_cpp = '$Pedido_producto_cpp' WHERE cpe = '$cpe'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al actualizar el pedido.\n";
            exit;
        }
    }

    public static function eliminarPedido($cpe) {
        $conn = conexion();
        $cpe = pg_escape_string($conn, $cpe);

        $query = "DELETE FROM Pedido WHERE cpe = '$cpe'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al eliminar el pedido.\n";
            exit;
        }
    }

    public static function seleccionarPedido($cpe) {
        $conn = conexion();
        $cpe = pg_escape_string($conn, $cpe);
    
        $query = "SELECT * FROM Pedido WHERE cpe = '$cpe'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar el pedido.\n";
            exit;
        }
    
        $pedidoData = pg_fetch_assoc($result);
        if (!$pedidoData) {
            echo "No se encontró ningún pedido con el código proporcionado.";
            return null;
        }
    
        $pedido = new Pedido(
            $pedidoData['cpe'],
            $pedidoData['fecha_pedido'],
            $pedidoData['fecha_entrega'],
            $pedidoData['estado'],
            $pedidoData['Funcionario_cf'],
            $pedidoData['sucursal_csucursal'],
            $pedidoData['Pedido_producto_cpp']
        );
    
        return $pedido;
    }
}

?>
