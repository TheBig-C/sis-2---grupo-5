<?php
session_start();  // Asegúrate de iniciar la sesión
require_once '../../../backend/controllers/controller_funcionario.php';

$cf = $_POST['cf'] ?? null;
$tipo = $_POST['tipo'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$password = $_POST['password'] ?? null;

// Recuperar la sucursal desde la cookie y deserializarla
if(isset($_COOKIE['sucursal'])) {
    $sucursalObj = unserialize($_COOKIE['sucursal']);
    $sucursal_csucursal = $sucursalObj->getCsucursal();  // Usar el método getter para acceder de forma segura
} else {
    $result = "error";
    $message = urlencode("No se ha seleccionado ninguna sucursal.");
    header("Location: view_fun.php?result=$result&message=$message");
    exit;
}

if (!$cf || !$tipo || !$nombre || !$password) {
    $result = "error";
    $message = urlencode("Todos los campos son obligatorios.");
} else {
    try {
        controladorInsertarFuncionario($cf, $tipo, $nombre, $password, $sucursal_csucursal);
        $result = "success";
        $message = urlencode("Funcionario agregado correctamente.");
    } catch (Exception $e) {
        $result = "error";
        $message = urlencode($e->getMessage());
    }
}

header("Location: view_fun.php?result=$result&message=$message");
exit;
