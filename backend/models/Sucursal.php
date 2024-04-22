<?php

class Sucursal {
    private $csucursal;
    private $zona;

    // Constructor
    public function __construct($csucursal, $zona) {
        $this->csucursal = $csucursal;
        $this->zona = $zona;
    }

    // Setters
    public function setCsucursal($csucursal) { $this->csucursal = $csucursal; }
    public function setZona($zona) { $this->zona = $zona; }

    // Getters
    public function getCsucursal() { return $this->csucursal; }
    public function getZona() { return $this->zona; }

    // Aquí podrías añadir métodos adicionales según lo requieras, como métodos CRUD.
}

?>
