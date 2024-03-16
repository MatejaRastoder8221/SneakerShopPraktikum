<?php

if (isset($_POST['insert'])) {
    require_once '../config/connection.php';

    $msg = [];
    $code = 200;

    $brandName = trim($_POST['brandName']);

    $errors = 0;

    $regexBrandName = "/^[A-z]+[\s[A-z0-9]+]?$/";
    if (!preg_match($regexBrandName, $brandName)) {
        array_push($msg, "Brand name must contain letters! <br>");
        $errors++;
    }

    if ($errors == 0) {
        $sql = "INSERT INTO brands VALUES (null, :name)";
        $priprema = $connection->prepare($sql);
        $priprema->bindParam(":name", $brandName);
        try {
            $priprema->execute();
            array_push($msg, "Brand successfully added!");
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
