<?php
require 'index.php';
function login(){
    global $conn;
    global $redis;
    global $client;
    $usercollection = $client->userdb->usercollection;
    $email = $_POST["email"];
    $password = $_POST["password"];
    // $passcode=hash('sha512',$password);
  
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? ");
    $stmt->bind_param("s",$email);
    if($stmt->execute()){
      $user = $stmt->get_result();   
      if($user->num_rows == 1){
          session_start();
          $row = $user->fetch_assoc();
          if($password == $row['password']){
            $redis->set('user' , $email);
            $updateResult = $usercollection->updateOne(
            ["email" => $email],
            ['$set' =>  ['sessionid' => session_id() ]]
            );
            // echo session_id();
            echo "Login Successful";
          }
          else{
            echo "Wrong Password";
            exit;
          }
      }
      else{
        echo "User Not Registered";
        exit;
      }
    }
    else{
      echo "Error : ".$stmt->error;
    }
  }
?>