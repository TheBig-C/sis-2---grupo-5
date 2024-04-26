<?php
// Asegúrate de que el archivo donde está definida la clase se incluya antes de intentar usarla.
include_once '../../../backend/controllers/controllers.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precioCompra = $_POST['precioCompra'];
    $precioVenta = $_POST['precioVenta'];
    $cantidad = $_POST['cantidad'];
    $sucursal_csucursal = $_POST['sucursal_csucursal'];
    $Proveedor_cprovee= $_POST['Proveedor_cprovee'];
    $cantidad = $_POST['cantidad'];
    $categoria = $_POST['categoria'];
    $result = controladorInsertarProducto($cp, $nombre, $cantidad, $estado, $precioCompra, $precioVenta, $inventario, $categoria, $sucursal_csucursal, $Proveedor_cprovee);
    echo"resultado: $result";
    if($result){
        header('Location: ../productos/view_pproduct.php');

    }else{
        echo "Error al registrar producto";
        header('Location: ../productos/view_register_pproduct.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/sis2-Ketal/frontend/css/styleJhuly.css">
    <link rel="stylesheet" href="/sis2-Ketal/frontend/css/style.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <img src="/sis2-Ketal//frontend/assets/ketal.png">
            <a href="productos.php"><b>Productos</b></a>
            <span> | </span>
            <a href="ventas.php"><b>Ventas</b></a>
        </nav>
        <a href="login.html"><b>Iniciar Sesion</b></a>
    </header>
    <main>
        <div class="container">
            <div class="white-box">
                <h1>AGREGAR PRODUCTO NUEVO</h1>
                <br>
                <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4 login-container">
                    <form action="view_register_product.php" method="post">
                        <div class="form-group">
                            <p> Nombre del producto nuevo: </p>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p> Cantidad: </p>
                            <input type="number" name="cantidad" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p> Estado: </p>
                            <select name="estado" class="form-control" required>
                                <option value="Nuevo">Nuevo</option>
                                <option value="Vencido">Vencido</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <p> Precio compra: </p>
                            <input type="text" name="precioCompra" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p> Precio venta: </p>
                            <input type="text" name="precioVenta" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p> Cantidad: </p>
                            <input type="text" name="cantidad" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p> Estado: </p>
                            <input type="text" name="estado" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p> Sucursal: </p>
                            <input type="text" name="sucursal_csucursal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p> Proveedor: </p>
                            <input type="text" name="Proveedor_cprovee" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p> Categoria: </p>
                            <select name="categoria" class="form-control" multiple required>
                                <option value="Electrónica">Electrónica</option>
                                <option value="Limpieza">Limpieza</option>
                                <option value="Carne">Carne</option>
                                <option value="Lacteos">Lacteos</option>
                                <option value="Verduras">Verduras</option>
                                <option value="Hogar">Hogar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-block btn-registerProduct custom-btn">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>