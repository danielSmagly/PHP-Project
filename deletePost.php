<?php
    $servername = "127.0.0.1";
    $username ="root";
    $password ="password";
    $dbname = "MyDatabase";

    $mysqli = new mysqli($servername,$username,$password,$dbname);
    //removed tester code?
    if($mysqli -> connect_error){
        echo 'Failed to connect to MySQL: '.$mysqli -> connect_error;
        exit();
    }else{
        echo 'Database successfully connected!'.$mysqli -> connect_error;
        echo '<br>';
        echo '<br>';
    }

    //How to identify which post to delete

    $deletePost_date =  $_POST['deletePost'];

    $sql = "DELETE FROM Accounts WHERE timestamp = '".$deletePost_date."'";

    echo $sql;

    $result = $mysqli->query($sql);

    if($result === true){
        echo '<br>';
        echo 'DELETE was successful <br>';
        echo '<br>';
        header('Location: timeline.php');
        //After the user has been signed up then jump to log in page
        
    }else{
        echo 'DELETE ROW: '.$mysqli->error.'<br>';
    }

    


?>