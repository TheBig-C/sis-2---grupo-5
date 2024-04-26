<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="frontend/css/style.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <img src="frontend/assets/ketal.png">
            <a href="productos.php"><b>Productos</b></a>
            <span> | </span>
            <a href="ventas.php"><b>Ventas</b></a>
        </nav>
        <a href="login.html"><b>Iniciar Sesion</b></a>
    </header>
</body>
</html>

<?php
// Redireccionar al navegador hacia la página de inicio de sesión
header('Location: frontend/views/auth/login.html');
exit;
?>
