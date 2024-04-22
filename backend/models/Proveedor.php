<?php

class Proveedor {
    private $cproveedor;
    private $nombre;

    // Constructor
    public function __construct($cproveedor, $nombre) {
        $this->cproveedor = $cproveedor;
        $this->nombre = $nombre;
    }

    // Setters
    public function setCproveedor($cproveedor) { $this->cproveedor = $cproveedor; }
    public function setNombre($nombre) { $this->nombre = $nombre; }

    // Getters
    public function getCproveedor() { return $this->cproveedor; }
    public function getNombre() { return $this->nombre; }

    // Aquí podrías incluir otros métodos útiles como la interacción con la base de datos.
}

?>
