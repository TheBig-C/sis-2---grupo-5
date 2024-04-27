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
        .title-bar {
            background-color: white;
            color: black;
            padding: 10px 20px; 
            display: flex;
            align-items: center;
            justify-content: start;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-image: url('../../../frontend/assets/ketal.png'); 
            background-repeat: no-repeat;
            background-position: left 10px center; 
            background-size: 100px; 
            justify-content: space-between; /* Alinea los elementos a los extremos */
        }
        .title-bar h1 {
            margin-left: 100px; 
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
                width: calc(50% - 20px);
               
            }
        }
        .menu-button {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            background-color: #ef233c; 
            color: white;
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }

        .menu-button:hover {
            background-color: #d90429; 
        }
    </style>
</head>
<body class="body-suc">
<div class="title-bar">
    <h1>Menú de Opciones</h1>
    <button class="menu-button" onclick="window.location.href=('../../../frontend/views/auth/login.html')">Salir</button>
</div>
    <div class="container mt-5">
        <div class="row text-center options-container">
            <!-- Botones de las opciones en la primera fila -->
            <a href="../view_ventas.php" class="btn btn-option">REGISTRAR VENTA</a>
            <a href="../registrar_pedido.php" class="btn btn-option">REGISTRAR PEDIDO</a>
            <a href="../view_product.php" class="btn btn-option">AGREGAR PRODUCTOS NUEVO</a>
        </div>
        <div class="row text-center options-container">
            <!-- Botones de las opciones en la segunda fila -->
            <a href="../funcionario/view_fun.php" class="btn btn-option btn-option-large">AGREGAR EMPLEADO</a>
            <a href="../view_pedido.php" class="btn btn-option btn-option-large">PEDIDOS</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

