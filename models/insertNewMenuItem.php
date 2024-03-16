<?php

if (isset($_POST['insert'])) {
    require_once '../config/connection.php';

    $msg = [];
    $code = 200;

    $menuItemName = trim($_POST['menuItemName']);
    $menuItemPosition = trim($_POST['menuItemPosition']);
    $privilege = $_POST['selectPrivilege'];

    $errors = 0;

    $regexItemName = "/^[A-z]+[\s[A-z0-9]+]?$/";
    if (!preg_match($regexItemName, $menuItemName)) {
        array_push($msg, "Menu item name must contain letters! <br>");
        $errors++;
    }
    if ($menuItemPosition == 0) {
        array_push($msg, "Position must be greater than 0. <br>");
        $errors++;
    }
    if ($privilege == 0) {
        array_push($msg, "You have to choose privilege. <br>");
        $errors++;
    }

    if ($errors == 0) {
        $sql = "INSERT INTO menus VALUES (null, :name, :position, :privileges)";
        $priprema = $connection->prepare($sql);
        $priprema->bindParam(":name", $menuItemName);
        $priprema->bindParam(":position", $menuItemPosition);
        $priprema->bindParam(":privileges", $privilege);
        try {
            $priprema->execute();
            array_push($msg, "Menu item successfully added!");
            echo json_encode($msg);
            http_response_code(201);
        } catch (PDOException $e) {
            //echo $e->getMessage();
            array_push($msg, "Server error!");
            echo json_encode($msg);
            http_response_code(500);
        }
    } else {
        echo json_encode($msg);
        http_response_code(422);
    }
}
