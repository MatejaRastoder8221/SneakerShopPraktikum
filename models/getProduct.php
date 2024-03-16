<?php
require_once '../config/connection.php';
require_once __DIR__ . '/../config/connection.php';



try {
    $sql = 'SELECT p.id, p.name, p.price, p.old_price, p.img, p.description, g.name as gender, b.name as brand, p.dateofadd FROM products p INNER JOIN gender g ON p.gender_id=g.id INNER JOIN brands b ON p.brand_id=b.id WHERE id =:id';
    $prepare = $connection->prepare($sql);
    $prepare->bindParam(':id', $product);

    try {
        $prepare->execute();
        $successArray['msg'] = "You deleted product successfully!";
        $successArray['productDeleted'] = true;
        $code = 200;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // $rez = $connection->query($sql)->fetchAll((PDO::FETCH_ASSOC));
    // if (count($rez) == 0) {
    //     die();
    // } else {
    //     echo json_encode($rez);
    //     http_response_code(200);
    // }
    }

