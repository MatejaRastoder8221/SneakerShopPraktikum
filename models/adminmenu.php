<?php
//require_once '../config/connection.php';
require_once __DIR__ . '/../config/connection.php';

$query = $connection->query("SELECT * FROM adminmenu")->fetchAll();

try {
    echo '<div class="container-fluid">
    <div class="row mb-5 justify-content-center">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav justify-content-center bg-secondary p-2" id="navAdminMeni">';
    foreach ($query as $rez) {

        echo  '<li class="nav-item">
                    <a class="nav-link text-light text-capitalize" data-name="' . $rez['name'] . '" href="">' . $rez['name'] . '</a>
                </li>';
    }
    echo '</ul>
            </nav></div></div>';
} catch (PDOException $e) {
    echo $e->getMessage();
}
