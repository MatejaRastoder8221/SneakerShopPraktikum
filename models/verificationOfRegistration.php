<?php
require_once '../config/connection.php';


if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $upit = "SELECT * FROM users WHERE code=:code";

    $priprema = $connection->prepare($upit);
    $priprema->bindParam(":code", $code);

    try {
        $priprema->execute();
        if ($priprema->rowCount() == 1) {
            $user = $priprema->fetch(); //dohvatamo samo jednog

            $name = $user['name'];

            $isActive = 1;

            $upit1 = "UPDATE users SET isActive=:isActive WHERE code=:code";

            $priprema1 = $connection->prepare($upit1);

            $priprema1->bindParam(":isActive", $isActive);
            $priprema1->bindParam(":code", $code);

            try {
                $priprema1->execute();
                $_SESSION['uspesnaVerifikacija'] = "$name, You have successfully activated your account";
                include_once 'helper.php';
                redirect('../index.php?page=login', 303);
            } catch (PDOException $e) {
                echo $e;
            }
        } else {
            redirect('404.php', 404);
        }
    } catch (PDOException $e) {
        echo $e;
    }
}
