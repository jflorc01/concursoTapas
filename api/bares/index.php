<?php
/**
 * Archivo de la API para gestionar los bares.
 * 
 * Proporciona un endpoint REST para operaciones relacionadas con bares.
 * 
 * PHP version 8.2.12
 * 
 * @category API
 * @package  ConcursoTapas
 * @author   Isaac Alonso y Juan Álvaro
 * @link     http://ejemplo.com
 */

require_once "../clases/Conexion.php";

/**
 * Obtiene bares según los filtros opcionales proporcionados en la solicitud GET.
 *
 * @return void
 */
function obtenerBares()
{
    $con = new Conexion();

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        try {
            /**
             * Consulta SQL para obtener los bares según filtros opcionales.
             *
             * @var string $sql
             */
            $sql = "SELECT * FROM bares WHERE 1 ";

            if (count($_GET) === 1 || count($_GET) === 0) {
                if (isset($_GET['id'])) {
                    $sql .= "AND id_bar = '{$_GET['id']}' ";
                }

                if (isset($_GET['nombre'])) {
                    $sql .= "AND nombre LIKE '%{$_GET['nombre']}%'";
                }
            } else {
                header("HTTP/1.1 400 Bad Request");
                exit;
            }

            /**
             * Resultado de la consulta.
             *
             * @var mysqli_result|bool $result
             */
            $result = $con->query($sql);
            if ($result && $result->num_rows > 0) {
                /**
                 * Array de bares obtenidos.
                 *
                 * @var array $bares
                 */
                $bares = $result->fetch_all(MYSQLI_ASSOC);
                header('HTTP/1.1 200 OK');
                echo json_encode($bares);
            } else {
                header('HTTP/1.1 404 Not Found');
            }
        } catch (mysqli_sql_exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        exit;
    }
}

// Ejecutar la función
obtenerBares();
