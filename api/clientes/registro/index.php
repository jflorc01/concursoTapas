<?php
/**
 * Archivo de la API para gestionar el registro de clientes.
 * 
 * Proporciona un endpoint REST para operaciones relacionadas con el registro de clientes.
 * 
 * PHP version 8.2.12
 * 
 * @category API
 * @package  ConcursoTapas
 * @author   Isaac Alonso y Juan Álvaro
 * @link     http://localhost/clientes/registro
 */

require_once "../../clases/Conexion.php";

/**
 * Registra un nuevo cliente en la base de datos según los parámetros proporcionados en la solicitud POST.
 *
 * @return void
 */
function registrarCliente() {
    $con = new Conexion();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['usuario']) && isset($_POST['pass']) && isset($_POST['email'])) {
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            $passHash = hash("sha512", $pass);

            $sql = "INSERT INTO clientes (nombre_usuario, contrasena, tipo, email) VALUES ('$usuario', '$passHash', 'user', '$email')";

            try {
                $con->query($sql);
                if ($con->affected_rows > 0) {
                    header("HTTP/1.1 201 Created");
                    echo json_encode($con->insert_id);
                } else {
                    header("HTTP/1.1 500 Internal Server Error");
                }
            } catch (mysqli_sql_exception $e) {
                header("HTTP/1.1 400 Bad Request");
            }
        } else {
            header("HTTP/1.1 400 Bad Request");
        }
        exit;
    }
}

// Llamada a la función para registrar el cliente
registrarCliente();