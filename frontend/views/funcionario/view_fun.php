<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            left: 0;
            width: 100%;
            padding: 0vh 5vh;
            background: aliceblue;
            justify-content: space-between;
            align-items: center;
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
        .form-container {
            background-color: #edf2f4;
            padding: 2rem;
            margin-top: 40px; 
            margin-bottom: 2rem;
            border-radius: 8px;
            width: 60%;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn-red {
            background-color: #ef233c;
            border: none;
            color: white;
            padding: 0.75rem;
            font-size: 1.25rem;
            display: block;
            width: 50%;
            margin: 1rem auto;
        }
        .btn-red:hover {
            background-color: #d90429;
        }
        .form-input label {
            font-weight: bold;
            color: #2b2d42;
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
        }
        .form-input input, .form-input select {
            width: 100%;
            padding: 0.75rem;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .container {
            display: flex;
            justify-content: center;
            padding-top: 80px;
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
<body>
    <header class="header">
        <nav class="navbar">
            <img src="/sis2-Ketal//frontend/assets/ketal.png">
            <span>Registrar Empleado</span>
        </nav>
        <a href="../pagina_principal/enrutamiento.php"><b>Menú</b></a>
    </header>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Empleado</h2>
            <form action="agregar_fun.php" method="post">
                <div class="form-input">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-input">
                    <label for="tipo">Tipo:</label>
                    <select class="form-control" id="tipo" name="tipo" required>
                        <option value="">Selecciona un tipo</option>
                        <option value="administrador">Administrador</option>
                        <option value="cajero">Cajero</option>
                        <option value="operativo">Operativo</option>
                    </select>
                </div>
                <div class="form-input">
                    <label for="cf">CI:</label>
                    <input type="text" class="form-control" id="cf" name="cf" required>
                </div>
                <div class="form-input">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-red">Agregar Empleado</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
        window.onload = function() {
            // Obtener parámetros de URL
            const urlParams = new URLSearchParams(window.location.search);
            const result = urlParams.get('result');
            const message = urlParams.get('message');
            if (message) {
                Swal.fire({
                    title: 'Resultado de la operación',
                    text: decodeURIComponent(message),
                    icon: result === 'success' ? 'success' : 'error',
                    confirmButtonColor: '#ef233c',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Recargar la página para limpiar la URL
                        window.location.href = 'view_fun.php';
                    }
                });
            }
        }
        </script>
</body>
</html>
