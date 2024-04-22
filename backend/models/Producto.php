<?php

class Producto {
    private $cp;
    private $nombre;
    private $cantidad;
    private $estado;
    private $precioCompra;
    private $precioVenta;
    private $inventario;
    private $categoria;

    // Constructor
    public function __construct($cp, $nombre, $cantidad, $estado, $precioCompra, $precioVenta, $inventario, $categoria) {
        $this->cp = $cp;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->estado = $estado;
        $this->precioCompra = $precioCompra;
        $this->precioVenta = $precioVenta;
        $this->inventario = $inventario;
        $this->categoria = $categoria;
    }

    // Setters
    public function setCp($cp) { $this->cp = $cp; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setCantidad($cantidad) { $this->cantidad = $cantidad; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setPrecioCompra($precioCompra) { $this->precioCompra = $precioCompra; }
    public function setPrecioVenta($precioVenta) { $this->precioVenta = $precioVenta; }
    public function setInventario($inventario) { $this->inventario = $inventario; }
    public function setCategoria($categoria) { $this->categoria = $categoria; }

    // Getters
    public function getCp() { return $this->cp; }
    public function getNombre() { return $this->nombre; }
    public function getCantidad() { return $this->cantidad; }
    public function getEstado() { return $this->estado; }
    public function getPrecioCompra() { return $this->precioCompra; }
    public function getPrecioVenta() { return $this->precioVenta; }
    public function getInventario() { return $this->inventario; }
    public function getCategoria() { return $this->categoria; }

    // Aquí podrías añadir más métodos que requiera tu lógica de negocio.
}

?>
