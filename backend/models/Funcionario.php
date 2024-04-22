<?php

class Funcionario {
    private $cf;
    private $tipo;
    private $nombre;

    // Constructor
    public function __construct($cf, $tipo, $nombre) {
        $this->cf = $cf;
        $this->tipo = $tipo;
        $this->nombre = $nombre;
    }

    // Setters
    public function setCf($cf) { $this->cf = $cf; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function setNombre($nombre) { $this->nombre = $nombre; }

    // Getters
    public function getCf() { return $this->cf; }
    public function getTipo() { return $this->tipo; }
    public function getNombre() { return $this->nombre; }

    // Aquí podrías añadir métodos adicionales que necesites, como métodos para interactuar con la base de datos
}

?>
