<?php
include_once '../../../backend/core/conexion.php';
include_once '../../../backend/models/Producto.php';
include_once '../../../backend/models/Proveedor.php';

$categorias = Producto::obtenerCategorias();
$productos = Producto::seleccionarTodosLosProductos();
$proveedores = Proveedor::seleccionarTodosLosProveedores();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
<style>
    html, body { margin: 0; padding: 0; overflow-x: hidden; background-color: #2b2d42; }
    .title-bar { background-color: transparent; color: white; padding: 10px 20px; display: flex; align-items: center; justify-content: space-between; position: fixed; top: 0; left: 0; right: 0; z-index: 1000; }
    .title-bar img { width: 100px; }
    .container-fluid { padding-top: 120px; }
    .card { background-color: #edf2f4; border-radius: 8px; margin-bottom: 1rem; }
    .card-header { background-color: #edf2f4; border-bottom: 0; }
    .card-body { padding: 20px; }
    .menu-button { background-color: #ef233c; border: none; color: white; padding: 0.5rem 1rem; font-size: 1rem; border-radius: 5px; cursor: pointer; }
    .menu-button:hover { background-color: #d90429; }
    .input-group-text { background-color: #edf2f4; border: 0; padding: 0.375rem 0.75rem; }
    .form-control { border: 0; }
    .btn-red { background-color: #ef233c; border: none; color: white; padding: 10px 20px; font-size: 1rem; margin-top: 10px; cursor: pointer; }
    .btn-red:hover { background-color: #d90429; }
</style>
</head>
<body>
    <div class="title-bar">
        <img src="../../../frontend/assets/ketal.png" alt="Ketal Logo">
        <h1>Realizar Pedido</h1>
        <button class="menu-button" onclick="window.location.href='../../../frontend/views/pagina_principal/pagina_opciones.php'">Menú</button>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Columna de productos -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Productos | Pedido</h2>
                        <select class="form-control" id="filtro-categoria">
                            <option value="todos">Ver todos</option>
                            <?php foreach ($categorias as $categoria) { ?>
                                <option value="<?php echo htmlspecialchars($categoria); ?>"><?php echo htmlspecialchars($categoria); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="card-body">
                        <?php
                        foreach ($productos as $producto) {
                            echo '<div class="form-group" data-categoria="' . htmlspecialchars($producto->getCategoria()) . '">';
                            echo '<div class="form-check">';
                            echo '<input type="checkbox" class="form-check-input">';
                            echo '<label class="form-check-label" for="producto-' . $producto->getCp() . '">' . $producto->getNombre() . '</label>';
                            echo '</div>';
                            echo '<input type="number" class="form-control cantidad" placeholder="Cantidad">';
                            echo '<select class="form-control proveedor-menu">';
                            foreach ($proveedores as $proveedor) {
                                echo '<option value="' . $proveedor->getCproveedor() . '">' . $proveedor->getNombre() . '</option>';
                            }
                            echo '</select>';
                            echo '<input type="hidden" class="producto-cp" value="' . $producto->getCp() . '">';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Columna de pedidos -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Pedidos</h2>
                    </div>
                    <div class="card-body">
                        <form id="pedido-form" method="post">
                            <div id="productos-seleccionados"></div>
                            <button type="button" class="btn-red mt-3" id="realizar-pedido">Realizar pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="mensaje-exito" class="alert alert-success" role="alert" style="display: none;">
        <span>Pedido registrado con éxito</span>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#filtro-categoria').change(function() {
            var categoriaSeleccionada = $(this).val();
            $('.form-group').each(function() {
                if (categoriaSeleccionada == 'todos' || $(this).data('categoria') == categoriaSeleccionada) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        // Función para limpiar la página
        function limpiarPagina() {
            // Deseleccionar todos los checkboxes
            $('.form-check-input').prop('checked', false);
            
            // Vaciar todos los campos de cantidad
            $('.cantidad').val('');
            
            // Actualizar la columna de pedidos después de limpiar la página
            actualizarPedidos();
        }
        
        // Función para mostrar el mensaje de éxito y limpiar la página
        function mostrarExito() {
            $('#mensaje-exito').show(); // Mostrar el mensaje de éxito
            limpiarPagina(); // Limpiar la página inmediatamente
        }
        
        // Función para actualizar la columna de pedidos (mantenida igual)
        function actualizarPedidos() {
            // Limpiar la lista de pedidos actual
            $('#productos-seleccionados').empty();
            
            // Iterar sobre cada producto en la lista de productos
            $('.form-group').each(function() {
                var $checkbox = $(this).find('.form-check-input');
                
                // Verificar si el checkbox está marcado y si se ha seleccionado un proveedor
                if ($checkbox.is(':checked')) {
                    var productName = $(this).find('label').text();
                    var quantity = $(this).find('.cantidad').val();
                    var provider = $(this).find('.proveedor-menu').val();
                    var productCP = $(this).find('.producto-cp').val(); // Obtener el Producto_cp del campo oculto
                    
                    // Verificar si se ha seleccionado un proveedor
                    if (provider !== "") {
                        // Agregar el producto seleccionado a la columna de pedidos
                        $('#productos-seleccionados').append('<div class="pedido-item"><input type="hidden" name="productos[]" value="' + productName + ',' + quantity + ',' + provider + ',' + productCP + '">' + productName + ' - Cantidad: ' + quantity + ' - Proveedor: ' + provider + '</div>');
                    }
                }
            });
        }
        
        // Llamar a la función de actualización cuando cambie el estado del checkbox, la cantidad o la selección de proveedor (mantenida igual)
        $('.form-check-input, .cantidad, .proveedor-menu').change(function() {
            actualizarPedidos();
        });

        // Manejar el clic en el botón "Realizar pedido"
        $('#realizar-pedido').click(function() {
            $.ajax({
                type: 'POST',
                url: 'agregar_pedido.php', // Ruta del archivo PHP en el backend
                data: $('#pedido-form').serialize(), // Serializar los datos del formulario
                success: function(response) {
                    mostrarExito(); // Mostrar el mensaje de éxito y limpiar la página
                },
                error: function(xhr, status, error) {
                    // Manejar cualquier error que ocurra durante la solicitud AJAX (opcional)
                    console.error(xhr.responseText); // Mostrar el mensaje de error en la consola del navegador
                }
            });
        });

        // Manejar el clic en el botón de cierre del mensaje
        $('#mensaje-exito .close').click(function() {
            $('#mensaje-exito').hide(); // Ocultar el mensaje
        });
    });
</script>


    <script>
    $(document).ready(function() {
        // Función para actualizar la columna de pedidos
        function actualizarPedidos() {
            // Limpiar la lista de pedidos actual
            $('#productos-seleccionados').empty();
            
            // Iterar sobre cada producto en la lista de productos
            $('.form-group').each(function() {
                var $checkbox = $(this).find('.form-check-input');
                
                // Verificar si el checkbox está marcado y si se ha seleccionado un proveedor
                if ($checkbox.is(':checked')) {
                    var productName = $(this).find('label').text();
                    var quantity = $(this).find('.cantidad').val();
                    var provider = $(this).find('.proveedor-menu').val();
                    var productCP = $(this).find('.producto-cp').val(); // Obtener el Producto_cp del campo oculto
                    
                    // Verificar si se ha seleccionado un proveedor
                    if (provider !== "") {
                        // Agregar el producto seleccionado a la columna de pedidos
                        $('#productos-seleccionados').append('<div class="pedido-item"><input type="hidden" name="productos[]" value="' + productName + ',' + quantity + ',' + provider + ',' + productCP + '">' + productName + ' - Cantidad: ' + quantity + ' - Proveedor: ' + provider + '</div>');
                    }
                }
            });
        }
        
        // Llamar a la función de actualización cuando cambie el estado del checkbox, la cantidad o la selección de proveedor
        $('.form-check-input, .cantidad, .proveedor-menu').change(function() {
            actualizarPedidos();
        });
    });
</script>

</body>
</html>
