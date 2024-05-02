<?php

class Producto {
    private $cp;
    private $nombre;
    private $precioCompra;
    private $precioVenta;
    private $categoria;
    private $Proveedor_cproveedor;

    public function __construct($cp, $nombre, $precioCompra, $precioVenta, $categoria, $Proveedor_cproveedor) {
        $this->cp = $cp;
        $this->nombre = $nombre;
        $this->precioCompra = $precioCompra;
        $this->precioVenta = $precioVenta;
        $this->categoria = $categoria;
        $this->Proveedor_cproveedor = $Proveedor_cproveedor;
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

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getProveedorCproveedor() {
        return $this->Proveedor_cproveedor;
    }

    public function setProveedorCproveedor($Proveedor_cproveedor) {
        $this->Proveedor_cproveedor = $Proveedor_cproveedor;
    }

    public static function insertarProducto($cp, $nombre, $precioCompra, $precioVenta, $categoria, $Proveedor_cproveedor) {
        $conn = conexion();
        $cp = pg_escape_string($conn, $cp);
        $nombre = pg_escape_string($conn, $nombre);
        $precioCompra = pg_escape_string($conn, $precioCompra);
        $precioVenta = pg_escape_string($conn, $precioVenta);
        $categoria = pg_escape_string($conn, $categoria);
        $Proveedor_cprovee = pg_escape_string($conn, $Proveedor_cproveedor);

        $query = "INSERT INTO Producto (cp, nombre, precioCompra, precioVenta,categoria, proveedor_cproveedor) VALUES ('$cp', '$nombre', $precioCompra, $precioVenta, '$categoria', '$Proveedor_cproveedor')";
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
            $productos[] = new Producto($productoData['cp'], $productoData['nombre'], $productoData['preciocompra'], $productoData['precioventa'],$productoData['categoria'],$productoData['proveedor_cproveedor']);
        }

        return $productos;
    }
    public static function seleccionarProductosPorNombreCategoriaYSucursal($busqueda, $categoria, $csu) {
        $conn = conexion();
        $query = "SELECT a.cp, a.nombre, a.preciocompra, a.precioventa, a.categoria, a.proveedor_cproveedor
                  FROM producto a, sucursal b, inventario c
                  WHERE a.cp=c.producto_cp AND b.csucursal=c.sucursal_csucursal AND c.cantidad>0 AND b.csucursal=$1
                    AND c.estado='true' AND a.nombre ILIKE $2";
    
        $params = array($csu, '%' . $busqueda . '%');
        if (!empty($categoria)) {
            $query .= " AND a.categoria=$3";
            $params[] = $categoria;
        }
    
        $result = pg_prepare($conn, "buscarProductos", $query);
        $result = pg_execute($conn, "buscarProductos", $params);
    
        $productos = [];
        while ($productoData = pg_fetch_assoc($result)) {
            $productos[] = new Producto(
                $productoData['cp'],
                $productoData['nombre'],
                $productoData['preciocompra'],
                $productoData['precioventa'],
                $productoData['categoria'],
                $productoData['proveedor_cproveedor']
            );
        }
    
        return $productos;
    }
    public static function actualizarProducto($cp, $nombre, $precioCompra, $precioVenta, $categoria, $Proveedor_cproveedor) {
        $conn = conexion();
        $cp = pg_escape_string($conn, $cp);
        $nombre= pg_escape_string($conn, $nombre);
        $precioCompra = pg_escape_string($conn, $precioCompra);
        $precioVenta = pg_escape_string($conn, $precioVenta);
        $categoria = pg_escape_string($conn, $categoria);
        $Proveedor_cprovee = pg_escape_string($conn, $Proveedor_cproveedor);

        $query = "UPDATE Producto SET nombre = '$nombre',  preciocompra = $precioCompra, precioventa = $precioVenta,  categoria = '$categoria', proveedor_cproveedor = '$Proveedor_cproveedor' WHERE cp = '$cp'";
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
            $productoData['preciocompra'],
            $productoData['precioventa'],
            $productoData['categoria'],
            $productoData['proveedor_cproveedor']
        );
        return $producto;
    }
    public static function obtenerProductoPorCodigo($codigo) {
        $conn = conexion(); // Suponiendo que tienes una función para establecer la conexión a la base de datos
        
        $codigo = pg_escape_string($conn, $codigo); // Escapar el código para evitar inyección SQL
        
        $query = "SELECT * FROM Producto WHERE cp = '$codigo'"; // Consulta para seleccionar el producto con el código proporcionado
        
        $result = pg_query($conn, $query); // Ejecutar la consulta
        if (!$result) {
            echo "Error al obtener el producto con el código $codigo";
            return null;
        }
        
        $productoData = pg_fetch_assoc($result); // Obtener los datos del producto
        if (!$productoData) {
            echo "No se encontró ningún producto con el código proporcionado.";
            return null;
        }
        
        // Crear un objeto Producto con los datos obtenidos y devolverlo
        $producto = new Producto(
            $productoData['cp'],
            $productoData['nombre'],
            $productoData['preciocompra'],
            $productoData['precioventa'],
            $productoData['categoria'],
            $productoData['proveedor_cproveedor']
        );
        
        return $producto;
    }

    public static function obtenerCategorias() {
        $conn = conexion();
        $query = "SELECT DISTINCT categoria FROM Producto";
        $result = pg_query($conn, $query);
        $categorias = [];
        if (!$result) {
            echo "Error al obtener las categorías.\n";
            exit;
        }
        while ($row = pg_fetch_assoc($result)) {
            $categorias[] = $row['categoria'];
        }
        return $categorias;
    }
    
}

?>
