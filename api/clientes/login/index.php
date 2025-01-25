<?php
/**
 * Archivo de la API para gestionar el login de clientes.
 * 
 * Proporciona un endpoint REST para operaciones relacionadas con el login de clientes.
 * 
 * PHP version 8.2.12
 * 
 * @category API
 * @package  ConcursoTapas
 * @author   Isaac Alonso y Juan Álvaro
 * @link     http://localhost/clientes/login
 */

require_once "../../clases/Conexion.php";
require_once "../../../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Autentica un cliente y genera un token JWT.
 *
 * @return void
 */
function loginCliente() {
    $con = new Conexion();
    $secret = "miclavesecreta";
    $alg = "HS256";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['user']) || !isset($_POST['pass'])) {
            header("HTTP/1.1 400 Bad Request");
            exit;
        }

        try {
            $sql = "SELECT * FROM clientes WHERE nombre_usuario = '{$_POST['user']}'";
            $result = $con->query($sql);

            if ($result && $result->num_rows > 0) {
                $datos = $result->fetch_assoc();
                $passHash = $datos['contrasena'];
                if ($passHash === hash('sha512', $_POST['pass'])) {
                    $payload = [
                        "id" => $datos['id_cliente'],
                        "user" => $datos['nombre_usuario'],
                        "rol" => $datos['tipo'],
                        "email" => $datos['email'],
                    ];

                    $jwt = JWT::encode($payload, $secret, $alg);
                    echo json_encode(["token" => $jwt]);

                    header("HTTP/1.1 200 OK");
                } else {
                    header("HTTP/1.1 401 Unauthorized");
                }
            } else {
                header("HTTP/1.1 401 Unauthorized");
            }
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
}

// Llamada a la función para autenticar el cliente
loginCliente();
