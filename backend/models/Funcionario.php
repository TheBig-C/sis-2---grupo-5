<?php
include_once 'C:\xampp\htdocs\sis2-ketal\backend\core\conexion.php';
class Funcionario {
    private $cf;
    private $tipo;
    private $nombre;
    private $password;
    private $sucursal_csucursal;

    public function __construct($cf, $tipo, $nombre, $password, $sucursal_csucursal) {
        $this->cf = $cf;
        $this->tipo = $tipo;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->sucursal_csucursal = $sucursal_csucursal;
    }

    public function getCf() {
        return $this->cf;
    }

    public function setCf($cf) {
        $this->cf = $cf;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getSucursalCsucursal() {
        return $this->sucursal_csucursal;
    }

    public function setSucursalCsucursal($sucursal_csucursal) {
        $this->sucursal_csucursal = $sucursal_csucursal;
    }
    public static function authFuncionario($cf, $inputPassword) {
        try {
            $conn = conexion();
    
            $query = "SELECT password FROM funcionario WHERE cf= $cf";
    
            $result = pg_query($conn, $query);
            if ($result) {
                
                // Obtener el resultado como un array asociativo
                $row = pg_fetch_assoc($result);
                if ($row) {
                   
                    // Verificar la contraseña con hash
                    if ($inputPassword== $row['password']) {
                        // La contraseña coincide
                        $funcionario = Funcionario::seleccionarFuncionario($cf);
                        $serializedFuncionario = serialize($funcionario);
                        setcookie('funcionario', $serializedFuncionario, time() + 3600, '/'); // Caduca en 1 hora
                        
                        return true;
                    } else {
                        // La contraseña no coincide
                        return false;
                    }
                } else {
                    // No se encontró al funcionario
                    return false;
                }
            } else {
                // Si no hay resultado, maneja el caso de consulta fallida
                echo "Error en la consulta: " . pg_last_error($conn);
                return false;
            }
        } catch (PDOException $e) {
            // Manejar el error adecuadamente
            echo "Error de conexión: " . $e->getMessage();
            return false;
        }
    }
    
    public static function  insertarFuncionario($cf, $tipo, $nombre, $password, $sucursal_csucursal) {
        $conn = conexion();
    
        // Escapar los valores para seguridad
        $cf = pg_escape_string($conn, $cf);
        $tipo = pg_escape_string($conn, $tipo);
        $nombre = pg_escape_string($conn, $nombre);
        $password = pg_escape_string($conn, $password);
        $sucursal_csucursal = pg_escape_string($conn, $sucursal_csucursal);
    
        $query = "INSERT INTO Funcionario (cf, tipo, nombre, password, sucursal_csucursal) VALUES ('$cf', '$tipo', '$nombre', '$password', '$sucursal_csucursal')";
    
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al insertar el funcionario.\n";
            exit;
        }
    }
    public static function seleccionarTodosLosFuncionarios() {
        $conn = conexion();
        $query = "SELECT * FROM Funcionario";
    
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar los funcionarios.\n";
            exit;
        }
    
        $funcionarios = []; // Array para almacenar los objetos Funcionario
        while ($funcionarioData = pg_fetch_assoc($result)) {
            $funcionarios[] = new Funcionario(
                $funcionarioData['cf'],
                $funcionarioData['tipo'],
                $funcionarioData['nombre'],
                $funcionarioData['password'],
                $funcionarioData['sucursal_csucursal']
            );
        }
    
        return $funcionarios; // Devuelve el array de objetos Funcionario
    }
    
    public static function seleccionarFuncionario($cf) {
        $conn = conexion();
    
        $cf = pg_escape_string($conn, $cf);
    
        $query = "SELECT * FROM Funcionario WHERE cf = '$cf'";
    
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al seleccionar el funcionario.\n";
            exit;
        }
    
        $funcionarioData = pg_fetch_assoc($result);
        if (!$funcionarioData) {
            echo "No se encontró ningún funcionario con el CF proporcionado.";
            return null; // O manejar de otra manera, dependiendo de tus requisitos.
        }
    
        $funcionario = new Funcionario(
            $funcionarioData['cf'],
            $funcionarioData['tipo'],
            $funcionarioData['nombre'],
            $funcionarioData['password'],
            $funcionarioData['sucursal_csucursal']
        );
    
        return $funcionario;
    }
    
    public static function actualizarFuncionario($cf, $tipo, $nombre, $password, $sucursal_csucursal) {
        $conn = conexion();
    
        $cf = pg_escape_string($conn, $cf);
        $tipo = pg_escape_string($conn, $tipo);
        $nombre = pg_escape_string($conn, $nombre);
        $password = pg_escape_string($conn, $password);
        $sucursal_csucursal = pg_escape_string($conn, $sucursal_csucursal);
    
        $query = "UPDATE Funcionario SET tipo = '$tipo', nombre = '$nombre', password = '$password', sucursal_csucursal = '$sucursal_csucursal' WHERE cf = '$cf'";
    
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al actualizar el funcionario.\n";
            exit;
        }
       
    }
    public static function  eliminarFuncionario($cf) {
        $conn = conexion();
    
        $cf = pg_escape_string($conn, $cf);
    
        $query = "DELETE FROM Funcionarios WHERE cf = '$cf'";
    
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Ocurrió un error al eliminar el funcionario.\n";
            exit;
        }
    }
            
    
}

?>
