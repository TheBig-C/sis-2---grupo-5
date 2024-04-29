<?php

class Cliente {
    private $ci;
    private $nombre;
    private $apellidos;
    private $sexo;

    // Constructor
    public function __construct($ci, $nombre, $apellidos, $sexo) {
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->sexo = $sexo;
    }

    // Setters
    public function setCi($ci) { $this->ci = $ci; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellidos($apellidos) { $this->apellidos = $apellidos; }
    public function setSexo($sexo) { $this->sexo = $sexo; }

    // Getters
    public function getCi() { return $this->ci; }
    public function getNombre() { return $this->nombre; }
    public function getApellidos() { return $this->apellidos; }
    public function getSexo() { return $this->sexo; }

    // Métodos CRUD
    public static function insertarCliente($ci, $nombre, $apellidos, $sexo) {
        $conn = conexion();
        $ci = pg_escape_string($conn, $ci);
        $nombre = pg_escape_string($conn, $nombre);
        $apellidos = pg_escape_string($conn, $apellidos);
        $sexo = pg_escape_string($conn, $sexo);

        $query = "INSERT INTO Cliente (ci, nombre, apellidos, sexo) VALUES ('$ci', '$nombre', '$apellidos', '$sexo')";
        $result = pg_query($conn, $query);
        return true;
        if (!$result) {
            echo "Error al insertar el cliente.\n";
            return false;
        }
    }

    public static function seleccionarTodosLosClientes() {
        $conn = conexion();
        $query = "SELECT * FROM Cliente";
        $result = pg_query($conn, $query);
        $clientes = [];

        while ($clienteData = pg_fetch_assoc($result)) {
            $clientes[] = new Cliente($clienteData['ci'], $clienteData['nombre'], $clienteData['apellidos'], $clienteData['sexo']);
        }

        return $clientes;
    }

    public static function actualizarCliente($ci, $nombre, $apellidos, $sexo) {
        $conn = conexion();
        $ci = pg_escape_string($conn, $ci);
        $nombre = pg_escape_string($conn, $nombre);
        $apellidos = pg_escape_string($conn, $apellidos);
        $sexo = pg_escape_string($conn, $sexo);

        $query = "UPDATE Cliente SET nombre = '$nombre', apellidos = '$apellidos', sexo = '$sexo' WHERE ci = '$ci'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al actualizar el cliente.\n";
            exit;
        }
    }

    public static function eliminarCliente($ci) {
        $conn = conexion();
        $ci = pg_escape_string($conn, $ci);

        $query = "DELETE FROM Cliente WHERE ci = '$ci'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al eliminar el cliente.\n";
            exit;
        }
    }

    public static function seleccionarCliente($ci) {
        $conn = conexion();
        $ci = pg_escape_string($conn, $ci);

        $query = "SELECT * FROM Cliente WHERE ci = '$ci'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar el cliente.\n";
            exit;
        }

        $clienteData = pg_fetch_assoc($result);
        if (!$clienteData) {
            echo "No se encontró ningún cliente con el CI proporcionado.";
            return null;
        }

        $cliente = new Cliente(
            $clienteData['ci'],
            $clienteData['nombre'],
            $clienteData['apellidos'],
            $clienteData['sexo']
        );

        return $cliente;
    }

}

?>

<?php

class Cliente {
    private $ci;
    private $nombre;
    private $apellidos;
    private $sexo;

    // Constructor
    public function __construct($ci, $nombre, $apellidos, $sexo) {
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->sexo = $sexo;
    }

    // Setters
    public function setCi($ci) { $this->ci = $ci; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellidos($apellidos) { $this->apellidos = $apellidos; }
    public function setSexo($sexo) { $this->sexo = $sexo; }

    // Getters
    public function getCi() { return $this->ci; }
    public function getNombre() { return $this->nombre; }
    public function getApellidos() { return $this->apellidos; }
    public function getSexo() { return $this->sexo; }

    // Métodos CRUD
    public static function insertarCliente($ci, $nombre, $apellidos, $sexo) {
        $conn = conexion();
        $ci = pg_escape_string($conn, $ci);
        $nombre = pg_escape_string($conn, $nombre);
        $apellidos = pg_escape_string($conn, $apellidos);
        $sexo = pg_escape_string($conn, $sexo);

        $query = "INSERT INTO Cliente (ci, nombre, apellidos, sexo) VALUES ('$ci', '$nombre', '$apellidos', '$sexo')";
        $result = pg_query($conn, $query);
        return true;
        if (!$result) {
            echo "Error al insertar el cliente.\n";
            return false;
        }
    }

    public static function seleccionarTodosLosClientes() {
        $conn = conexion();
        $query = "SELECT * FROM Cliente";
        $result = pg_query($conn, $query);
        $clientes = [];

        while ($clienteData = pg_fetch_assoc($result)) {
            $clientes[] = new Cliente($clienteData['ci'], $clienteData['nombre'], $clienteData['apellidos'], $clienteData['sexo']);
        }

        return $clientes;
    }

    public static function actualizarCliente($ci, $nombre, $apellidos, $sexo) {
        $conn = conexion();
        $ci = pg_escape_string($conn, $ci);
        $nombre = pg_escape_string($conn, $nombre);
        $apellidos = pg_escape_string($conn, $apellidos);
        $sexo = pg_escape_string($conn, $sexo);

        $query = "UPDATE Cliente SET nombre = '$nombre', apellidos = '$apellidos', sexo = '$sexo' WHERE ci = '$ci'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al actualizar el cliente.\n";
            exit;
        }
    }

    public static function eliminarCliente($ci) {
        $conn = conexion();
        $ci = pg_escape_string($conn, $ci);

        $query = "DELETE FROM Cliente WHERE ci = '$ci'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al eliminar el cliente.\n";
            exit;
        }
    }

    public static function seleccionarCliente($ci) {
        $conn = conexion();
        $ci = pg_escape_string($conn, $ci);

        $query = "SELECT * FROM Cliente WHERE ci = '$ci'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar el cliente.\n";
            exit;
        }

        $clienteData = pg_fetch_assoc($result);
        if (!$clienteData) {
            echo "No se encontró ningún cliente con el CI proporcionado.";
            return null;
        }

        $cliente = new Cliente(
            $clienteData['ci'],
            $clienteData['nombre'],
            $clienteData['apellidos'],
            $clienteData['sexo']
        );

        return $cliente;
    }

}

?>
