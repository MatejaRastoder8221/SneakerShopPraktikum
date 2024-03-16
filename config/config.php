<?php

define("MYSQL_HOST", env("SERVER"));
define("MYSQL_DBNAME", env("DATABASE"));
define("MYSQL_USERNAME", env("USERNAME"));
define("MYSQL_PASSWORD", env("PASSWORD"));


function env($marker){
    $baseURL=$_SERVER['DOCUMENT_ROOT'].'/';
    $arr=file($baseURL."config/.env");
    $reqValue= "";
    
    foreach($arr as $row){
        $row=trim($row);

        list($id,$value) = explode("=",$row);

        if($id==$marker){
            $reqValue=$value;
            break;
        }
    }

    return $reqValue;
}
?>