<?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'password';
    $dbname = 'mydatabase';

    
    $mysqli = new mysqli($servername,$username,$password,$dbname);

    if($mysqli -> connect_error){
        echo 'Failed to connect to MySQL: '.$mysqli -> connect_error;
        exit();
    }else{
        echo 'Database successfully connected!'.$mysqli -> connect_error;
        echo '<br>';
        echo '<br>';
    }

    //post text input from user
    $post = $_POST['post'];

    //how to obtain name and email, 
    session_start();
    $uid = 'Guest';
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
    }
    $_SESSION['uid'] = $uid; //if no login, then take guest.

    if(strcmp($uid,'Guest') == 0){
        header('Location: logstatus.php');
        exit();
    }
    


    $name = $uid;
    $email = 'NULL';
    $password = 'NULL';

    //There is bug that it only allows to enter short length of text
    

    $sql = "INSERT INTO Accounts(name, email, password, comment, timestamp) VALUES("."'".$name."',"."'".$email."','".$password."','".$post."'".", CURRENT_TIMESTAMP)";

    echo $sql;
    $result = $mysqli->query($sql);


    if($result === TRUE){
        echo '<br>';
        echo 'INSERT was successful <br>';

        echo '<br>';
        //After the user has been signed up then jump to log in page
        header('Location: timeline.php');
    }else{
        echo 'Error INSERT INTO table: '.$mysqli->error.'<br>';
    }

    $mysqli -> close();


?>