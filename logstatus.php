<?php 

    //login
    session_start();
    $uid = 'Guest';
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
    }
    $_SESSION['uid'] = $uid; //if no login, then take guest.

    //display whether the user is logged in or not
    if(strcmp($uid,'Guest') == 0){
        echo 'Not currently logged in (Guest).<br><br>';
        echo '<a href = "login.html">Click here to log-in</a><br><br>';

    }else{
        echo 'Logged in as '.strtoupper($uid).'<br><br>';
        echo '<a href = "logout_process.php">Click here to Log out</a><br><br>';
    }

    //base on the uid , query the table to get the comment and the timestamp
    //add results into an array or hashmap
    //do some formating before echo'ing
    //first line = name and timestamp
    //then the comment
    //<br><br>
    //repeat for each element in the hashmap

?>