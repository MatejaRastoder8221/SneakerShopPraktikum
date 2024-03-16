<?php
ob_start();
if (isset($_POST['insert'])) {
    require_once '../config/connection.php';

    $msg = [];
    $code = 200;
    $img = $_FILES['imgFile'];

    $tmpName = $img['tmp_name'];
    $size = $img['size'];
    $tip = $img['type'];
    $name = $img['name'];
    $putanja = "../assets/img/gallery/$name";
    $putanjaManja = "../assets/img/thumbnail/$name";

    $productName = trim($_POST['productName']);
    $price = trim($_POST['price']);
    $oldPrice = trim($_POST['oldPrice']);
    $description = trim($_POST['description']);
    $gender = $_POST['selectGender'];
    $brand = $_POST['selectBrand'];



    $errors = 0;

    $regexProductName = "/^[A-Z][a-z0-9]+[\s[A-z0-9]+]?$/";
    $regexPrice = "/^[0-9]+$/";
    $regexOldPrice = "/^[0-9]+$/";
    $regexDescription = "/^[A-Z][a-z0-9]+[\s[A-z0-9]+]?$/";

    if (!preg_match($regexProductName, $productName)) {
        array_push($msg, "Name must begin with a capital letter and have 2 words! <br>");
        $errors++;
    }
    if (!preg_match($regexPrice, $price)) {
        array_push($msg, "Price must include only numbers! <br>");
        $errors++;
    }
    if (!preg_match($regexOldPrice, $oldPrice)) {
        array_push($msg, "Old price must include only numbers! <br>");
        $errors++;
    }
    if (!preg_match($regexDescription, $description)) {
        array_push($msg, "Description must begin with capital letter and have at least 2 words. <br>");
        $errors++;
    }
    if ($gender == 0) {
        array_push($msg, "You have to choose gender <br>");
        $errors++;
    }
    if ($brand == 0) {
        array_push($msg, "You have to choose brand <br>");
        $errors++;
    }
    if (@!$_FILES['imgFile']) {
        array_push($msg, "You have to choose image <br>");
        $errors++;
    }


        if ($errors == 0) {
    

        
        $rezultat = move_uploaded_file($tmpName, $putanja);
            
            //smanjivanje slike

           // $percent = 0.5;

           // list($width, $height) = getimagesize($tmpName);
         //   $newwidth = $width * $percent;
         //   $newheight = $height * $percent;

          //  $src = imagecreatefromjpeg($tmpName);
          //  $dst = imagecreatetruecolor( $newwidth, $newheight );
           // imagecopyresampled( $dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
            //imagejpeg($dst, $putanjaManja);
            

        if (!$rezultat) {
            array_push($msg, "Error with image upload!");
            echo json_encode($msg);
            http_response_code(500);
        } else {
            $sql = "INSERT INTO products VALUES (null, :name, :price, :old_price, :img, :description, :gender_id, :brand_id, null)";
            $priprema = $connection->prepare($sql);
            $priprema->bindParam("name", $productName);
            $priprema->bindParam("price", $price);
            $priprema->bindParam("old_price", $oldPrice);
            $priprema->bindParam("img", $name);
            $priprema->bindParam("description", $description);
            $priprema->bindParam("gender_id", $gender);
            $priprema->bindParam("brand_id", $brand);
            

        	
            try {
                $priprema->execute();
                array_push($msg, "Product successfully added!");
                echo json_encode($msg);
                http_response_code(201);
            } catch (PDOException $e) {
                echo $e->getMessage();
                // array_push($msg, "Server error!");
                // echo json_encode($msg);
                http_response_code(500);
            }
        }
    } else {
        echo json_encode($msg);
        http_response_code(422);
    }
}
