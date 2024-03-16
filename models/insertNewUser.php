<?php

if (isset($_POST['insert'])) {
    require_once '../config/connection.php';

    $msg = [];
    $code = 200;

    $name = trim($_POST['firstName']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $testPassword = $_POST['testPassword'];
    $roleID = $_POST['selectRole'];

    $errors = 0;

    $regexName = "/^[A-Z][a-z]{2,19}$/";
    $regexLastName = "/^[A-Z][a-z]{2,39}$/";
    $regexPassword = "/^[A-z0-9_-]{6,12}$/";

    if (!preg_match($regexName, $name)) {
        array_push($msg, "Name must have start with uppercase letter and have at least 2 characters!");
        $errors++;
    }

    if (!preg_match($regexLastName, $lastname)) {
        array_push($msg, "Lastname must have start with uppercase letter and have at least 2 characters!");
        $errors++;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($msg, "Email is not valid!");
        $errors++;
    }

    if (!preg_match($regexPassword, $password)) {
        array_push($msg, "Enter valid password!");
        $errors++;
    }

    if (!preg_match($regexPassword, $testPassword)) {
        array_push($msg, "Re-type password correctly!");
        $errors++;
    }

    if ($testPassword != $password) {
        array_push($msg, "Re-type password correctly!");
        $errors++;
    }
    if ($roleID == 0) {
        array_push($msg, "You have to choose a role <br>");
        $errors++;
    }


    if ($errors == 0) {
        $sql = "INSERT INTO users VALUES (null, :name, :lastname, :email, :password, :role_id, :code, :dateofcreation, :isActive)";
        $priprema = $connection->prepare($sql);

        $priprema->bindParam(":name", $name);
        $priprema->bindParam(":lastname", $lastname);
        $priprema->bindParam(":email", $email);

        $password = md5($password);

        $priprema->bindParam(":password", $password);

        $priprema->bindParam(":role_id", $roleID);

        $code = sha1(md5(md5(time() . md5($email) . rand(1, 10000000))));
        $priprema->bindParam(":code", $code);

        $dateOfCreation = date("Y-m-d H:i:s");
        $priprema->bindParam(":dateofcreation", $dateOfCreation);

        $isActive = 1;
        $priprema->bindParam(":isActive", $isActive);
        try {
            $priprema->execute();
            //Pri dodavanju usera u lokalu slanje maila nije moguce.
            //mail($email, "Registration Time Zone", "Click the link to verify your registration: http://localhost:8080/php1/sajt/models/verificationOfRegistration.php?code=" . $code);
            array_push($msg, "User successfully added!");
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
