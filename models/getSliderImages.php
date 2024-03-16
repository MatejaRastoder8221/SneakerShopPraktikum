<?php
require_once "../config/connection.php";

try {
    $query = $connection->query("SELECT * FROM slider_images")->fetchAll();
    echo json_encode($query);
} catch (PDOException $e) {
    echo $e->getMessage();
}
