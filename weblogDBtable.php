<?php
    $server_name = "localhost";
    $user_name = "root";
    $password = "password";
    $dbname = "mydatabase";

    $mysqli = new mysqli($server_name, $user_name, $password, $dbname);

    if($mysqli -> connect_error){
        echo 'Failed to connect to MySql: '.$mysqli -> connect_error;
        //end the script
        exit();
    }
    else{
        echo 'DataBase succesfully connect !<br>';
    }
    /*
    $sql = "CREATE TABLE Accounts(
        Username VARCHAR(25) NOT NULL, 
        pass VARCHAR(25) NOT NULL,
        PRIMARY KEY (USERNAME))";


    if($mysqli->query($sql) == true){
        echo "Table 'Accounts' created successfully <br>";
     }else{
        echo 'Error creating table: '.$mysqli->error.'<br>';
    }
    */

    $sql = "CREATE TABLE Accounts_userdata(
        Username VARCHAR(25) NOT NULL,
        post VARCHAR(255),
        comment VARCHAR(255),
        datePosted date,
        PRIMARY KEY (USERNAME))";
    

    if($mysqli->query($sql) == true){
        echo "Table 'Accounts_userdata' created successfully <br>";
    }
    else{
        echo 'Error creating table: '.$mysqli->error.'<br>';
    }   
?>