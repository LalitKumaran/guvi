<?php

require 'index.php';
function profile(){
   global $usercollection;
   if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['age']) && isset($_POST['mobile'])) {
   try{

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $age = $_POST["age"];
    $mobile = $_POST["mobile"];

    $update = array("fname" => $fname ,
    "lname" => $lname, "age" => $age , "mobile" => $mobile );
    $updateResult = $usercollection->updateOne(
    // ["email" => $email] 
    ['$set' => $update]
    );
    echo "Upadated Successfully";
    }catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
  }
  else if(isset($_POST['sessionid'])){
    if($_POST['sessionid'] == 'empty'){
        echo 'no user';
        exit();
    }
    // $email = $redis->get('user');
    // $_SESSION["email"] = $email;
    // $doc = $usercollection->findOne(['email' => $email]);
    // $data = array(
    //     'email' => $email,
    //     'name' => $doc['name'],
    //     'age' => $doc['age'],
    //     'dob' => $doc['dob'],
    //     'mobile' => $doc['mobile'],
    //     'session_id' => session_id()
    // );
    // echo json_encode($data);

    // }else{
    //     session_destroy();
    //     // $redis->flushall();
    // }
}
}
?>

