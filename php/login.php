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
            $redis->set('email' , $email);
            $result = $usercollection->findOne(["email" => $email]);
            $redis->set('fname' , $result['fname']);
            $redis->set('lname' , $result['lname']);
            $redis->set('age' , $result['age']);
            $redis->set('mobile' , $result['mobile']);
            // echo session_id();
            $response = array(
              'msg'   => "Login Successful",
              "session_id" => session_id()
          );
            $json_data = json_encode($response);
            echo $json_data;
          }
          else{
            $response = array(
              'msg'   => "Wrong Password",
          );
            $json_data = json_encode($response);
            echo $json_data;
            exit();
          }
      }
      else{
        $response = array(
          'msg'   => "User Not Registered",
      );
        $json_data = json_encode($response);
        echo $json_data;
        exit();
      }
    }
    else{
      $response = array(
        'msg'   => "Error : ".$stmt->error,
    );
      $json_data = json_encode($response);
      echo $json_data;
    }
  }
?>