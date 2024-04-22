<?php

class Venta {
    private $cv;
    private $fecha;
    private $hora;
    private $estado;
    private $metodo;
    private $total;
    private $totalEntregado;
    private $tipoPago;
    private $ci_cliente;

    // Constructor
    public function __construct($cv, $fecha, $hora, $estado, $metodo, $total, $totalEntregado, $tipoPago, $ci_cliente) {
        $this->cv = $cv;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->estado = $estado;
        $this->metodo = $metodo;
        $this->total = $total;
        $this->totalEntregado = $totalEntregado;
        $this->tipoPago = $tipoPago;
        $this->ci_cliente = $ci_cliente;
    }

    // Setters
    public function setCv($cv) { $this->cv = $cv; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setHora($hora) { $this->hora = $hora; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setMetodo($metodo) { $this->metodo = $metodo; }
    public function setTotal($total) { $this->total = $total; }
    public function setTotalEntregado($totalEntregado) { $this->totalEntregado = $totalEntregado; }
    public function setTipoPago($tipoPago) { $this->tipoPago = $tipoPago; }
    public function setCiCliente($ci_cliente) { $this->ci_cliente = $ci_cliente; }

    // Getters
    public function getCv() { return $this->cv; }
    public function getFecha() { return $this->fecha; }
    public function getHora() { return $this->hora; }
    public function getEstado() { return $this->estado; }
    public function getMetodo() { return $this->metodo; }
    public function getTotal() { return $this->total; }
    public function getTotalEntregado() { return $this->totalEntregado; }
    public function getTipoPago() { return $this->tipoPago; }
    public function getCiCliente() { return $this->ci_cliente; }

    // Aquí podrías añadir métodos para la lógica de negocio, como guardar en BD, actualizar, etc.
}

?>
