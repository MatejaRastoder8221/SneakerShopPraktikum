<?php
session_start();
include "config/connection.php";


if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    if ($user['role_id'] == 2) {
        $privilege = 2;
    } else {
        $privilege = 3;
    }
} else {
    $privilege = 1;
}

$query = "SELECT * FROM menus WHERE privileges=1";

if ($privilege == 2) {
    $query .= " OR privileges=2";
} else if ($privilege == 3) {
    $query .= " OR privileges=2 OR privileges=3";
}

$query .= " ORDER BY position";

try {
    $data = $connection->query($query)->fetchAll();
    $rez = $data;
    //var_dump($data);
    echo json_encode($rez);
} catch (PDOException $e) {
    echo $e->getMessage();
}
