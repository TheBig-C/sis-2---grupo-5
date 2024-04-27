<?php

class Pedido {
    private $cpe;
    private $fecha_pedido;
    private $fecha_entrega;
    private $estado;
    private $Funcionario_cf;
    private $Proveedor_cprovee;

    public function __construct($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $Proveedor_cprovee) {
        $this->cpe = $cpe;
        $this->fecha_pedido = $fecha_pedido;
        $this->fecha_entrega = $fecha_entrega;
        $this->estado = $estado;
        $this->Funcionario_cf = $Funcionario_cf;
        $this->Proveedor_cprovee = $Proveedor_cprovee;
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

    public function getProveedorCprovee() {
        return $this->Proveedor_cprovee;
    }

    public function setProveedorCprovee($Proveedor_cprovee) {
        $this->Proveedor_cprovee = $Proveedor_cprovee;
    }
    // Métodos CRUD
    public static function insertarPedido($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $Proveedor_cprovee) {
        $conn = conexion();
        $cpe = pg_escape_string($conn, $cpe);
        $fecha_pedido = pg_escape_string($conn, $fecha_pedido);
        $fecha_entrega = pg_escape_string($conn, $fecha_entrega);
        $estado = pg_escape_string($conn, $estado);
        $Funcionario_cf = pg_escape_string($conn, $Funcionario_cf);
        $Proveedor_cprovee = pg_escape_string($conn, $Proveedor_cprovee);

        $query = "INSERT INTO Pedido (cpe, fecha_pedido, fecha_entrega, estado, Funcionario_cf, Proveedor_cprovee) VALUES ('$cpe', '$fecha_pedido', '$fecha_entrega', '$estado', '$Funcionario_cf', '$Proveedor_cprovee')";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al insertar el pedido.\n";
            exit;
        }
    }

    public static function seleccionarTodosLosPedidos() {
        $conn = conexion();
        $query = "SELECT * FROM Pedidos";
        $result = pg_query($conn, $query);
        $pedidos = [];

        while ($pedidoData = pg_fetch_assoc($result)) {
            $pedidos[] = new Pedido($pedidoData['cpe'], $pedidoData['fecha_pedido'], $pedidoData['fecha_entrega'], $pedidoData['estado'], $pedidoData['funcionario_cf'], $pedidoData['proveedor_cprovee']);
        }

        return $pedidos;
    }

    public static function actualizarPedido($cpe, $fecha_pedido, $fecha_entrega, $estado, $Funcionario_cf, $Proveedor_cprovee) {
        $conn = conexion();
        $cpe = pg_escape_string($conn, $cpe);
        $fecha_pedido = pg_escape_string($conn, $fecha_pedido);
        $fecha_entrega = pg_escape_string($conn, $fecha_entrega);
        $estado = pg_escape_string($conn, $estado);
        $Funcionario_cf = pg_escape_string($conn, $Funcionario_cf);
        $Proveedor_cprovee = pg_escape_string($conn, $Proveedor_cprovee);

        $query = "UPDATE Pedido SET fecha_pedido = '$fecha_pedido', fecha_entrega = '$fecha_entrega', estado = '$estado', funcionario_cf = '$Funcionario_cf', Proveedor_cprovee = '$Proveedor_cprovee' WHERE cpe = '$cpe'";
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
            $pedidoData['funcionario_cf'],
            $pedidoData['proveedor_cprovee']
        );
    
        return $pedido;
    }
    
}

?>
