<?php
class Inventario {
    private $cinv;
    private $cantidad;
    private $estado;
    private $sucursal_csucursal;
    private $Producto_cp;

    public function __construct($cinv, $cantidad, $estado, $sucursal_csucursal, $Producto_cp) {
        $this->cinv = $cinv;
        $this->cantidad = $cantidad;
        $this->estado = $estado;
        $this->sucursal_csucursal = $sucursal_csucursal;
        $this->Producto_cp = $Producto_cp;
    }

    // Setters
    public function setCinv($cinv) { $this->cinv = $cinv; }
    public function setCantidad($cantidad) { $this->cantidad = $cantidad; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setSucursalCsucursal($sucursal_csucursal) { $this->sucursal_csucursal = $sucursal_csucursal; }
    public function setProductoCp($Producto_cp) { $this->Producto_cp = $Producto_cp; }

    // Getters
    public function getCinv() { return $this->cinv; }
    public function getCantidad() { return $this->cantidad; }
    public function getEstado() { return $this->estado; }
    public function getSucursalCsucursal() { return $this->sucursal_csucursal; }
    public function getProductoCp() { return $this->Producto_cp; }

    // CRUD Methods
    public static function insertarInventario( $cantidad, $estado, $sucursal_csucursal, $Producto_cp) {
        $conn = conexion(); 

        $cantidad = pg_escape_string($conn, $cantidad);
        $estado = pg_escape_string($conn, $estado);
        $sucursal_csucursal = pg_escape_string($conn, $sucursal_csucursal);
        $Producto_cp = pg_escape_string($conn, $Producto_cp);

        $query = "INSERT INTO Inventario ( cantidad, estado, sucursal_csucursal, Producto_cp) VALUES ( '$cantidad', '$estado', '$sucursal_csucursal', '$Producto_cp')";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al insertar en el inventario.\n";
            exit;
        }
    }
    public static function seleccionarInventarioIndividual($civ) {
        $conn = conexion();
        // Modifica la consulta SQL para seleccionar solo el producto específico
        $query = "SELECT * FROM Inventario WHERE cinv = $1";
    
        // Preparar y ejecutar la consulta SQL segura con pg_prepare y pg_execute
        pg_prepare($conn, "seleccionarInventarioIndividual", $query);
        $result = pg_execute($conn, "seleccionarInventarioIndividual", array($codigoProducto));
    
        if (!$result) {
            echo "Ocurrió un error al seleccionar el inventario para el producto: $codigoProducto.\n";
            exit;
        }
    
        $inventarios = [];
        while ($inventarioData = pg_fetch_assoc($result)) {
            $inventarios[] = new Inventario(
                $inventarioData['cinv'],
                $inventarioData['cantidad'],
                $inventarioData['estado'],
                $inventarioData['sucursal_csucursal'],
                $inventarioData['producto_cp']
            );
        }
    
        return $inventarios;
    }
    
    public static function seleccionarInventarioPorProductoYSucursal($codigoProducto, $codigoSucursal) {
        $conn = conexion();
        // Crear la consulta SQL para seleccionar un único producto en una sucursal específica
        $query = "SELECT * FROM Inventario WHERE producto_cp = '" . pg_escape_string($conn, $codigoProducto) . "' AND sucursal_csucursal = '" . pg_escape_string($conn, $codigoSucursal) . "' and estado ='true'";
    
        // Ejecutar la consulta SQL directamente
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al ejecutar la consulta.\n";
            exit;
        }
    
        // Verificar si se obtuvo algún resultado
        if (pg_num_rows($result) > 0) {
            $inventarioData = pg_fetch_assoc($result);
            if ($inventarioData) {
                $inventario = new Inventario(
                    $inventarioData['cinv'],
                    $inventarioData['cantidad'],
                    $inventarioData['estado'],
                    $inventarioData['sucursal_csucursal'],
                    $inventarioData['producto_cp']
                );
                return $inventario;
            }
        } else {
            exit;
        }
    
        return null;
    }
    
    
    
    public static function seleccionarInventario() {
        $conn = conexion();
        $query = "SELECT * FROM Inventario";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar el inventario.\n";
            exit;
        }

        $inventarios = [];
        while ($inventarioData = pg_fetch_assoc($result)) {
            $inventarios[] = new Inventario(
                $inventarioData['cinv'],
                $inventarioData['cantidad'],
                $inventarioData['estado'],
                $inventarioData['sucursal_csucursal'],
                $inventarioData['producto_cp']
            );
        }

        return $inventarios;
    }

    public static function actualizarInventario($cinv, $cantidad, $estado, $sucursal_csucursal, $Producto_cp) {
        $conn = conexion();

        $cinv = pg_escape_string($conn, $cinv);
        $cantidad = pg_escape_string($conn, $cantidad);
        $estado = pg_escape_string($conn, $estado);
        $sucursal_csucursal = pg_escape_string($conn, $sucursal_csucursal);
        $Producto_cp = pg_escape_string($conn, $Producto_cp);

        $query = "UPDATE Inventario SET cantidad = '$cantidad', estado = '$estado', sucursal_csucursal = '$sucursal_csucursal', Producto_cp = '$Producto_cp' WHERE cinv = '$cinv'";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al actualizar el inventario.\n";
            exit;
        }
    }

    public static function eliminarInventario($cinv) {
        $conn = conexion();

        $cinv = pg_escape_string($conn, $cinv);

        $query = "DELETE FROM Inventario WHERE cinv = '$cinv'";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al eliminar del inventario.\n";
            exit;
        }
    }
}
?>
