<?php

    require_once("../clases/Conexion.php");
    $con = new Conexion();

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        try{
            $sql = "SELECT * FROM bares WHERE 1 ";
            if(isset($_GET['id'])){
                $sql .= "AND id_bar = '{$_GET['id']}'";
            }
            if(count($_GET) > 1 || (count($_GET) === 1 && !isset($_GET['id']))){
                header('HTTP/1.1 404 Not Found');
                exit;
            }

            $result = $con->query($sql);
            if($result && $result->num_rows > 0){
                $bares = $result->fetch_all(MYSQLI_ASSOC);
                header('HTTP/1.1 200 OK');
                echo json_encode($bares);
            }else{
                header('HTTP/1.1 404 Not Found');
            }
        }catch(mysqli_sql_exception $e){
            header('HTTP/1.1 500 Internal Server Error');
        }
        exit;
    }