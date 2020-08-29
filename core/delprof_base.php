<?php
require_once 'config.php';

$email= trim($_POST['email']);
if ($email ==''){
    die;
}
// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Запись в user
// $sql = "UPDATE users SET status_account = 2 WHERE email = '".$email."'"; 
   $sql = "DELETE FROM users WHERE email = '".$email."'";
if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// запись в лог
$events = 'del_prof';
$today = date("Y-m-d H:i:s");

$sql = "INSERT INTO log (date_event, events, email) VALUES ('".$today."', '".$events."', '".$email."')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>