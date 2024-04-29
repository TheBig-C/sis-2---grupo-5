<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden; 
        }
        .header {
            display: flex;
            position: fixed;
            top: 0;
            left:0;
            width: 100%;
            padding: 0vh 5vh;
            background: aliceblue;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }
        .header a {
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
        .navbar span {
            color: #14141E;
            padding-left: 3vh;
            padding-right: 3vh;
            font-size: 6vh;
        }
        .navbar img {
            width: 15vh;
            height: auto;
        }
        .container.mt-5 {
            padding-top: 50px; 
            margin-top: 0;
        }
        .btn-option {
            height: 150px;
            margin: 10px;
            font-size: 1.5em;
            background-color: #ef233c;
            border-color: #ef233c; 
            color: white; 
            display: flex; 
            justify-content: center; 
            align-items: center;
            text-align: center; 
        }
        .btn-option:hover {
            background-color: #d90429; 
            border-color: #d90429;
        }
        @media (min-width: 768px) {
            .btn-option {
                height: calc(50vh - 70px);
                width: calc(33.333% - 20px);
            }
            .btn-option-large {
                width: calc(25% - 20px);
            }
        }
    </style>
</head>
<body class="body-suc">
    <header class="header">
        <nav class="navbar">
            <img src="/sis2-Ketal//frontend/assets/ketal.png">
            <span>Menú de Opciones</span>
        </nav>
        <a href="../auth/login.html"><b>Salir</b></a>
    </header>
    <div class="container mt-5">
        <div class="row text-center options-container">
            <!-- Botones de las opciones en la primera fila -->
            <a href="../ventas/view_realizar_venta.php" class="btn btn-option">REGISTRAR VENTA</a>
<<<<<<< HEAD
            <a href="../pedido/agregar_pedido.php" class="btn btn-option">REGISTRAR PEDIDO</a>
            <a href="../productos/view_register_product.php" class="btn btn-option">AGREGAR PRODUCTOS NUEVO</a>
=======
            <a href="../pedido/view_pedido.php" class="btn btn-option">REALIZAR PEDIDO</a>
            <a href="../productos/view_register_product.php" class="btn btn-option">AGREGAR NUEVO PRODUCTO</a>
>>>>>>> f44566ca14438661ab51170478c578166682d66d
        </div>
        <div class="row text-center options-container">
            <!-- Botones de las opciones en la segunda fila -->
            <a href="../funcionario/view_fun.php" class="btn btn-option btn-option-large">AGREGAR EMPLEADO</a>
<<<<<<< HEAD
            <a href="../pedido/view_pedido.php" class="btn btn-option btn-option-large">PEDIDOS</a>
=======
            <a href="?" class="btn btn-option btn-option-large">PEDIDOS</a>
            <a href="../inventario/view_inventario.php" class="btn btn-option btn-option-large">INVENTARIO</a>
            <a href="../ventas/view_ventas.php" class="btn btn-option btn-option-large">VENTAS</a>
>>>>>>> f44566ca14438661ab51170478c578166682d66d
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
