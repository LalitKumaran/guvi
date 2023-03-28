<?php
require './index.php';
function register(){
    global $conn;
    global $redis;
    global $client;

    $usercollection = $client->userdb->usercollection;

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
    if($redis->exists('email')){
      session_start();
      $redis->flushall();
      session_destroy();
    }
    $stmt = $conn->prepare("INSERT INTO users VALUES('', ? , ? )");
    $stmt->bind_param("ss",$email,$password);
    if($stmt->execute()){
      $result = $usercollection->insertOne([
          "email" => $email ,
          "fname" => 'Nil',
          "lname" => 'Nil',
          "age" => 'Nil',
          "mobile" => 'Nil',

      ]);
      echo "Registration Successful";
    }
    else{
      echo "Error : ".$stmt->error;
    }
}
?>