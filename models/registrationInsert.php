<?php
session_start();

if (isset($_POST['btnRegister'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $testPassword = $_POST['testpassword'];

    $regexName = "/^[A-Z][a-z]{2,19}$/";
    $regexLastName = "/^[A-Z][a-z]{2,39}$/";
    $regexPassword = "/^[A-z0-9_-]{6,12}$/";

    $errors = array();

    if (!preg_match($regexName, $name)) {
        array_push($errors, "Name must have start with uppercase letter and has at least 2 characters!");
    }

    if (!preg_match($regexLastName, $lastname)) {
        array_push($errors, "Lastname must have start with uppercase letter and has at least 2 characters!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not good!");
    }

    if (!preg_match($regexPassword, $password)) {
        array_push($errors, "Enter valid password!");
    }

    if (!preg_match($regexPassword, $testPassword)) {
        array_push($errors, "Re-type password correctly!");
    }

    if ($testPassword != $password) {
        array_push($errors, "Re-type password correctly!");
    }

    require "../config/connection.php";

    $upitProveraEmailaUsera = "SELECT email FROM users where email = :email";

    $pripremaProvere = $connection->prepare($upitProveraEmailaUsera);
    $pripremaProvere->bindParam(":email", $email);


    $pripremaProvere->execute();
    if ($pripremaProvere->rowCount() == 1) {
        array_push($errors, "There is already a user with entered email!");
    }

    if (count($errors) == 0) {
        $upit = "INSERT INTO users VALUES(NULL, :name, :lastname, :email, :password, :role_id, :code, :dateofcreation, :isActive)";

        $priprema = $connection->prepare($upit);

        //bindParam

        $priprema->bindParam(":name", $name);
        $priprema->bindParam(":lastname", $lastname);
        $priprema->bindParam(":email", $email);

        $password = md5($password);

        $priprema->bindParam(":password", $password);

        define("KORISNIK_ULOGA", 2);
        $roleID = KORISNIK_ULOGA;
        $priprema->bindParam(":role_id", $roleID);

        $code = sha1(md5(md5(time() . md5($email) . rand(1, 10000000))));
        $priprema->bindParam(":code", $code);

        $dateOfCreation = date("Y-m-d H:i:s");
        $priprema->bindParam(":dateofcreation", $dateOfCreation);

        $isActive = 0;
        $priprema->bindParam(":isActive", $isActive);

        try {
            $isUneto = $priprema->execute();

            $_SESSION["uspesnaRegistracija"] = "Uspela registracija";

            

            include_once 'helper.php';
            redirect("../index.php?page=login", 303);
        } catch (PDOException $e) {
            $_SESSION["errorsDB"] = ["Greska sa bazom!"];


            include_once 'helper.php';
            redirect("../index.php?page=register", 303);
        }
    } else {
        $_SESSION["userErrors"] = $errors;

        include_once 'helper.php';
        redirect("../index.php?page=register", 303);
    }
}
