<?php
ob_start();
session_start();


require_once "views/fixed/head.php";

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

require_once "views/fixed/header.php";

$page = "";
$product = "";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

if(isset($_GET['product'])){
    $product = $_GET['product'];
}

switch ($page) {

    case "home":
        include 'views/pages/home.php';
        break;
    case "shop":
        include 'views/pages/shop.php';
        break;
    case "about":
        include 'views/pages/about.php';
        break;
    case "editproduct":
        include 'views/pages/editproduct.php';
        break;
    case "contact":
        include 'views/pages/contact.php';
        break;
    case "admin":
        include 'views/pages/admin.php';
        break;
    case "login":
        include 'views/pages/login.php';
        break;
    case "register":
        include 'views/pages/register.php';
        break;
    case "logout":
        include 'models/logout.php';
        break;
    case "admin Panel":
        include 'views/pages/adminpanel.php';
        break;
    case "Documentation":
        header("location: documentation.pdf");
        break;
    case "product":
        include 'views/pages/product.php';
        break;
    case "cart":
        include 'views/pages/cart.php';
        break;
    default:
        include 'views/pages/home.php';
}





require_once "views/fixed/footer.php";

require_once "views/fixed/scripts.php";
