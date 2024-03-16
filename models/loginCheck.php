<?php
session_start();

if (isset($_POST['btnLogin'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $regexPassword = "/^.{4,50}$/";

    $errors = array();


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not good!");
    }

    if (!preg_match($regexPassword, $password)) {
        array_push($errors, "Enter valid password");
    }

    if (count($errors) == 0) {

        require "../config/connection.php";

        $activated = 1;

        $provera = $connection->query("SELECT * FROM users WHERE email = '$email'");

        if ($provera->rowCount() == 1) {

            $password = md5($password);
            $provera1 = $connection->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");

            if ($provera1->rowCount() == 1) {
                $user = $provera1->fetch();
                $_SESSION['user'] = $user;
                include_once 'helper.php';
                redirect("../index.php", 303);
            } else {
                $_SESSION['errors'] = "Password is incorrect";
                echo "password nije dobar!";
                include_once 'helper.php';
                redirect("../index.php?page=login", 303);
            }
        } else {
            $_SESSION['errors'] = "No such user with entered email or account is not activated!";
            echo "nema maila ili nije aktivan";
            include_once 'helper.php';
            redirect("../index.php?page=login", 303);
        }
    } else {
        $_SESSION['userErrors'] = $errors;
        echo "user errori";
        include_once 'helper.php';
        redirect("../index.php?page=login", 303);
    }
}
