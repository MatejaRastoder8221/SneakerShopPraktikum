<?php
require_once '../config/connection.php';

if (isset($_POST['delete'])) {
    $brandID = $_POST['poslatiID'];

    $code = 0;
    $successArray = [];

    $sql = 'DELETE FROM brands WHERE id=:id';
    $prepare = $connection->prepare($sql);
    $prepare->bindParam(':id', $brandID);

    try {
        $prepare->execute();
        $successArray['msg'] = "You deleted brand successfully!";
        $successArray['brandDeleted'] = true;
        $code = 200;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    $successArray["error"] = "Error! Try Again!";
    $code = 404;
}


echo json_encode($successArray);
http_response_code($code);
