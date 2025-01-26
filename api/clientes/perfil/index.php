<?php
/**
 * Archivo de la API para gestionar el perfil de clientes.
 * 
 * Proporciona un endpoint REST para operaciones relacionadas con el perfil de clientes.
 * 
 * PHP version 8.2.12
 * 
 * @category API
 * @package  ConcursoTapas
 * @author   Isaac Alonso y Juan Álvaro
 * @link     http://localhost/clientes/perfil
 */

require_once "../../clases/Conexion.php";
require_once "../../../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Obtiene el perfil del cliente autenticado mediante JWT.
 *
 * @return void
 */
function obtenerPerfilCliente() {
    $con = new Conexion();
    $secret = "miclavesecreta";
    $alg = "HS256";

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $headers = getallheaders();

        if (isset($headers['Authorization'])) {
            $jwt = trim(trim($headers['Authorization'], "Bearer"));
            echo "<p>---$jwt---</p>";

            try {
                $payload = JWT::decode($jwt, new Key($secret, $alg));
                echo json_encode($payload);
            } catch (mysqli_sql_exception $e) {
                header("HTTP/1.1 401 Unauthorized");
                exit;
            }
        }else{
            header("HTTP/1.1 401 Unauthorized");
            exit;
        }
    }
}

// Llamada a la función para obtener el perfil del cliente
obtenerPerfilCliente();
