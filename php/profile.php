<?php
require 'index.php';
function profile(){
   global $redis;
   global $client;
   $usercollection = $client->userdb->usercollection;
   session_start();
   if(isset($_POST['fname']) || isset($_POST['lname']) || isset($_POST['age']) || isset($_POST['mobile'])) {
   try{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $age = $_POST["age"];
    $mobile = $_POST["mobile"];
    $update = array("fname" => $fname ,
    "lname" => $lname, "age" => $age , "mobile" => $mobile );
    $email = $redis->get('email');
    $updateResult = $usercollection->updateOne(
    ['email' => $email] ,
    ['$set' => $update]
    );
    $redis->set('fname', $fname);
    $redis->set('lname', $lname);
    $redis->set('age', $age);
    $redis->set('mobile', $mobile);
    echo "Updated Successfully";
    
    }catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
    
  }
  else if(isset($_POST['session_id'])){
    if($_POST['session_id'] == 'empty'){
        echo 'User Not Found';
        exit();
    }
    else{
    $data = array(
        'email' => $redis->get('email'),
        'fname' => $redis->get('fname'),
        'lname' => $redis->get('lname'),
        'age' => $redis->get('age'),
        'mobile' => $redis->get('mobile'),
        // 'session_id' => session_id()
    );
    echo json_encode($data);

    }
    }
}
?>

