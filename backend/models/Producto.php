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
    private $sucursal_csucursal;
    private $Proveedor_cprovee;

    public function __construct($cp, $nombre, $cantidad, $estado, $precioCompra, $precioVenta, $inventario, $categoria, $sucursal_csucursal, $Proveedor_cprovee) {
        $this->cp = $cp;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->estado = $estado;
        $this->precioCompra = $precioCompra;
        $this->precioVenta = $precioVenta;
        $this->inventario = $inventario;
        $this->categoria = $categoria;
        $this->sucursal_csucursal = $sucursal_csucursal;
        $this->Proveedor_cprovee = $Proveedor_cprovee;
    }

    // Getters and setters...
    public function getCp() {
        return $this->cp;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getPrecioCompra() {
        return $this->precioCompra;
    }

    public function setPrecioCompra($precioCompra) {
        $this->precioCompra = $precioCompra;
    }

    public function getPrecioVenta() {
        return $this->precioVenta;
    }

    public function setPrecioVenta($precioVenta) {
        $this->precioVenta = $precioVenta;
    }

    public function getInventario() {
        return $this->inventario;
    }

    public function setInventario($inventario) {
        $this->inventario = $inventario;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getSucursalCsucursal() {
        return $this->sucursal_csucursal;
    }

    public function setSucursalCsucursal($sucursal_csucursal) {
        $this->sucursal_csucursal = $sucursal_csucursal;
    }

    public function getProveedorCprovee() {
        return $this->Proveedor_cprovee;
    }

    public function setProveedorCprovee($Proveedor_cprovee) {
        $this->Proveedor_cprovee = $Proveedor_cprovee;
    }
    // Métodos CRUD
    public static function insertarProducto($cp, $nombre, $cantidad, $estado, $precioCompra, $precioVenta, $inventario, $categoria, $sucursal_csucursal, $Proveedor_cprovee) {
        $conn = conexion();
        $cp = pg_escape_string($conn, $cp);
        $nombre = pg_escape_string($conn, $nombre);
        $cantidad = pg_escape_string($conn, $cantidad);
        $estado = pg_escape_string($conn, $estado);
        $precioCompra = pg_escape_string($conn, $precioCompra);
        $precioVenta = pg_escape_string($conn, $precioVenta);
        $inventario = pg_escape_string($conn, $inventario);
        $categoria = pg_escape_string($conn, $categoria);
        $sucursal_csucursal = pg_escape_string($conn, $sucursal_csucursal);
        $Proveedor_cprovee = pg_escape_string($conn, $Proveedor_cprovee);

        $query = "INSERT INTO Producto (cp, nombre, cantidad, estado, precioCompra, precioVenta, inventario, categoria, sucursal_csucursal, Proveedor_cprovee) VALUES ('$cp', '$nombre', $cantidad, '$estado', $precioCompra, $precioVenta, $inventario, '$categoria', '$sucursal_csucursal', '$Proveedor_cprovee')";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al insertar el producto.\n";
            exit;
        }
    }

    public static function seleccionarTodosLosProductos() {
        $conn = conexion();
        $query = "SELECT * FROM Producto";
        $result = pg_query($conn, $query);
        $productos = [];

        while ($productoData = pg_fetch_assoc($result)) {
            $productos[] = new Producto($productoData['cp'], $productoData['nombre'], $productoData['cantidad'], $productoData['estado'], $productoData['precioCompra'], $productoData['precioVenta'], $productoData['inventario'], $productoData['categoria'], $productoData['sucursal_csucursal'], $productoData['Proveedor_cprovee']);
        }

        return $productos;
    }

    public static function actualizarProducto($cp, $nombre, $cantidad, $estado, $precioCompra, $precioVenta, $inventario, $categoria, $sucursal_csucursal, $Proveedor_cprovee) {
        $conn = conexion();
        $cp = pg_escape_string($conn, $cp);
        $nombre = pg_escape_string($conn, $nombre);
        $cantidad = pg_escape_string($conn, $cantidad);
        $estado = pg_escape_string($conn, $estado);
        $precioCompra = pg_escape_string($conn, $precioCompra);
        $precioVenta = pg_escape_string($conn, $precioVenta);
        $inventario = pg_escape_string($conn, $inventario);
        $categoria = pg_escape_string($conn, $categoria);
        $sucursal_csucursal = pg_escape_string($conn, $sucursal_csucursal);
        $Proveedor_cprovee = pg_escape_string($conn, $Proveedor_cprovee);

        $query = "UPDATE Producto SET nombre = '$nombre', cantidad = $cantidad, estado = '$estado', precioCompra = $precioCompra, precioVenta = $precioVenta, inventario = $inventario, categoria = '$categoria', sucursal_csucursal = '$sucursal_csucursal', Proveedor_cprovee = '$Proveedor_cprovee' WHERE cp = '$cp'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al actualizar el producto.\n";
            exit;
        }
    }

    public static function eliminarProducto($cp) {
        $conn = conexion();
        $cp = pg_escape_string($conn, $cp);

        $query = "DELETE FROM Producto WHERE cp = '$cp'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al eliminar el producto.\n";
            exit;
        }
    }
    public static function seleccionarProducto($cp) {
        $conn = conexion();
        $cp = pg_escape_string($conn, $cp);
    
        $query = "SELECT * FROM Producto WHERE cp = '$cp'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar el producto.\n";
            exit;
        }
    
        $productoData = pg_fetch_assoc($result);
        if (!$productoData) {
            echo "No se encontró ningún producto con el código proporcionado.";
            return null;
        }
    
        $producto = new Producto(
            $productoData['cp'],
            $productoData['nombre'],
            $productoData['cantidad'],
            $productoData['estado'],
            $productoData['precioCompra'],
            $productoData['precioVenta'],
            $productoData['inventario'],
            $productoData['categoria'],
            $productoData['sucursal_csucursal'],
            $productoData['Proveedor_cprovee']
        );
    
        return $producto;
    }
    
}

?>
