<?php
require_once '../config/connection.php';



try {
    $sql = 'SELECT id, name, position,(SELECT name FROM privileges WHERE id=privileges) as privilege FROM menus';
    $rez = $connection->query($sql)->fetchAll((PDO::FETCH_ASSOC));
    if (count($rez) == 0) {
        die();
    } else {
        echo json_encode($rez);
        http_response_code(200);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
