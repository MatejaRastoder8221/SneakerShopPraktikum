<?php

require_once '../config/connection.php';
try {
    $query = $connection->query("SELECT p.id, p.name, p.price, p.img, pr.id_product, COUNT(pr.id_product) AS MostSold FROM products_orders pr INNER JOIN products p ON pr.id_product=p.id INNER JOIN orders o ON pr.id_order=o.id GROUP BY pr.id_product ORDER BY MostSold DESC LIMIT 3")->fetchAll();
    echo json_encode($query);
} catch (PDOException $e) {
    echo $e->getMessage();
}
