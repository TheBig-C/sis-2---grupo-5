<?php
session_start();

include_once '../../../backend/controllers/controllers.php';

if (isset($_SESSION['tipo_usuario'])) {
    switch ($_SESSION['tipo_usuario']) {
        case 'administrador':
            header('Location: ../pagina_principal/pagina_opciones.php');
            break;
        case 'cajero':
            header('Location: ../pagina_principal/pagina_cajero.php');
            break;
        case 'operativo':
            header('Location: ../pagina_principal/pagina_operativo.php');
            break;
        default:
            header('Location: ../auth/login.html'); // Redirigir si el tipo no es reconocido
            break;
    }
} else {
    header('Location: ../auth/login.html'); // Redirigir si no hay sesión
}
?>
