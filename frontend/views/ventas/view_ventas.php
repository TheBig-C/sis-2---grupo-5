<?php

include_once 'C:\xampp\htdocs\sis2-Ketal\backend\controllers\controllers.php';

$ventas = [];

// Verificar si se ha enviado el formulario de búsqueda
if (isset($_GET['buscar'])) {
    // Obtener el tipo de búsqueda seleccionado
    $tipo_busqueda = $_GET['tipo_busqueda'];

    // Realizar la búsqueda según el tipo seleccionado
    switch ($tipo_busqueda) {
        case 'cliente':
            $ci_cliente = $_GET['cliente'];
            if (!empty($ci_cliente)) { 
                $ventas = controladorSeleccionarVentasPorCliente($ci_cliente);
            } else { 
                $ventas = controladorSeleccionarTodasLasVentas();
            }
            break;
        
        case 'funcionario':
            $funcionario_cf = $_GET['funcionario'];
            if (!empty($funcionario_cf)) { 
                $ventas = controladorSeleccionarVentasPorFuncionario($funcionario_cf);
            } else { 
                $ventas = controladorSeleccionarTodasLasVentas();
            }
            break;

        case 'fecha':
            $fecha = $_GET['fecha'];
            if (!empty($fecha)) { 
                $ventas = controladorSeleccionarVentasPorFecha($fecha);
            } else { 
                $ventas = controladorSeleccionarTodasLasVentas();
            }
            break;
        case 'producto':
            $producto_nombre = $_GET['producto'];
            if (!empty($producto_nombre)) { 
                $ventas = controladorSeleccionarVentasPorProducto($producto_nombre);
            } else { 
                $ventas = controladorSeleccionarTodasLasVentas();
            }
            break;           
            
        default:
            // Si no se selecciona ningún tipo, mostrar todas las ventas
            $ventas = controladorSeleccionarTodasLasVentas();
            break;
    }
} else {
    // Si no se ha enviado el formulario, mostrar todas las ventas por defecto
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
        <a href="../pagina_principal/enrutamiento.php"><b>Menú</b></a>
    </header>
    <main>
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Formulario de búsqueda -->
                    <form action="" method="GET">
                        <div class="input-group mb-3">
                            <div class="radio-buttons">
                                <input type="radio" id="radio_cliente" name="tipo_busqueda" value="cliente" checked>
                                <label for="radio_cliente">Buscar por cliente</label>
                            
                                <input type="radio" id="radio_funcionario" name="tipo_busqueda" value="funcionario">
                                <label for="radio_funcionario">Buscar por funcionario</label>

                                <input type="radio" id="radio_producto" name="tipo_busqueda" value="producto">
                                <label for="radio_producto">Buscar por producto</label>

                                <input type="radio" id="radio_fecha" name="tipo_busqueda" value="fecha">
                                <label for="radio_fecha">Buscar por fecha</label>
                                <!-- Agregar más botones de radio para otros tipos de búsqueda si es necesario -->
                            </div>

                            <input type="text" class="form-control" placeholder="Cliente..." name="cliente" id="input_cliente">
                            <input type="text" class="form-control" placeholder="Funcionario..." name="funcionario" id="input_funcionario">
                            <input type="text" class="form-control" placeholder="Producto..." name="producto" id="input_producto">
                            <input type="text" class="form-control" placeholder="Fecha..." name="fecha" id="input_fecha">
                            <!-- Agregar más campos de entrada según los tipos de búsqueda disponibles -->

                            <button class="btn btn-primary" type="submit" name="buscar">Buscar</button>
                        </div>
                    </form>
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
                                <th scope="col">Total</th>
                                <th scope="col">Tipo de Pago</th>
                                <th scope="col">CI Cliente</th>
                                <th scope="col">Funcionario CF</th>
                                <th scope="col">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventas as $venta): ?>
                                <tr>
                                    <td><?php echo $venta->getCv(); ?></td>
                                    <td><?php echo $venta->getFecha(); ?></td>
                                    <td><?php echo $venta->getHora(); ?></td>
                                    <td><?php echo $venta->getTotal(); ?></td>
                                    <td><?php echo $venta->getTipodepago(); ?></td>
                                    <td><?php echo $venta->getCiCliente(); ?></td>
                                    <td><?php echo $venta->getFuncionarioCf(); ?></td>
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
    // Función para mostrar los productos de la venta
    function mostrarProductos(idVenta) {
        var filaVenta = document.getElementById('productosVenta_' + idVenta);
        
        if (filaVenta.style.display === 'none') {
            filaVenta.style.display = 'table-row';
        } else {
            filaVenta.style.display = 'none';
        }
    }

    // Función para cambiar los campos de entrada según el tipo de búsqueda seleccionado
    document.querySelectorAll('input[type=radio][name=tipo_busqueda]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (this.value === 'cliente') {
                document.getElementById('input_cliente').style.display = 'block';
                document.getElementById('input_funcionario').style.display = 'none';
                // Ocultar y mostrar otros campos según sea necesario
            } else if (this.value === 'funcionario') {
                document.getElementById('input_cliente').style.display = 'none';
                document.getElementById('input_funcionario').style.display = 'block';
                // Ocultar y mostrar otros campos según sea necesario
            }
              else if (this.value === 'producto') { // Agregar caso para búsqueda por producto
                document.getElementById('input_cliente').style.display = 'none';
                document.getElementById('input_funcionario').style.display = 'none';
                document.getElementById('input_producto').style.display = 'block'; // Mostrar campo de producto
                // Ocultar y mostrar otros campos según sea necesario
            }
            else if (this.value === 'fecha') { // Agregar caso para búsqueda por producto
                document.getElementById('input_cliente').style.display = 'none';
                document.getElementById('input_funcionario').style.display = 'none';
                document.getElementById('input_producto').style.display = 'none';
                document.getElementById('input_fecha').style.display = 'block';  // Mostrar campo de fecha
                // Ocultar y mostrar otros campos según sea necesario
            }
            // Agregar más casos para otros tipos de búsqueda si es necesario
        });
    });
</script>
