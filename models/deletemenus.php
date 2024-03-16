<?php
require_once '../config/connection.php';

if (isset($_POST['delete'])) {
    $menuID = $_POST['poslatiID'];

    $code = 0;
    $successArray = [];

    $sql = 'DELETE FROM menus WHERE id=:id';
    $prepare = $connection->prepare($sql);
    $prepare->bindParam(':id', $menuID);

    try {
        $prepare->execute();
        $successArray['msg'] = "You deleted menu item successfully!";
        $successArray['menuDeleted'] = true;
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
