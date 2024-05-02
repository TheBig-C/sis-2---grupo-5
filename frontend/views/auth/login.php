<?php
session_start();
include_once '../../../backend/controllers/controllers.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ci = $_POST['ci'];
    $password = $_POST['password'];

    $result = authController($ci, $password);
    echo "resultado: $result";
    if ($result) {
        $aux = controladorSeleccionarFuncionario($ci);
        $_SESSION['tipo_usuario'] = $aux->getTipo(); // Almacenar tipo de usuario en la sesión

        if ($aux->getTipo() == 'administrador') {
            header('Location: ../sucursal/view_sucursal.php');
        } elseif ($aux->getTipo() == 'cajero') {
            $sucu = controladorSeleccionarSucursal($aux->getSucursalCsucursal());
            $serializedSucursal = serialize($sucu);
            setcookie('sucursal', $serializedSucursal, time() + 3600, '/');
            header('Location: ../pagina_principal/pagina_cajero.php');
        } else {
            $sucu = controladorSeleccionarSucursal($aux->getSucursalCsucursal());
            $serializedSucursal = serialize($sucu);
            setcookie('sucursal', $serializedSucursal, time() + 3600, '/');
            header('Location: ../pagina_principal/pagina_operativo.php');
        }
    } else {
        echo "contraseña incorrecta";
        header('Location: login.html');
    }
}
?>
