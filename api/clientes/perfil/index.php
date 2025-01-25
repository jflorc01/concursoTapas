<?php

    require_once "../../clases/Conexion.php";
    require_once "../../../vendor/autoload.php";
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $con = new Conexion();
    $secret = "miclavesecreta";
    $alg = "HS256";

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $headers = getallheaders();

        if(isset($headers['Authorization'])){
            $jwt = trim(trim($headers['Authorization'], "Bearer"));
            echo "<p>---$jwt---</p>";

            try{
                $payload = JWT::decode($jwt, new Key($secret, $alg));
                                
                echo json_encode($payload);

            }catch(mysqli_sql_exception $e){
                header("HTTP/1.1 401 Unauthorized");
            }
        }
    }
