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
        echo '0 accounts found <br><br>'; 
	echo '<a href = "loginpage.html"><br><br>Click here to return to log-in</a><br><br>';  //added way to get back to login page
	exit();
    }

    //verify the user name the username
    //convert to common case
    $uid = strtolower($uid);
    if($verify_user == false){
        echo 'Invalid username or password';
	echo '<a href = "loginpage.html"><br><br>Click here to return to log-in</a><br><br>';  //added way to get back to login page
        exit();
    }

    //validate password
    if($verify_pass == false){
        echo 'Invalid username or password';
	echo '<a href = "loginpage.html"><br><br>Click here to return to log-in</a><br><br>';  //added way to get back to login page
        exit();
    }

    session_start();
    $_SESSION['uid'] = $name;
    header('Location: timeline.php');
    $mysqli -> close();
    


    

    


?>
