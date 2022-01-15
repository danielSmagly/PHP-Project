<?php
    //***** add email validation form. **********
    if(empty($_POST['email'])){
        echo 'You left email blank!<br>';
	echo '<a href = "loginpage.html"><br><br>Click here to return to log-in</a><br><br>'; //added way to get back to login page
        exit();
    }

    if(empty($_POST['password'])){
        echo 'You left password blank!<br>';
	echo '<a href = "loginpage.html"><br><br>Click here to return to log-in</a><br><br>';  //added way to get back to login page
        exit();
    }

    //Initialize connection to database
    $servername = 'localhost';
    $username = 'root';
    $password = 'password';
    $dbname = 'mydatabase';

    
    $mysqli = new mysqli($servername,$username,$password,$dbname);
    //removed tester code?
    if($mysqli -> connect_error){
        echo 'Failed to connect to MySQL: '.$mysqli -> connect_error;
        exit();
    }
    

    //User entered username and passowrd
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = '';

    $sql = "CREATE TABLE IF NOT EXISTS accounts(
        name VARCHAR(50), 
        email VARCHAR(50),
        password VARCHAR(50),
        comment VARCHAR(1000),
        timestamp  TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";

    $result = $mysqli -> query($sql);
    
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
            if(strcmp($email, $uid_ref) == 0){
                $verify_user = true;
                $name = $row["name"];  //removed tester and dead code
            }
            if(strcmp($password, $pass_ref) == 0){
                $verify_pass = true;
            }
        }  
    }
    else{
        echo 'Invalid username and/or password <br><br>'; 
	echo '<a href = "loginpage.html"><br><br>Return to log-in</a><br><br>';  //added way to get back to login page
	echo '<a href = "registration.html"><br><br>Sign up</a><br><br>';
    exit();
    }

    //verify the user name the username
    //convert to common case
    $uid = strtolower($uid);
    if($verify_user == false){
        echo 'Invalid username and/or password <br><br>'; 
        echo '<a href = "loginpage.html"><br><br>Return to log-in</a><br><br>';  //added way to get back to login page
        echo '<a href = "registration.html"><br><br>Sign up</a><br><br>';
    exit();
    }

    //validate password
    if($verify_pass == false){
        echo 'Invalid username and/or password <br><br>'; 
        echo '<a href = "loginpage.html"><br><br>Return to log-in</a><br><br>';  //added way to get back to login page
        echo '<a href = "registration.html"><br><br>Sign up</a><br><br>';
    exit();
    }

    session_start();
    $_SESSION['uid'] = $name;
    header('Location: timeline.php');
    $mysqli -> close();
    


    

    


?>
