<?php

include_once 'C:\xampp\htdocs\sis2-Ketal\backend\controllers\controllers.php';

$ventas = [];

if (isset($_GET['cliente'])) {
    $ci_cliente = $_GET['cliente'];
    if (!empty($ci_cliente)) { 
        $ventas = controladorSeleccionarVentasPorCliente($ci_cliente);
    } else { 
        $ventas = controladorSeleccionarTodasLasVentas();
    }
} else {
    $ventas = controladorSeleccionarTodasLasVentas();
}

// Si se ha enviado el formulario de eliminación
if(isset($_POST['eliminar_venta'])) {
    $cv = $_POST['cv'];
    controladorEliminarVenta($cv);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/sis2-ketal/frontend/css/styleJhuly.css">
    <link rel="stylesheet" href="/sis2-ketal/frontend/css/style.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <img src="/sis2-Ketal//frontend/assets/ketal.png">
            <span>Ventas</span>
        </nav>
        <a href="../pagina_principal/pagina_opciones.php"><b>Menú</b></a>
    </header>
    <main>
    <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Buscar cliente -->
                    <form action="" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Buscar cliente..." name="cliente">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- Filtros -->
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="reciente" autocomplete="off">
                        <label class="btn btn-outline-primary" for="reciente">Más reciente</label>

                        <input type="radio" class="btn-check" name="btnradio" id="antiguo" autocomplete="off">
                        <label class="btn btn-outline-primary" for="antiguo">Más antiguo</label>
                    </div>
                </div>
            </div>
            <!-- Tabla de ventas -->
            <div class="table-responsive">
                <div class="tablas container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">CV</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Método</th>
                                <th scope="col">Total</th>
                                <th scope="col">Total Entregado</th>
                                <th scope="col">Tipo de Pago</th>
                                <th scope="col">CI Cliente</th>
                                <th scope="col">Funcionario CF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventas as $venta): ?>
                                <tr>
                                    <td><?php echo $venta->getCv(); ?></td>
                                    <td><?php echo $venta->getFecha(); ?></td>
                                    <td><?php echo $venta->getHora(); ?></td>
                                    <td><?php echo $venta->getEstado(); ?></td>
                                    <td><?php echo $venta->getTotal(); ?></td>
                                    <td><?php echo $venta->getTotalEntregado(); ?></td>
                                    <td><?php echo $venta->getTipodepago(); ?></td>
                                    <td><?php echo $venta->getCiCliente(); ?></td>
                                    <td><?php echo $venta->getFuncionarioCf(); ?></td>
                                    
                                    <!-- Formulario para eliminar una venta
                                    <td> 
                                    <form action="" method="POST">
                                            <input type="hidden" name="cv" value=" ppp echo $venta->getCv(); ">
                                            <button type="submit" name="eliminar_venta" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                    -->
                                    <td>
                                    <button type="button" class="btn btn-primary" onclick="mostrarProductos('<?php echo $venta->getCv(); ?>')">Ver más</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!--Productos de la respectiva venta -->
                    <!-- Tabla para mostrar los productos de la respectiva venta -->
                    <table class="table table-striped productosventa">
                        <thead>
                            <tr>
                                <th scope="col">Productos de la venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventas as $venta): ?>
                                <tr id="productosVenta_<?php echo $venta->getCv(); ?>" style="display: none;">
                                    <td>
                                        <!-- Listado de productos de la respectiva venta -->
                                        <?php 
                                        // Obtener los productos de la venta actual
                                        $productosVendidos = controladorSeleccionarProductosVendidosPorVenta($venta->getCv());
                                        foreach ($productosVendidos as $productoVendido): 
                                            // Aquí podrías incluir la lógica necesaria para obtener más detalles del producto
                                            $producto = controladorSeleccionarProducto($productoVendido->getProductoCp());
                                            echo $producto->getNombre(). '<br>';
                                        ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </main>
</body>
</html>

<script>
        function mostrarProductos(idVenta) {
            // Obtener el elemento tr correspondiente a la venta
            var filaVenta = document.getElementById('productosVenta_' + idVenta);
            
            // Cambiar la visibilidad de la fila
            if (filaVenta.style.display === 'none') {
                filaVenta.style.display = 'table-row';
            } else {
                filaVenta.style.display = 'none';
            }
        }
    </script>