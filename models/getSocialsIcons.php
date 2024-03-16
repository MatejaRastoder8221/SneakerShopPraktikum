<?php
require_once "../config/connection.php";

try {
    $query = $connection->query("SELECT * FROM socials")->fetchAll();
    echo json_encode($query);
} catch (PDOException $e) {
    echo $e->getMessage();
}
