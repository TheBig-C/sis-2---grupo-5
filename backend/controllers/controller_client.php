<?php

include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

function controladorInsertarCliente($ci, $nombre, $apellidos, $sexo) {
  
       return  Cliente::insertarCliente($ci, $nombre, $apellidos, $sexo);
        echo "Cliente insertado correctamente.";
   
}

function controladorSeleccionarTodosLosClientes() {
    try {
        return Cliente::seleccionarTodosLosClientes();
    } catch (Exception $e) {
        echo "Error al seleccionar todos los clientes: " . $e->getMessage();
    }
}

function controladorActualizarCliente($ci, $nombre, $apellidos, $sexo) {
    try {
        Cliente::actualizarCliente($ci, $nombre, $apellidos, $sexo);
        echo "Cliente actualizado correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar cliente: " . $e->getMessage();
    }
}

function controladorEliminarCliente($ci) {
    try {
        Cliente::eliminarCliente($ci);
        echo "Cliente eliminado correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar cliente: " . $e->getMessage();
    }
}

function controladorSeleccionarCliente($ci) {
    try {
        return Cliente::seleccionarCliente($ci);
    } catch (Exception $e) {
        echo "Error al seleccionar el cliente: " . $e->getMessage();
    }
}

?>

?>
<?php

include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';

function controladorInsertarCliente($ci, $nombre, $apellidos, $sexo) {
  
       return  Cliente::insertarCliente($ci, $nombre, $apellidos, $sexo);
        echo "Cliente insertado correctamente.";
   
}

function controladorSeleccionarTodosLosClientes() {
    try {
        return Cliente::seleccionarTodosLosClientes();
    } catch (Exception $e) {
        echo "Error al seleccionar todos los clientes: " . $e->getMessage();
    }
}

function controladorActualizarCliente($ci, $nombre, $apellidos, $sexo) {
    try {
        Cliente::actualizarCliente($ci, $nombre, $apellidos, $sexo);
        echo "Cliente actualizado correctamente.";
    } catch (Exception $e) {
        echo "Error al actualizar cliente: " . $e->getMessage();
    }
}

function controladorEliminarCliente($ci) {
    try {
        Cliente::eliminarCliente($ci);
        echo "Cliente eliminado correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar cliente: " . $e->getMessage();
    }
}

function controladorSeleccionarCliente($ci) {
    try {
        return Cliente::seleccionarCliente($ci);
    } catch (Exception $e) {
        echo "Error al seleccionar el cliente: " . $e->getMessage();
    }
}

?>

?>