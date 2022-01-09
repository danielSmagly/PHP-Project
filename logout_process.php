<?php 

    //login
    session_start();
    $_SESSION['uid'] = 'Guest';
    header('Location: logstatus.php');


?>