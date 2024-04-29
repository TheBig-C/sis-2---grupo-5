<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/styleCesar.css">
   
</head>
<body class="body-suc">
    <div class="container mt-5 title-section">
        <h2 class="text-center mb-4 text-white">Elige la sucursal</h2> <!-- Texto blanco para contraste -->
        <div class="branch-container">
        <?php
include 'C:\xampp\htdocs\sis2-ketal\backend\controllers\controllers.php';

$sucursales = controladorSeleccionarTodasLasSucursales();
if (!empty($sucursales)) {
    foreach ($sucursales as $sucursal) {
        echo '<form action="seleccionar_sucursal.php" method="post" class="branch-card">';
        echo '  <button type="submit" class="card h-100" name="sucursalId" value="'. htmlspecialchars($sucursal->getCsucursal()) .'">';
        echo '    <img src="../../images/image'.  htmlspecialchars($sucursal->getCsucursal()). '.jpg" class="card-img-top" alt="Sucursal">';
        echo '    <div class="card-body">';
        echo '      <h5 class="card-title">' . htmlspecialchars($sucursal->getZona()) . '</h5>';
        echo '    </div>';
        echo '  </button>';
        echo '</form>';
    }
} else {
    echo '<p class="text-white">No se encontraron sucursales.</p>'; // Texto blanco para contraste
}
?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
