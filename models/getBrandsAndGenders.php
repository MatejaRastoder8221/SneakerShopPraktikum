<?php

require_once '../config/connection.php';



try {
    $sqlGenders = $connection->query('SELECT id,name FROM gender')->fetchAll((PDO::FETCH_ASSOC));
    $sqlBrands = $connection->query('SELECT id,name FROM brands')->fetchAll((PDO::FETCH_ASSOC));

    $data = array();
    $data['genders'] = $sqlGenders;
    $data['brands'] = $sqlBrands;

    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
}
