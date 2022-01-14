<?php 

    //login
    session_start();
    
    $uid = 'Guest';
    //$uid = 'Pat';
   
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
    }
    $_SESSION['uid'] = $uid; //if no login, then take guest.

    //display whether the user is logged in or not
    if(strcmp($uid,'Guest') == 0){
        echo '<center> Not currently logged in (Guest).<br><br> </center>';
        echo '<center> <a href = "loginPage.html">Click here to log-in</a><br><br> </center>';

    }else{
        $currentUser ='<div style =" float:right; ">'.
        'Welcome '.strtoupper($uid).'  |  '.
        '<a href = "contact_us.html">Contact Us</a>'.'  |  '.
        '<a href = "logout_process.php">Log out</a> </div>';
        echo $currentUser.'<br><br>';
    }
    //login
    $servername = "127.0.0.1";
    $username ="root";
    $password ="password";
    $dbname = "MyDatabase";

    $mysqli = new mysqli($servername,$username,$password,$dbname);

  // code to create table
   $sql = "CREATE TABLE IF NOT EXISTS accounts(
        name VARCHAR(50), 
        email VARCHAR(50),
        password VARCHAR(50),
        comment VARCHAR(1000),
        timestamp  TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
  

    //assuming the table exist get everything
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
                if($comment !=''){ //if comment is empty don't post it
                    $currentPost ='<left>';
                    $currentPost .='<b>'.$name.'</b>'.'______________________'.date('m/d/y h:i:sa',$timestamp);
                    $currentPost .='<div style="background: #dadee7; solid 2px; font-size: 100%; padding: 10px; margin: 20 auto;">'. $comment.'</div> </left>';  
                    $currentPost .="<form method='post' action='deletePost.php'>
                                       <button type = 'submit' name = 'deletePost' value ='".date('Y-m-d H:i:s',$timestamp)."'>Delete  </button>
                                    </form>";
                    echo $currentPost;
                    echo '<br><br><br>';
                }
            };
           
        } 

    }else{
        echo "No Comment so far!<br>Add one!";
        exit();
    }
     
    echo '<center> <div   style="width:800px; margin:0 auto;"> <a href="addpost.html">Add a comment</a> </div> </center>';  
    // for addpost.php if next uid = 'Guest' for the user to log in or sign up.

?>
