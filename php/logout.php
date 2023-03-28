<?php
require 'index.php';
function logout(){
    global $redis;
    if ($_POST['action']=="logout"){
        session_start();
        $redis->flushall();
        session_destroy();
        echo "Logged out";
        exit();
    }
}

?>