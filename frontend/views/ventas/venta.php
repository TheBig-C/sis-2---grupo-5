<?php
header('Content-Type: text/plain');  // Cambio para devolver texto plano

// Incluir controladores
include_once 'C:\xampp\htdocs\sis2-ketal\backend\controllers\controllers.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clienteCI = $_POST['clienteCI'];
    $clienteNombres = $_POST['clienteNombres'];
    $clienteApellidos = $_POST['clienteApellidos'];

    $metodoPago = $_POST['metodoPago'];
    $detallesVenta = json_decode($_POST['detallesVenta'], true);
    $totalVenta = floatval($_POST['totalVenta']);

    $apiKey = "f04852fd3ecf29960821c0e8edd9d101cf645e389a5baa4703e6a20a15a62e71";

// Construye la URL para la solicitud de la API
$url = "https://gender-api.com/get?name=" . urlencode($clienteNombres) . "&key=" . urlencode($apiKey);

// Inicializa cURL
$ch = curl_init();

// Configura las opciones de cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecuta la solicitud
$response = curl_exec($ch);

// Cierra el recurso cURL
curl_close($ch);

// Decodifica la respuesta JSON
$data = json_decode($response, true);

   

    $clienteID = controladorInsertarCliente($clienteCI, $clienteNombres, $clienteApellidos, $data['gender'] ?? '');
    if(!$clienteID){
        $clienteID=controladorSeleccionarCliente($clienteCI);
    }
    $serializedSucursal = $_COOKIE['funcionario'];
    $suc = unserialize($serializedSucursal);
    $aux = $suc->getCf();
    $cv = controladorUltimaVenta();
    $cpv = controllerUlitmoProductovendido();
    $fechaActual = date("Y-m-d");
    $horaActual = date("H:i:s");

    controladorInsertarVenta($cv, $fechaActual, $horaActual, true, $totalVenta, $totalVenta, $metodoPago, $clienteCI, $aux);

    foreach ($detallesVenta as $detalle) {
        $productoID = $detalle['cp'];
        $cantidad = $detalle['cantidad'];

        $nombreProducto = $detalle['nombre'];
        $precioProducto = floatval($detalle['precio']);
        controladorInsertarProductoVendido($cpv,$cantidad, $cv, $productoID);
        $cpv++;
    }

    echo "Venta realizada con éxito";  // Respuesta final como texto plano
}
?>
