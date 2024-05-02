<?php
// Asegúrate de que el archivo donde está definida la clase se incluya antes de intentar usarla.
include_once 'C:\xampp\htdocs\sis2-Ketal\backend\controllers\controllers.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cp = $_POST['cp'];
    $nombre = $_POST['nombre'];

    $cantidad = $_POST['cantidad'];
    $precioCompra = $_POST['precioCompra'];
    $precioVenta = $_POST['precioVenta'];
    $categoria = $_POST['categoria'];
    $Proveedor_cprovee= $_POST['Proveedor_cprovee'];
    $serializedSucursal = $_COOKIE['sucursal'];
    $suc = unserialize($serializedSucursal);
    $aux= $suc->getCsucursal();
    $result = controladorInsertarProducto($cp, $nombre, $precioCompra, $precioVenta, $categoria, $Proveedor_cprovee);
    controladorInsertarInventario($cantidad, true, $aux, $cp);
    echo"resultado: $result";
    
        header('Location: ../inventario/view_inventario.php');

  
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
            <span>Registrar Producto</span>
        </nav>
        <a href="../pagina_principal/enrutamiento.php"><b>Menú</b></a>
    </header>
    <main>
        <div class="container">
            <div class="white-box">
                <h1>AGREGAR PRODUCTO NUEVO</h1>
                <br>
                <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4 login-container">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <p> Codigo de producto: </p>
                            <input type="number" name="cp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p> Nombre del producto nuevo: </p>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p>Cantidad: </p>
                            <input type="text" name="cantidad" class="form-control" required>
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
                            <p> Categoria: </p>
                            <select name="categoria" class="form-control" required>
                                <option value="Electrónica">Electrónica</option>
                                <option value="Limpieza">Limpieza</option>
                                <option value="Carne">Carne</option>
                                <option value="Lacteos">Lacteos</option>
                                <option value="Verduras">Verduras</option>
                                <option value="Hogar">Hogar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <p> Proveedor: </p>
                            <select name="Proveedor_cprovee" class="form-control" required>
                                <?php
                                $proveedores = controladorSeleccionarTodosLosProveedores();
                                foreach ($proveedores as $proveedor) {
                                    echo "<option value='" . $proveedor->getCproveedor() . "'>" . $proveedor->getNombre() . "</option>";
                                }
                                ?>
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