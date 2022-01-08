<?php
    //***** add email validation form. **********
    if(empty($_POST['email'])){
        echo 'You Left email blank!';
        exit();
    }

    if(empty($_POST['password'])){
        echo 'You Left password blank!';
        exit();
    }

    //Initialize connection to database
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

    //User entered username and passowrd
    $email = $_POST['email'];
    $password = $_POST['password'];

    $username = strtolower($username);

    //validate the password by referencing the database
    $verify_user = false;
    $verify_pass = false;
    $sql = "SELECT * FROM accounts";
    $result = $mysqli -> query($sql);
    if($result -> num_rows > 0){
        //Output each row of data
        while($row = $result -> fetch_assoc()){
            $uid_ref = $row["email"];
            $pass_ref = $row["password"];
            $uid_ref = strtolower($uid_ref);
            echo $uid_ref.'<br>';
            echo $pass_ref;
            //echo $uid_ref.'<br>';
            //echo $pass_ref;
            if(strcmp($email, $uid_ref) == 0){
                $verify_user = true;
            }
            if(strcmp($password, $pass_ref) == 0){
                $verify_pass = true;
            }
        }  
    }
    else{
        echo '0 results <br>';
    }

    //verify the user name the username
    //convert to common case
    $uid = strtolower($uid);
    if($verify_user == false){
        echo 'This is invalid username or password';
        exit();
    }

    //validate password
    if($verify_pass == false){
        echo 'This is invalid username or password';
        exit();
    }

    session_start();
    $_SESSION['uid'] = $uid;
    header('Location: timeline.php');
    $mysqli -> close();
    


    

    


?>
