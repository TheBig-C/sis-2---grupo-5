<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

 $serializedSucursal = $_COOKIE['sucursal'];
 $suc = unserialize($serializedSucursal);
 $aux= $suc->getCsucursal();
echo "opciones aqui sucursal: $aux";
?>