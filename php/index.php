<?php
// session_start();
$conn = mysqli_connect("localhost","root","","guvi");

if(isset($_POST["action"])){
    if($_POST["action"] == "register"){
        register();
    }
    else if($_POST["action"] == "login"){
        login();
    } 
    if($_POST["action"] == "profile"){
        profile();
    }
}

// require '../vendor/autoload.php';

// $client = new MongoDB\Client("mongodb://localhost:27017");



?>