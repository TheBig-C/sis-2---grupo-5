<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/styles_inv.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../../js/script.js"></script>
    <style>
        * 
        body{
            background-color:#2B2D42;
            min-height: 100vh;
            margin-top: 15vh;
        }
        .header{
            display: flex;
            position: fixed; 
            top: 0;
            left: 0;
            width: 100%;
            height: 12vh;
            background: aliceblue;
            justify-content: space-between;
            align-items: center;
            z-index: 1000; 
            padding: 0vh 5vh;
        }
        .header a{
            color: #fff; 
            font-weight: 30;
            text-decoration: none;
            font-size: 3vh;
            background-color: #ef233c; 
            border-radius: 10px; 
            padding: 1vh 2vh; 
        }

        .header a:hover {
            background-color: #d90429; 
        }

        .navbar span{
            color: #14141E;
            padding-left: 3vh;
            padding-right: 3vh;
            font-size: 6vh;
        }
        .navbar img{
            width: 15vh;
            height: auto;
        }
    </style>

</head>

<body>
<header class="header">
        <nav class="navbar">
            <img src="/sis2-Ketal//frontend/assets/ketal.png">
            <span>Inventario</span>
        </nav>
        <a href="../pagina_principal/enrutamiento.php"><b>Menú</b></a>
    </header>

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
                        $apiKey = 'AIzaSyA5O_YqUwYkdOjjVJmlN0-TzMbmNeTPm2U';
                        $cx = 'd24d16289fefe435b';
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
                                        <button type='button' class='read_more_btn' onclick='updateDetails(this)' data-cinv='{$inv->getCinv()}' data-cp='{$producto->getCp()}' data-categoria='{$producto->getCategoria()}' data-inventario='{$inv->getEstado()}' data-nombre='{$producto->getNombre()}' data-precio-venta='{$producto->getPrecioVenta()}'  data-precio-compra='{$producto->getPrecioCompra()}'  data-cantidad='{$inv->getCantidad()}'>Vera mas..</button>
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