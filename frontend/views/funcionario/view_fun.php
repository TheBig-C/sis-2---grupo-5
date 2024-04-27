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

        .form-container {
            background-color: #edf2f4; 
            padding: 2rem;
            margin-top: 30px; 
            margin-bottom: 2rem;
            border-radius: 8px;
            width: 80%; 
            max-width: 1000px; 
        }
        .btn-red {
            background-color: #ef233c;
            border: none;
            color: white;
            padding: 1rem 0;
            font-size: 1.5rem; 
            margin-top: 1rem; 
        }
        .btn-red:hover {
            background-color: #d90429;
        }
        .form-input label {
            font-weight: bold;
            color: #2b2d42; 
            margin-bottom: 0.5rem; 
            font-size: 1.25rem 
        }
        .form-input input {
            width: 100%;
            padding: 1.25rem; 
            font-size: 1.25rem;
            margin-bottom: 1.5rem; 
        }
        .container {
            display: flex;
            justify-content: center;
            padding-top: 60px;
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
<div class="title-bar">
    <h1>Agregar Empleado</h1>
    <button class="menu-button" onclick="window.location.href=('../../../frontend/views/pagina_principal/pagina_opciones.php')">Menú</button>
</div>
    <div class="container d-flex align-items-center justify-content-center">
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
                        <option value="">Cajero</option>
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
                <button type="submit" class="btn btn-red btn-block">Agregar Empleado</button>
            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--SweetAlert para el pop-up -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const result = urlParams.get('result');
        const message = urlParams.get('message');
        // Mostrar pop-up 
        if (message) {
            Swal.fire({
                title: 'Resultado de la operación',
                text: decodeURIComponent(message),
                icon: result === 'success' ? 'success' : 'error',
                confirmButtonColor: '#ef233c',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Recargar la página 
                    window.location.href = 'view_fun.php';
                }
            });
        }
    }
    </script>

</body>
</html>
