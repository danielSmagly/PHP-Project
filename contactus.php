<?php

session_start();
$uid = 'Guest';


if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
}
$_SESSION['uid'] = $uid; //if no login, then take guest.

//display whether the user is logged in or not
if (strcmp($uid, 'Guest') == 0) {
    echo '<center> Not currently logged in (Guest).<br><br> </center>';
    echo '<center> <a href = "loginPage.html">Click here to log-in</a><br><br> </center>';
} else {
    $currentUser = '<div style =" float:right; ">' .
        'Welcome ' . strtoupper($uid) . '  |  ' .
        '<a href = "timeline.php">Back to Timeline</a>' . '  |  ' .
        '<a href = "logout_process.php">Log out</a> </div>';
    echo $currentUser . '<br><br>';
}
//login
$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "MyDatabase";

$mysqli = new mysqli($servername, $username, $password, $dbname);
error_reporting(0);

//check empty field

if (empty($_POST['name'])) {
    echo 'You left name field blank!';
    exit();
}

if (empty($_POST['receiver'])) {
    echo 'You left email field blank!';
    exit();
}

// get form data

$name = $_POST['name'];
$email = $_POST['receiver'];
$message = $_POST['message'];
$name = test_input($name);
$email = test_input($email);
$message = test_input($message);

// validate email

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invaild email format.';
    exit();
}

//validate message

if (strlen($message) < 10) {
    echo 'Messsage must be at least 10 characters long';
    exit();
}

// send to web server

$subject = 'Contact Us';
$recipient = 'danielsmagly@gmail.com';
$msg = sprintf('Return address: %s \n\nMessage: %s', $email, $message);
if (mail($recipient, $subject, $msg)) {
    echo 'Mail sent';
} else {
    echo 'err sndn email';
    exit();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
