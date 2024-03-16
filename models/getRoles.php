<?php

require_once '../config/connection.php';



try {
    $sqlRoles = $connection->query('SELECT id,name FROM roles')->fetchAll((PDO::FETCH_ASSOC));
    $data = $sqlRoles;
    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
}
