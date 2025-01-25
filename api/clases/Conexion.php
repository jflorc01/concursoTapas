<?php
/**
 * Clase para gestionar la conexión a la base de datos.
 * 
 * Extiende la clase mysqli para proporcionar una conexión a la base de datos.
 * 
 * PHP version 8.2.12
 * 
 * @category Database
 * @package  ConcursoTapas
 * @author   Isaac Alonso
 */

class Conexion extends mysqli {
    private $host = "localhost";
    private $db = "tapleon";
    private $user = "tapleon";
    private $pass = "tapleon";

    /**
     * Constructor de la clase Conexion.
     * 
     * Inicializa la conexión a la base de datos utilizando los parámetros definidos.
     * 
     * @throws mysqli_sql_exception Si hay un error al conectar a la base de datos.
     */
    public function __construct() {
        try {
            parent::__construct($this->host, $this->user, $this->pass, $this->db);
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
            exit;
        }
    }
}