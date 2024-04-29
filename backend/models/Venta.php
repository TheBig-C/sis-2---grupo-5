<?php

class Venta {
    private $cv;
    private $fecha;
    private $hora;
    private $estado;
    private $total;
    private $totalEntregado;
    private $tipodepago;
    private $ci_cliente;
    private $Funcionario_cf;

    public function __construct($cv, $fecha, $hora, $estado, $total, $totalEntregado, $tipodepago, $ci_cliente, $Funcionario_cf) {
        $this->cv = $cv;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->estado = $estado;
        $this->total = $total;
        $this->totalEntregado = $totalEntregado;
        $this->tipodepago = $tipodepago;
        $this->ci_cliente = $ci_cliente;
        $this->Funcionario_cf= $Funcionario_cf;
    }

    // Getters and setters...
    public function getCv() {
        return $this->cv;
    }

    public function setCv($cv) {
        $this->cv = $cv;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }



    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getTotalEntregado() {
        return $this->totalEntregado;
    }

    public function setTotalEntregado($totalEntregado) {
        $this->totalEntregado = $totalEntregado;
    }

    public function getTipodepago() {
        return $this->tipodepago;
    }

    public function setTipodepago($tipodepago) {
        $this->tipodepago = $tipodepago;
    }

    public function getCiCliente() {
        return $this->ci_cliente;
    }

    public function setCiCliente($ci_cliente) {
        $this->ci_cliente = $ci_cliente;
    }

    public function getFuncionarioCf() {
        return $this->Funcionario_cf;
    }

    public function setFuncionarioCf($Funcionario_cf) {
        $this->Funcionario_cf = $Funcionario_cf;
    }
    // Métodos CRUD
    public static function insertarVenta($cv, $fecha, $hora, $estado, $total, $totalEntregado, $tipodepago, $ci_cliente, $Funcionario_cf) {
        $conn = conexion();
        // Preparar y escapar los datos para prevenir inyecciones SQL
        $cv = pg_escape_string($conn, $cv);
        $fecha = pg_escape_string($conn, $fecha);
        $hora = pg_escape_string($conn, $hora);
        $estado = pg_escape_string($conn, $estado);
        $total = pg_escape_string($conn, $total);
        $totalEntregado = pg_escape_string($conn, $totalEntregado);
        $tipodepago = pg_escape_string($conn, $tipodepago);
        $ci_cliente = pg_escape_string($conn, $ci_cliente);
        $Funcionario_cf = pg_escape_string($conn, $Funcionario_cf);

        $query = "INSERT INTO Venta (cv, fecha, hora, estado, total, totalEntregado, tipodepago, ci_cliente, funcionario_cf) VALUES ('$cv', '$fecha', '$hora', '$estado', $total, $totalEntregado, '$tipodepago', '$ci_cliente', '$Funcionario_cf')";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al insertar la venta.\n";
            exit;
        }
    }

    public static function seleccionarTodasLasVentas() {
        $conn = conexion();
        $query = "SELECT * FROM Venta";
        $result = pg_query($conn, $query);
        $ventas = [];

        while ($ventaData = pg_fetch_assoc($result)) {
            $ventas[] = new Venta($ventaData['cv'], $ventaData['fecha'], $ventaData['hora'], $ventaData['estado'], $ventaData['total'], $ventaData['totalentregado'], $ventaData['tipodepago'], $ventaData['ci_cliente'], $ventaData['funcionario_cf']);
        }

        return $ventas;
    }
    // Venta.php

    public static function seleccionarVentasPorCliente($ci_cliente) {
        $conn = conexion();
        $ci_cliente = pg_escape_string($conn, $ci_cliente);

        $query = "SELECT * FROM Venta WHERE ci_cliente = '$ci_cliente'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar las ventas del cliente.\n";
            exit;
        }

        $ventas = [];
        while ($ventaData = pg_fetch_assoc($result)) {
            $ventas[] = new Venta(
                $ventaData['cv'],
                $ventaData['fecha'],
                $ventaData['hora'],
                $ventaData['estado'],
                $ventaData['total'],
                $ventaData['totalentregado'],
                $ventaData['tipodepago'],
                $ventaData['ci_cliente'],
                $ventaData['funcionario_cf']
            );
        }

        return $ventas;
    }

    public static function actualizarVenta($cv, $fecha, $hora, $estado, $total, $totalEntregado, $tipodepago, $ci_cliente, $Funcionario_cf) {
        $conn = conexion();
        // Preparar y escapar los datos
        $cv = pg_escape_string($conn, $cv);
        $fecha = pg_escape_string($conn, $fecha);
        $hora = pg_escape_string($conn, $hora);
        $estado = pg_escape_string($conn, $estado);
        $total = pg_escape_string($conn, $total);
        $totalEntregado = pg_escape_string($conn, $totalEntregado);
        $tipodepago = pg_escape_string($conn, $tipodepago);
        $ci_cliente = pg_escape_string($conn, $ci_cliente);
        $Funcionario_cf = pg_escape_string($conn, $Funcionario_cf);

        $query = "UPDATE Venta SET fecha = '$fecha', hora = '$hora', estado = '$estado', total = $total, totalEntregado = $totalEntregado, tipodepago = '$tipodepago', ci_cliente = '$ci_cliente', Funcionario_cf = '$Funcionario_cf' WHERE cv = '$cv'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al actualizar la venta.\n";
            exit;
        }
    }

    public static function eliminarVenta($cv) {
        $conn = conexion();
        $cv = pg_escape_string($conn, $cv);

        $query = "DELETE FROM Venta WHERE cv = '$cv'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al eliminar la venta.\n";
            exit;
        }
    }
    public static function seleccionarVenta($cv) {
        $conn = conexion();
        $cv = pg_escape_string($conn, $cv);
    
        $query = "SELECT * FROM Venta WHERE cv = '$cv'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar la venta.\n";
            exit;
        }
    
        $ventaData = pg_fetch_assoc($result);
        if (!$ventaData) {
            echo "No se encontró ninguna venta con el código proporcionado.";
            return null;
        }
    
        $venta = new Venta(
            $ventaData['cv'],
            $ventaData['fecha'],
            $ventaData['hora'],
            $ventaData['estado'],
            $ventaData['total'],
            $ventaData['totalentregado'],
            $ventaData['tipodepago'],
            $ventaData['ci_cliente'],
            $ventaData['funcionario_cf']
        );
    
        return $venta;
    }
    public static function ultimoVenta(){
        $conexion=conexion();
        $ultimoCustomer = 0;
    
        $query = "SELECT cv FROM venta ORDER BY cv DESC LIMIT 1";
        $result = pg_query($conexion, $query);
    
        if ($row = pg_fetch_assoc($result)) {
            $ultimoCustomer = (int)$row['cv'];
        }
    $ultimoCustomer++;
    //pg_close($conexion);
    
        return $ultimoCustomer;
    
    
    }
}

?>
