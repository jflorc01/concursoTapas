<?php

    require_once "../clases/Conexion.php";
    $con = new Conexion();

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        try{
            $sql = "SELECT * FROM tapas WHERE 1 ";
            
            if(count($_GET) === 1 || count($_GET) === 0){
                if(isset($_GET['id'])){
                    $sql .= "AND id_tapa = '{$_GET['id']}' ";
                }
                if(isset($_GET['nombre'])){
                    $sql .= "AND nombre LIKE '%{$_GET['nombre']}%' ";
                }
                if(isset($_GET['bar'])){
                    $sql .= "AND bar = '{$_GET['bar']}' ";
                }
            }elseif(count($_GET) === 2){
                if(isset($_GET['nombre']) && isset($_GET['bar'])){
                    $sql .= "AND bar = '{$_GET['bar']}' AND nombre LIKE '%{$_GET['nombre']}%'";
                }else{
                    header("HTTP/1.1 400 Bad Request");
                    exit;
                }
            }else{
                header("HTTP/1.1 400 Bad Request");
                exit;
            }

            $result = $con->query($sql);
            if($result && $result->num_rows > 0){
                $tapas = $result->fetch_all(MYSQLI_ASSOC);
                header("HTTP/1.1 200 OK");
                echo json_encode($tapas);
            }
        }catch(mysqli_sql_exception $e){
            header("HTTP/1.1 500 Internal Server Error");
            exit;
        }
    }