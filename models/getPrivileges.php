<?php

require_once '../config/connection.php';



try {
    $sqlPrivileges = $connection->query('SELECT id,name FROM privileges')->fetchAll((PDO::FETCH_ASSOC));
    $data = $sqlPrivileges;
    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
}
