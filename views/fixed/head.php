<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Footwear shop | eCommerce</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- css fajlovi template-a -->
    <link rel="stylesheet" href="./assets/css/mojCSS/moj.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    <link rel="stylesheet" href="./assets/css/flaticon.css">
    <link rel="stylesheet" href="./assets/css/slicknav.css">
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <link rel="stylesheet" href="./assets/css/magnific-popup.css">
    <link rel="stylesheet" href="./assets/css/fontawesome-all.min.css"> 
    <link rel="stylesheet" href="./assets/css/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/slick.css">
    <link rel="stylesheet" href="./assets/css/nice-select.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<?php
    define("BASE_URL", $_SERVER['DOCUMENT_ROOT'].'/');
    define("LOG_FILE", BASE_URL."data/log.txt");
    $page="";
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    logPage($page);

    function logPage($page){
        $visitedPage = $_SERVER['PHP_SELF'];
        $dateTime = date("d. m. Y. h:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];

        if($page != ""){
            $content = $page."__".$visitedPage."__".$dateTime."__".time()."__".$ip."\n";
        }
        else{
            $content = "home__".$visitedPage."__".$dateTime."__".time()."__".$ip."\n";
        }

        $logFile = file_put_contents(LOG_FILE, $content, FILE_APPEND);
}

?>