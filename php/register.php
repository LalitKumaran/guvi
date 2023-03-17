<?php
require './index.php';
// require '../vendor/autoload.php';

function register(){
    global $conn;
    // global $client;

    // // $client = new MongoDB\Client;
    // $usercollection = $client->userdb->usercollection;
    $redis = new Predis\Client();
    if($redis->get('user')){
      echo "Session Exists";
    }
    else{
    $email = $_POST["email"];
    $password = $_POST["password"];
    if(empty($email)){
        echo "Please enter your EmailID";
        exit;
    }
    if(empty($password)){
        echo "Please enter your password";
        exit;
    }
    // $passcode = hash('sha512',$password);
    $user = $conn->prepare("SELECT * FROM users WHERE email = ? ");
    $user->bind_param("s",$email);
    if($user->execute()){
      $result = $user->get_result();
      if($result->num_rows > 0){
        echo "Username Has Already Taken";
        exit;
      }
    }
    else{
      echo "Error : ".$user->error;
    }
    // $password=hash('sha512',$password);
    $stmt = $conn->prepare("INSERT INTO users VALUES('', ? , ? )");
    $stmt->bind_param("ss",$email,$password);
    if($stmt->execute()){
      // $result = $usercollection->insertOne([
      //     "email" => $email ,
      //     "fname" => '',
      //     "lname" => '',
      //     "age" => '',
      //     "mobile" => '',

      // ]);
      // echo $result;
      echo "Registration Successful";
    }
    else{
      echo "Error : ".$stmt->error;
    }
}
}
?>