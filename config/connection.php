<?php
require_once "config.php";


try {

    $connection = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DBNAME . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} 
catch (PDOException $e) {
    echo $e->getMessage();
}


