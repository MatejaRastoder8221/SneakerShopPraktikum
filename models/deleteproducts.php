<?php
require_once '../config/connection.php';

if (isset($_POST['delete'])) {
    $productID = $_POST['poslatiID'];

    $msg = "";
    $code = 0;
    $successArray = [];

    $sql = 'DELETE FROM products WHERE id =:id';
    $prepare = $connection->prepare($sql);
    $prepare->bindParam(':id', $productID);

    try {
        $prepare->execute();
        $successArray['msg'] = "You deleted product successfully!";
        $successArray['productDeleted'] = true;
        $code = 200;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    $successArray["error"] = "Error! Try Again!";
    $code = 404;
}


echo json_encode($msg);
http_response_code($code);
