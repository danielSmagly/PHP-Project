<?php 

    //login
    session_start();
    $uid = 'Guest';
   // $uid = 'Pat';
   
  
    if(isset($_SESSION['uid'])){
        
     $uid = $_SESSION['uid'];
    }
    $_SESSION['uid'] = $uid; //if no login, then take guest.
    

    //display whether the user is logged in or not
    if(strcmp($uid,'Guest') == 0){
        echo '<center> Not currently logged in (Guest).<br><br> </center>';
        echo '<center> <a href = "login.html">Click here to log-in</a><br><br> </center>';

    }else{
        $currentUser ='<div style =" float:right; ">'.
         'Welcome '.strtoupper($uid).'  |  '.
        '<a href = "logout_process.php">Log out</a> </div>';
        echo $currentUser.'<br><br>';
    }
    //login
$servername = "127.0.0.1";
$username ="root";
$password ="password";
$dbname = "MyDatabase";

$mysqli = new mysqli($servername,$username,$password,$dbname);

    //base on the uid , query the table to get the comment and the timestamp
    // $sql = 'SELECT * FROM ';
    // $sql .= 'Accounts  WHERE name = '.'"';
    // $sql .= $uid.'"';

    $sql = 'SELECT * FROM Accounts';
   

    $result = $mysqli->query($sql);

    $mysqli->close();
    $data = array();
   // echo 'num row ='.$result->num_rows ;
    //add results into an array or hashmap
     if($result->num_rows > 0 ){
       
        while($row = $result->fetch_assoc()){
           //returns a large interger representing seconds since 1//1/1970
            $date = strtotime($row["timestamp"]);
            //multidim assoc array : date => (name => comment)
            $data[$date] = array($row["name"] => $row["comment"]);
          
        } 
        ksort($data); // sort the assoc array

         //do some formating before echo'ing
        foreach ($data as $timestamp => $nc){    
                                                                 
            foreach($nc as $name =>$comment){
                //first line = name and timestamp
                $currentPost ='<center>';
                $currentPost .='<b>'.$name.'</b>'.'______________________'.date('m/d/yy',$timestamp).'<br>';
                $currentPost .='<div   style="width:800px; margin:0 auto;">'. $comment.'</div> </center>';  
                echo $currentPost;
            };
            echo '<br><br><br>';
        } 

    }else{
       // echo "No Comment!<br>Add one!";
        exit();
    }
     
    echo '<center> <div   style="width:800px; margin:0 auto;"> <a href="addpost.php">Add a comment</a> </div> </center>';  
    // for addpost.php if next uid = 'Guest' for the user to log in or sign up.

?>