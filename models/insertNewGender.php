<?php

if (isset($_POST['insert'])) {
    require_once '../config/connection.php';

    $msg = [];
    $code = 200;

    $genderName = trim($_POST['genderName']);

    $errors = 0;

    $regexGenderName = "/^[A-z]+[\s[A-z0-9]+]?$/";
    if (!preg_match($regexGenderName, $genderName)) {
        array_push($msg, "Gender name must contain letters! <br>");
        $errors++;
    }

    if ($errors == 0) {
        $sql = "INSERT INTO gender VALUES (null, :name)";
        $priprema = $connection->prepare($sql);
        $priprema->bindParam(":name", $genderName);
        try {
            $priprema->execute();
            array_push($msg, "Gender successfully added!");
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
