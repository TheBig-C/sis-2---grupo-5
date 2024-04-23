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

     // Métodos CRUD
     public static function insertarSucursal($csucursal, $zona) {
        $conn = conexion();
        $csucursal = pg_escape_string($conn, $csucursal);
        $zona = pg_escape_string($conn, $zona);

        $query = "INSERT INTO Sucursal (csucursal, zona) VALUES ('$csucursal', '$zona')";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al insertar la sucursal.\n";
            exit;
        }
    }

    public static function seleccionarTodasLasSucursales() {
        $conn = conexion();
        $query = "SELECT * FROM Sucursal";
        $result = pg_query($conn, $query);
        $sucursales = [];

        while ($sucursalData = pg_fetch_assoc($result)) {
            $sucursales[] = new Sucursal($sucursalData['csucursal'], $sucursalData['zona']);
        }

        return $sucursales;
    }

    public static function actualizarSucursal($csucursal, $zona) {
        $conn = conexion();
        $csucursal = pg_escape_string($conn, $csucursal);
        $zona = pg_escape_string($conn, $zona);

        $query = "UPDATE Sucursal SET zona = '$zona' WHERE csucursal = '$csucursal'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al actualizar la sucursal.\n";
            exit;
        }
    }

    public static function eliminarSucursal($csucursal) {
        $conn = conexion();
        $csucursal = pg_escape_string($conn, $csucursal);

        $query = "DELETE FROM Sucursal WHERE csucursal = '$csucursal'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al eliminar la sucursal.\n";
            exit;
        }
    }
    public static function seleccionarSucursal($csucursal) {
        $conn = conexion();
        $csucursal = pg_escape_string($conn, $csucursal);
    
        $query = "SELECT * FROM Sucursal WHERE csucursal = '$csucursal'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar la sucursal.\n";
            exit;
        }
    
        $sucursalData = pg_fetch_assoc($result);
        if (!$sucursalData) {
            echo "No se encontró ninguna sucursal con el código proporcionado.";
            return null;
        }
    
        $sucursal = new Sucursal(
            $sucursalData['csucursal'],
            $sucursalData['zona']
        );
    
        return $sucursal;
    }
    
}
?>
