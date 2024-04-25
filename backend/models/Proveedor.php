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

 // Métodos CRUD
 public static function insertarProveedor($cproveedor, $nombre) {
    $conn = conexion();
    $cproveedor = pg_escape_string($conn, $cproveedor);
    $nombre = pg_escape_string($conn, $nombre);

    $query = "INSERT INTO Proveedor (cproveedor, nombre) VALUES ('$cproveedor', '$nombre')";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Error al insertar el proveedor.\n";
        exit;
    }
}

public static function seleccionarTodosLosProveedores() {
    $conn = conexion();
    $query = "SELECT * FROM Proveedores";
    $result = pg_query($conn, $query);
    $proveedores = [];

    while ($proveedorData = pg_fetch_assoc($result)) {
        $proveedores[] = new Proveedor($proveedorData['cproveedor'], $proveedorData['nombre']);
    }

    return $proveedores;
}

public static function actualizarProveedor($cproveedor, $nombre) {
    $conn = conexion();
    $cproveedor = pg_escape_string($conn, $cproveedor);
    $nombre = pg_escape_string($conn, $nombre);

    $query = "UPDATE Proveedor SET nombre = '$nombre' WHERE cproveedor = '$cproveedor'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Error al actualizar el proveedor.\n";
        exit;
    }
}

public static function eliminarProveedor($cproveedor) {
    $conn = conexion();
    $cproveedor = pg_escape_string($conn, $cproveedor);

    $query = "DELETE FROM Proveedor WHERE cproveedor = '$cproveedor'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Error al eliminar el proveedor.\n";
        exit;
    }
}

public static function seleccionarProveedor($cproveedor) {
    $conn = conexion();
    $cproveedor = pg_escape_string($conn, $cproveedor);

    $query = "SELECT * FROM Proveedor WHERE cproveedor = '$cproveedor'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Ocurrió un error al seleccionar el proveedor.\n";
        exit;
    }

    $proveedorData = pg_fetch_assoc($result);
    if (!$proveedorData) {
        echo "No se encontró ningún proveedor con el código proporcionado.";
        return null;
    }

    $proveedor = new Proveedor(
        $proveedorData['cproveedor'],
        $proveedorData['nombre']
    );

    return $proveedor;
}


}

?>
