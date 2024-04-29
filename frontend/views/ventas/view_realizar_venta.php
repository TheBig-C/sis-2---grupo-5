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

</head>
<body>
  
<div class="narvar">
    <img class="imagenNavar" src="https://ilacad.com/BO/data/logos_cadenas/Bolivia_Ketal_Logo.png" alt="">
       
</div>
<div class="base">
    <div class="baseIzquierda">
    <div class="contenedorBoton">
                <input type="text" placeholder="Buscar...">
                <button type="button">Buscar</button>
                <select>
                    <?php
                    include_once 'C:\xampp\htdocs\sis2-ketal\backend\controllers\controllers.php';

                $categorias = controladorSeleccionarTodosLosProductos();
                
                foreach ($categorias as $key => $value) {
                    echo "<option value='$key'>{$value->getCategoria()}</option>";
                }
                ?>
                </select>
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
                               $inv=0;
                               $h=150;
                               $w=150;
                               $apiKey = 'AIzaSyD_VD0W_aE-tnFKTJwSfFIzGmD3BrIgYkU';
                                    $cx = 'b6b21b544d2f945bf';
                                   
                                $serializedSucursal = $_COOKIE['sucursal'];
                                $suc = unserialize($serializedSucursal);
                                $aux= $suc->getCsucursal();
                                $productos = controladorSeleccionarTodosLosProductosSucursal($aux);

                                foreach ($productos as $producto) {
                                    $inv=controladorSeleccionarInventarioPorProductoYSucursal($producto->getCp(),$aux);
                                    $query = urlencode($producto->getNombre());

                                    $url = "https://www.googleapis.com/customsearch/v1?key=$apiKey&cx=$cx&q=$query&searchType=image&num=1";

                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, $url);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    $response = curl_exec($ch);
                                    curl_close($ch);

                                    $result = json_decode($response);
                                    if (isset($result->items)) {
                                        foreach ($result->items as $item) {
                                            $l=$item->link;
                                            $im=htmlspecialchars($query);

                                        }
                                    } else {
                                        echo 'No se encontraron imágenes.';
                                    }

                                    echo "<div class='solution_card'>
                                        <div class='hover_color_bubble'></div>
                                        <div class='so_top_icon large-icon'>
                                            <img src='$l' alt='$im' >
                                        </div>

                                        <div class='solu_title'>
                                            <h3>{$producto->getNombre()}</h3>
                                        </div>
                                        <div class='solu_description'>
                                            <p>Precio: {$producto->getPrecioVenta()} Bs.</p>
                                            <button type='button' class='read_more_btn' onclick='agregarLista(this)' data-cp='{$producto->getCp()}' data-nombre='{$producto->getNombre()}' data-precio-venta='{$producto->getPrecioVenta()}' data-cantidad='1'>Agregar</button>
                                            <input type='number' value='0' min='0' style='width: 60px;' onchange='updateCantidad(this, {$producto->getCp()})'>
                                            
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
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>