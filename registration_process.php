<?php
    $servername = "localhost";
    $username ="root";
    $password ="password";
    $dbname = "MyDatabase";

    $mysqli = new mysqli($servername,$username,$password,$dbname);

    if($mysqli -> connect_errno){
        echo 'Failed to connect to MySQL: '.$mysqli -> connect_error;
        exit();
    }else{
        echo 'Database successfully connected!'.$mysqli -> connect_error;
        echo '<br>';
        echo '<br>';
    }

    $uid = $_POST['username'];
    $password = $_POST['password'];

    //Can add feature to validate the username and password for certaint requiremen
  

    $sql = "INSERT INTO Accounts(Username, pass) VALUES("."'".$uid."',"."'".$password."')";
    

    $result = $mysqli->query($sql);

    $pagename = 'loginPage.html';

    if($result === TRUE ){
        echo '<br>';
        echo 'INSERT was successful <br>';
        echo '<br>';
        //After the user has been signed up then jump to log in page
        header('Location: '.$pagename);
    }else{
        echo 'Error INSERT INTO table: '.$mysqli->error.'<br>';
    }


?>