<?php
// Asegúrate de que el archivo donde está definida la clase se incluya antes de intentar usarla.
 include_once '../../../backend/controllers/controllers.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ci = $_POST['ci'];
    $password = $_POST['password'];

    $result =authController($ci, $password);
    echo"resultado: $result";
if($result){
    header('Location: ../sucursal/view_sucursal.php');

}else{
    echo "contraseña incorrecta";
    header('Location: login.html');
}
    // Aquí puedes decidir qué hacer con el resultado de la autenticación.
    // Por ejemplo, redirigir al usuario a otra página o mostrar un mensaje de error.
}
?>
