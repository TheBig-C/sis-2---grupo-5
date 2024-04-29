<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/styles_inv.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../../js/script.js"></script>

</head>

<body>

    <div class="narvar">
        <img class="imagenNavar" src="https://ilacad.com/BO/data/logos_cadenas/Bolivia_Ketal_Logo.png" alt="">
        <button type="button" class="btn btn-primary" onclick="window.location.href='../pagina_principal/pagina_opciones.php';">Salir</button>

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
                                            <button type='button' class='read_more_btn' 
                                                onclick='updateDetails(this)'
                                                data-cp='{$producto->getCp()}'
                                                data-cinv='{$inv->getCinv()}'
                                                data-nombre='{$producto->getNombre()}'
                                                data-cantidad='{$inv->getCantidad()}'
                                                data-precio-venta='{$producto->getPrecioVenta()}'
                                                data-precio-compra='{$producto->getPrecioCompra()}'
                                                data-inventario='{$inv->getEstado()}'
                                                data-categoria='{$producto->getCategoria()}'>Ver más</button>
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
                <div class="section_our_solution">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="solution_cards_box1">
                                <div class="solution_card">
                                    <div class="hover_color_bubble"></div>
                                    <h1>Detalles del Producto</h1>
                                    <?php
                                // Asumiendo que se selecciona un producto específico para detalles
                               
                                echo "<div class='solu_description'>
                                <h5></h5><input id='cp' value='' readonly hidden>
                                <h5></h5><input id='cinv' value='' readonly hidden>
                                <h5>Nombre:</h5><input id='detalle_nombre' value='' readonly>
                                <h5>Cantidad:</h5><input id='detalle_cantidad' value='' readonly>
                                <h5>Precio venta:</h5><input id='detalle_precio_venta' value='' readonly>
                                <h5>Precio compra:</h5><input id='detalle_precio_compra' value='' readonly>
                                <h5>Estado:</h5><input id='detalle_inventario' value='' readonly>
                                <h5>Categoria:</h5><input id='detalle_categoria' value='' readonly>
                                <button type='button' id='edit_button' onclick='editProduct()'>Editar</button>
                                <button type='button' id='delete_button' onclick='deleteProduct()'>Eliminar</button>
                            </div>
                            ";
                        

                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>