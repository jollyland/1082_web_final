<?php
session_start();
include("PDOInc.php")
?>

<?php

$whitelist = array('image/jpeg');
$filePath = "./uploadFile/";
$resultStr = '';


if( isset($_FILES["pic"]["name"]) && $_FILES["pic"]["name"]!=NULL){
    $tmp = explode(".", $_FILES["pic"]["name"]);
    $extension = strtolower(end($tmp));
    if( in_array($extension, $whitelist) && $_FILES["pic"]["size"] <= 1024 * 1024){
        $resultStr = "Submit file OK.";
        move_uploaded_file($_FILES["pic"]["tmp_name"], $filePath.$_FILES["pic"]["name"]);
    }
    else {
        $resultStr = "Submit file GG!!";
    }

}
 

?>