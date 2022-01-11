

<?php
   session_start();

   $uid = 'Guest';

   if(isset($_SESSION['uid'])){
       $uid = $_SESSION['uid'];
   }
   
   $_SESSION['uid'] = $uid; 

   
   if(strcmp($uid,'Guest') == 0){
       echo 'Not currently logged in (Guest).<br><br>';
       echo '<a href = "loginpage.html">Click here to log-in</a><br><br>';

   } else {
    $currentUser ='<div style =" float:right; ">'.
    'Welcome '.strtoupper($uid).'  |  '.
    '<a href = "timeline.php">Back to timeline</a>'.'  |  '.
    '<a href = "logout_process.php">Log out</a> </div>';
    echo $currentUser.'<br><br>';
   }



?>