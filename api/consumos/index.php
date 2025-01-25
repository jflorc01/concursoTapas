<?php

    require_once "../clases/Conexion.php";
    require_once "../../vendor/autoload.php";
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $con = new Conexion();
    $secret = "miclavesecreta";
    $alg = "HS256";

    // Registrar consumo
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $headers = getallheaders();

        if(isset($headers['Authorization'])){
            $jwt = trim(trim($headers['Authorization'], "Bearer"));
            echo "<p>---$jwt---</p>";

            try{


            }catch(mysqli_sql_exception $e){
                header("HTTP/1.1 401 Unauthorized");
            }
        }
    }

    // Obtener consumiciones de usuario
    if($_SERVER['REQUEST_METHOD'] === "GET"){
        
    }