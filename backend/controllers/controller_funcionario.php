<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\models\classes.php';
function authController($ci, $inputPassword) {
        try {

         return Funcionario::authFuncionario($ci, $inputPassword);
      
           
        } catch (Exception $e) {
            echo "Error al insertar funcionario: " . $e->getMessage();
        }
    }
    function controladorSeleccionarTodosLosFuncionarios() {
        try {
            return Funcionario::seleccionarTodosLosFuncionarios();
            
        } catch (Exception $e) {
            echo "Error al seleccionar todos los funcionarios: " . $e->getMessage();
        }
    }
    
    
    function controladorInsertarFuncionario($cf, $tipo, $nombre, $password, $sucursal_csucursal) {
        try {
            Funcionario::insertarFuncionario($cf, $tipo, $nombre, $password, $sucursal_csucursal);
            echo "Funcionario insertado correctamente.";
        } catch (Exception $e) {
            echo "Error al insertar funcionario: " . $e->getMessage();
        }
    }
    function controladorSeleccionarFuncionario($cf) {
        try {
           return Funcionario::seleccionarFuncionario($cf);
            
        } catch (Exception $e) {
            echo "Error al seleccionar el funcionario: " . $e->getMessage();
        }
    }
    function controladorActualizarFuncionario($cf, $tipo, $nombre, $password, $sucursal_csucursal) {
        try {
            Funcionario::actualizarFuncionario($cf, $tipo, $nombre, $password, $sucursal_csucursal);
            echo "Funcionario actualizado correctamente.";
        } catch (Exception $e) {
            echo "Error al actualizar funcionario: " . $e->getMessage();
        }
    }
    function controladorEliminarFuncionario($cf) {
        try {
            Funcionario::eliminarFuncionario($cf);
            echo "Funcionario eliminado correctamente.";
        } catch (Exception $e) {
            echo "Error al eliminar el funcionario: " . $e->getMessage();
        }
    }
                
?>