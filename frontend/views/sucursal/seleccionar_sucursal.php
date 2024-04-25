<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\controllers\controllers.php';

// Asegúrate de incluir las definiciones de las clases que vas a deserializar
include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sucursalId'])) {
    // Establecer la cookie con el ID de la sucursal
    $csucursal = $_POST['sucursalId'];
    echo "codg: $csucursal";
    $sucu = controladorSeleccionarSucursal($csucursal);
    $serializedSucursal = serialize($sucu);
    setcookie('sucursal', $serializedSucursal, time() + 3600, '/'); // Caduca en 1 hora

    // Redirigir a la nueva pestaña
    header('Location: ../pagina_principal/pagina_opciones.php');
    exit();
}

?>
