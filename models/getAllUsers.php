<?php
require_once '../config/connection.php';



try {
    $sql = 'SELECT id, name, lastname, email, (SELECT name FROM roles WHERE id=role_id) as role, password, code, 
    CASE isActive
        WHEN "1" THEN "Yes"
        WHEN "0" THEN "No" 
    END as "Is Active", 
    dateofcreation FROM users';
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

// u.id, u.name, u.lastname, u.email, u.password, r.name, u.code, u.dateofcreation, u.isActive 