<?php
// Asegúrate de que el archivo donde está definida la clase se incluya antes de intentar usarla.
 include_once '../../../backend/controllers/controllers.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ci = $_POST['ci'];
    $password = $_POST['password'];

    $result =authController($ci, $password);
    echo"resultado: $result";
if($result){
    $aux=controladorSeleccionarFuncionario($ci);
    if($aux->getTipo()=='administrador'){
        header('Location: ../sucursal/view_sucursal.php');
    }else if ($aux->getTipo() == 'cajero') {
        $sucu = controladorSeleccionarSucursal($aux->getSucursalCsucursal());
    $serializedSucursal = serialize($sucu);
    setcookie('sucursal', $serializedSucursal, time() + 3600, '/'); // Caduca en 1 hora
        header('Location: ../pagina_principal/pagina_cajero.php');
    }else {
        $sucu = controladorSeleccionarSucursal($aux->getSucursalCsucursal());
    $serializedSucursal = serialize($sucu);
    setcookie('sucursal', $serializedSucursal, time() + 3600, '/'); // Caduca en 1 hora
        header('Location: ../pagina_principal/pagina_operativo.php');
    }

}else{
    echo "contraseña incorrecta";
    header('Location: login.html');
}
    // Aquí puedes decidir qué hacer con el resultado de la autenticación.
    // Por ejemplo, redirigir al usuario a otra página o mostrar un mensaje de error.
}
?>
