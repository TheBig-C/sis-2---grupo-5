<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/styles_jhes.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript" src="../../js/script.js"></script>
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
  
<div class="narvar">
    <img class="imagenNavar" src="https://ilacad.com/BO/data/logos_cadenas/Bolivia_Ketal_Logo.png" alt="">
    <button type="button" class="btn btn-primary" onclick="window.location.href='../pagina_principal/enrutamiento.php';">Salir</button>
 
</div>
<div class="base">
    <div class="baseIzquierda">
    <div class="contenedorBoton">
            <form method="get">
                <input type="text" name="busqueda" placeholder="Buscar..." value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
                <select name="categoria">
                    <option value="">Todas las Categorías</option>
                    <?php
                    include_once 'C:\xampp\htdocs\sis2-ketal\backend\controllers\controllers.php';

                $categorias = controladorSeleccionarTodosLosProductos();
                $cat=[];
                foreach ($categorias as $key => $value) {
                    $categoria = $value->getCategoria();
                    if (!in_array($categoria, $cat)) {
                        $cat[] = $categoria;
                    }
                }
                
                foreach ($cat as $key => $value) {
                    echo "<option value='$value'>{$value}</option>";
                }
                ?>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </div>

         
        <br>
        <div class="contenedor">
            <div class="section_our_solution">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="our_solution_category">
                    <div class="solution_cards_box">
                    <?php
                        include_once 'C:\xampp\htdocs\sis2-ketal\backend\controllers\controllers.php';
                        $inv = 0;
                        $h = 150;
                        $w = 150;
                        $apiKey = 'AIzaSyD_VD0W_aE-tnFKTJwSfFIzGmD3BrIgYkU';
                        $cx = 'b6b21b544d2f945bf';

                        $serializedSucursal = $_COOKIE['sucursal'];
                        $suc = unserialize($serializedSucursal);
                        $aux = $suc->getCsucursal();

                        // Capturar la búsqueda
                            $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
                            // Capturar la categoría seleccionada
                            $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';


                                                    // Filtrar productos según la búsqueda
                            // Filtrar productos según la búsqueda y la categoría
                            $productos = controladorSeleccionarProductosPorNombreYSucursal($busqueda, $aux, $categoria);

                        foreach ($productos as $producto) {
                            $inv = controladorSeleccionarInventarioPorProductoYSucursal($producto->getCp(), $aux);
                            $cant = $inv->getCantidad();
                            $query = urlencode($producto->getNombre());

                            $url = "https://www.googleapis.com/customsearch/v1?key=$apiKey&cx=$cx&q=$query&searchType=image&num=1";

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $response = curl_exec($ch);
                            curl_close($ch);
                            $l = "https://cdn-icons-png.flaticon.com/512/3240/3240782.png";

                            $result = json_decode($response);
                            $im = htmlspecialchars($query);

                            if (isset($result->items)) {
                                foreach ($result->items as $item) {
                                    $l = $item->link;
                                }
                            } 

                            echo "<div class='solution_card'>
                                    <div class='hover_color_bubble'></div>
                                    <div class='so_top_icon large-icon'>
                                        <img src='$l' alt='$im'>
                                    </div>
                                    <div class='solu_title'>
                                        <h3>{$producto->getNombre()}</h3>
                                    </div>
                                    <div class='solu_description'>
                                        <p>Precio: {$producto->getPrecioVenta()} Bs.</p>
                                        <p>Cantidad: {$inv->getCantidad()}</p>
                                        <button type='button' class='read_more_btn' onclick='agregarLista(this)' data-cp='{$producto->getCp()}' data-nombre='{$producto->getNombre()}' data-precio-venta='{$producto->getPrecioVenta()}' data-cantidad='1'>Agregar</button>
                                        <input type='number' value='0' min='0' max='$cant' style='width: 60px;' onchange='updateCantidad(this, {$producto->getCp()})'>
                                    </div>
                                </div>";
                        }
                        ?>

                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
        <div class="baseDerecha">
            
            <div class="contenedor1">
                <div class="">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                   
                        <div class="solution_cards_box1">
                        <div class="solution_card">
                            <div class="hover_color_bubble"></div>
                           
                            <h1>Venta</h1>
                           
                          
                            <div class="solu_title">
                                <h3 style="margin-right: 2rem;">Detalles de la venta</h3>
                            </div>
                            <div class="Contendorproducto">
                                <div class="row">
                                <h5 class="tituloProducto">Producto:</h5><p>Precio:</p>
                            </div>
                           <div class=" contendorDeProductos">

                              
                                
                              
                                
                               
                               
                               
                    </div>   
                        <div class=" ContendorTotales">
                            <div class="solu_description">
                                <div class="Contendorproducto">
                                    <div class="row">
                                    <h5 class="tituloProducto2"> Total      </h5><p>    0.0</p>
                                </div>
                                <div class="form-group">
                                    <label for="metodoPago">Método de Pago:</label>
                                    <select class="form-control" id="metodoPago">
                                        <option value="efectivo">Efectivo</option>
                                        <option value="tarjeta">Tarjeta</option>
                                        <option value="qr">QR</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="read_more_btn" onclick="realizarVenta()">Realizar venta</button>
                         
                     
                       
                        </div>
                        <!--  -->
                       
                   
                    </div>
                </div>
                </div>
            </div>
        </div>
</div>
<!-- Modal para datos del cliente -->
<div class="modal" id="clienteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ingrese Datos del Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="datosClienteForm">
                    <div class="form-group">
                        <label for="clienteCI">CI del Cliente:</label>
                        <input type="text" class="form-control" id="clienteCI" required>
                    </div>
                    <div class="form-group">
                        <label for="clienteNombres">Nombres:</label>
                        <input type="text" class="form-control" id="clienteNombres" required>
                    </div>
                    <div class="form-group">
                        <label for="clienteApellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="clienteApellidos" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="finalizarVenta()">Finalizar Venta</button>
                    <button type="button" class="btn btn-primary" onclick="finalizarVentaWD()">Finalizar Venta sin datos</button>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>