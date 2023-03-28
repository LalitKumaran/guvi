<?php

$conn = mysqli_connect("localhost","root","","guvi");
require '../vendor/autoload.php';
$redis = new Predis\Client();
$client = new MongoDB\Client("mongodb://localhost:27017");

if(isset($_POST["action"])){
    if($_POST["action"] == "register"){
        register();
    }
    else if($_POST["action"] == "login"){
        login();
    } 
    else if($_POST["action"] == "profile"){
        profile();
    }
    else if($_POST["action"] == "logout"){
        logout();
    }
}

?>