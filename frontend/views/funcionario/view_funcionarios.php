<?php
include_once 'C:\xampp\htdocs\sis2-Ketal\backend\controllers\controllers.php';

$funcionarios = [];

// Verificar si se ha enviado el formulario de búsqueda

    // Verificar si se ha enviado el formulario de búsqueda
if (isset($_GET['funcionario'])) {
    $ci_funcionario = $_GET['funcionario'];
    if (!empty($ci_funcionario)) {
        $funcionarios = controladorSeleccionarFuncionario($ci_funcionario);
    } else {
        $funcionarios = controladorSeleccionarTodosLosFuncionarios();
    }
} else {
    // Si no se ha enviado el formulario, obtener todos los funcionarios
    $funcionarios = controladorSeleccionarTodosLosFuncionarios();
}


// Incluye aquí cualquier mensaje de error de PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/sis2-ketal/frontend/css/styleJhuly.css">
    <link rel="stylesheet" href="/sis2-ketal/frontend/css/style.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <img src="/sis2-Ketal//frontend/assets/ketal.png">
            <span>Funcionarios</span>
        </nav>
        <a href="../pagina_principal/enrutamiento.php"><b>Menú</b></a>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Formulario de búsqueda -->
                    <form action="" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Buscar funcionario por CI..." name="funcionario" id="input_funcionario">
                            <button class="btn btn-primary" type="submit" name="buscar">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Tabla de funcionarios -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CF</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Sucursal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($funcionarios)): ?>
                            <?php foreach ($funcionarios as $funcionario): ?>
                                <tr>
                                <td><?php echo $funcionario->getCf(); ?></td>
                                    <td><?php echo $funcionario->getTipo(); ?></td>
                                    <td><?php echo $funcionario->getNombre(); ?></td>
                                    <td><?php echo $funcionario->getSucursalCsucursal(); ?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No se encontraron funcionarios</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
