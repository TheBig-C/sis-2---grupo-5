<?php

class Pedido {
    private $cpe;
    private $fecha_pedido;
    private $fecha_entrega;
    private $estado;

    // Constructor
    public function __construct($cpe, $fecha_pedido, $fecha_entrega, $estado) {
        $this->cpe = $cpe;
        $this->fecha_pedido = $fecha_pedido;
        $this->fecha_entrega = $fecha_entrega;
        $this->estado = $estado;
    }

    // Setters
    public function setCpe($cpe) { $this->cpe = $cpe; }
    public function setFechaPedido($fecha_pedido) { $this->fecha_pedido = $fecha_pedido; }
    public function setFechaEntrega($fecha_entrega) { $this->fecha_entrega = $fecha_entrega; }
    public function setEstado($estado) { $this->estado = $estado; }

    // Getters
    public function getCpe() { return $this->cpe; }
    public function getFechaPedido() { return $this->fecha_pedido; }
    public function getFechaEntrega() { return $this->fecha_entrega; }
    public function getEstado() { return $this->estado; }

    // Aquí podrías añadir otros métodos que necesites, como por ejemplo, guardar el pedido en la base de datos.
}

?>
