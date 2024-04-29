<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <style>
    html, body { margin: 0; padding: 0; overflow-x: hidden; background-color: #2b2d42; }
    .title-bar {
        background-color: transparent; color: white; padding: 10px 20px;
        display: flex; align-items: center; justify-content: space-between;
        position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
        height: 60px; /* Asegura altura suficiente para los elementos */
    }
    .title-bar img { width: 80px; } /* Ajusta tamaño del logo */
    .container-fluid { padding-top: 100px; } /* Ajusta el padding superior */
    .menu-button {
        background-color: #ef233c; color: white; border: none;
        padding: 0.5rem 1rem; font-size: 1rem; border-radius: 5px; cursor: pointer;
    }
    .menu-button:hover { background-color: #d90429; }
    .btn-red {
        background-color: #ef233c; color: white; border: none;
        padding: 10px 20px; font-size: 1rem; cursor: pointer;
        margin-top: 10px; /* Ajustar si necesario */
    }
    .btn-red:hover { background-color: #d90429; }
    


</style>

</head>
<body>
    <?php
    include_once '../../../backend/core/conexion.php';
    include_once '../../../backend/models/DetallePedido.php';

    $detallesPedidos = DetallePedido::seleccionarDetallePedido();

    function fetchAllPendingOrders() {
        $conn = conexion();
        $query = "SELECT p.*, f.nombre AS funcionario_nombre, s.zona AS sucursal_zona 
                  FROM Pedido p
                  JOIN Funcionario f ON p.Funcionario_cf = f.cf
                  JOIN Sucursal s ON p.sucursal_csucursal = s.csucursal
                  WHERE p.estado = 'Pendiente'";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Error al recuperar los pedidos pendientes.\n";
            exit;
        }
        return pg_fetch_all($result);
    }

    function getFuncionariosOptions() {
        $conn = conexion();
        $query = "SELECT cf, nombre FROM Funcionario";
        $result = pg_query($conn, $query);
        return pg_fetch_all($result);
    }

    function getSucursalesOptions() {
        $conn = conexion();
        $query = "SELECT csucursal, zona FROM Sucursal";
        $result = pg_query($conn, $query);
        return pg_fetch_all($result);
    }

    $pedidos = fetchAllPendingOrders();
    $funcionarios = getFuncionariosOptions();
    $sucursales = getSucursalesOptions();
    ?>
    
    <header class="header">
        <nav class="navbar">
            <img src="/sis2-Ketal//frontend/assets/ketal.png">
            <span>Pedidos</span>
        </nav>
        <a href="../pagina_principal/pagina_opciones.php"><b>Menú</b></a>
    </header>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Detalles Pedidos</h2>
                    </div>
                        <div class="card-body">
                        <!-- Lista de pedidos pendientes -->
                            <div class="form-group">
                            <label for="pedidoProductoDropdown">Seleccione un Detalle de Pedido:</label>
                            <select class="form-control" id="pedidoProductoDropdown" name="pedidoProductoDropdown">
                                <?php foreach ($detallesPedidos as $detalle): ?>
                                    <option value="<?= $detalle->getCpp() ?>">
                                <?= "CPP: {$detalle->getCpp()} - Cantidad: {$detalle->getCantidad()} - Producto: {$detalle->getProducto_cp()} - Proveedor: {$detalle->getProveedor_cproveedor()}" ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Fecha de Pedido:</label>
                            <input type="date" class="form-control" name="fecha_pedido" value="">
                        </div>
                        <div class="form-group">
                            <label>Fecha de Entrega:</label>
                            <input type="date" class="form-control" name="fecha_entrega" value="">
                        </div>
                        <div class="form-group">
                            <label>Funcionario:</label>
                            <select class="form-control" name="Funcionario_cf">
                                <?php foreach ($funcionarios as $funcionario): ?>
                                    <option value="<?= $funcionario['cf'] ?>" <?= (isset($pedido['Funcionario_cf']) && $funcionario['cf'] == $pedido['Funcionario_cf']) ? 'selected' : '' ?>>
                                        <?= $funcionario['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sucursal:</label>
                            <select class="form-control" name="sucursal_csucursal">
                                <?php foreach ($sucursales as $sucursal): ?>
                                    <option value="<?= $sucursal['csucursal'] ?>" <?= (isset($pedido['sucursal_csucursal']) && $sucursal['csucursal'] == $pedido['sucursal_csucursal']) ? 'selected' : '' ?>>
                                        <?= $sucursal['zona'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Estado:</label>
                            <select class="form-control" name="estado">
                                <option value="Pendiente" <?= (isset($pedido['estado']) && $pedido['estado'] == 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                                <option value="Entregado" <?= (isset($pedido['estado']) && $pedido['estado'] == 'Entregado') ? 'selected' : '' ?>>Entregado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="actualizarPedidoBtn">Actualizar Pedido</button>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h2>Pedidos Completados</h2>
        </div>
        <div class="card-body">
            <!-- Este div contendrá los pedidos completados -->
            <div id="pedidosCompletados">
            </div>
            <!-- El botón se coloca fuera del div #pedidosCompletados para que no sea eliminado -->
            <button type="button" class="btn-red mt-3" id="guardarPedidoBtn">Guardar Pedido</button>
        </div>
    </div>
    <div id="mensaje-exito" class="alert alert-success" role="alert" style="display: none;">
        <span>Pedido registrado con éxito</span>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Scripts para manejar la lógica de pedidos aquí -->
    
    <script>
$(document).ready(function() {
    
    // Función para mover elementos de la lista de pedidos pendientes a la lista de pedidos completados
    $("#actualizarPedidoBtn").click(function() {
        var fechaPedido = $("input[name='fecha_pedido']").val();
        var fechaEntrega = $("input[name='fecha_entrega']").val();
        var estado = $("select[name='estado']").val();
        var funcionarioCf = $("select[name='Funcionario_cf'] option:selected").text();
        var sucursalZona = $("select[name='sucursal_csucursal'] option:selected").text();
        var pedidoProductoCpp = $("#pedidoProductoDropdown option:selected").text();

        var nuevoPedidoHTML = `
            <div class="pedido-completado">
                <p>Fecha de Pedido: ${fechaPedido}</p>
                <p>Fecha de Entrega: ${fechaEntrega}</p>
                <p>Estado: ${estado}</p>
                <p>Funcionario: ${funcionarioCf}</p>
                <p>Sucursal: ${sucursalZona}</p>
                <p>Pedido Producto CPP: ${pedidoProductoCpp}</p>
            </div>
        `;

        $("#pedidosCompletados").append(nuevoPedidoHTML);
    });

    $("#guardarPedidoBtn").click(function() {
    var datos = {
        fecha_pedido: $("input[name='fecha_pedido']").val(),
        fecha_entrega: $("input[name='fecha_entrega']").val(),
        estado: $("select[name='estado']").val(),
        funcionario_cf: $("select[name='Funcionario_cf']").val(),
        sucursal_csucursal: $("select[name='sucursal_csucursal']").val(),
        pedido_producto_cpp: $("#pedidoProductoDropdown").val()
    };

    $.ajax({
        url: "agregar_epedido.php",
        type: "POST",
        data: datos,
        success: function(response) {
            $("#mensaje-exito").html('<span>' + response + '</span><button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>').show();
            setTimeout(function() {
                $("#mensaje-exito").fadeOut('slow', function() {
                    // Después de que el mensaje se desvanezca, limpia los campos y luego recarga la página.
                    limpiarCampos();
                    setTimeout(function() {
                        console.log("Recargando la página...");
                        window.location.reload();
                    }, 1000); // Añadimos un pequeño retraso después de limpiar campos para asegurarnos de que todo está listo antes de recargar.
                });
            }, 4000);
        },
        error: function(xhr, status, error) {
            console.error("Error AJAX: " + error);
            console.error("Detalles: " + xhr.responseText);
        }
    });
});


    function limpiarCampos() {
        $("input[name='fecha_pedido'], input[name='fecha_entrega']").val('');
        $("select[name='Funcionario_cf'], select[name='sucursal_csucursal'], select[name='estado'], #pedidoProductoDropdown").prop('selectedIndex', 0);
        $("#pedidosCompletados").empty(); // Limpia el contenido de los pedidos completados
    }

    $(document).on('click', '#mensaje-exito .close', function() {
        $("#mensaje-exito").hide();
    });
});
</script>

</body>
</html>

