<?php
    $user = "miguel";
    $server = "localhost";
    $password = "suasenha";
    $port = "5432";
    $data = "gerenciadortarefa";
    $info_string = "pgsql:host=$server;port=$port;dbname=$data";

    /*$connection = pg_connect($info_string) or die("não foi possível se conectar ao servidor postgresql");
    var_dump($connection);

    pg_close($connection) or die("Não foi possível se desconectar do servidor postgresql");
    */
    try{
        $pdo = new PDO($info_string, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        var_dump($pdo);
        ECHO "Conectado no banco de dados";
    } catch(PDOException $e){
        echo "Falha ao conectar no banco de dados";
        die($e->getMessage());
    }
?>