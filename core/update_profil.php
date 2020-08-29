<?php
require_once 'config.php';

$f_name = trim($_POST['f_name']);
$s_name = trim($_POST['s_name']);
$l_name = trim($_POST['l_name']);
$company = trim($_POST['company']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$type_users = trim($_POST['status']);
$bl_list = trim($_POST['bl_list']);

$bl_list =='' ? $bl_list = 0 :  $bl_list = 1; 

if ($email ==''){
    echo 2;
    die;
}
// $today = date("D.m.Y",strtotime($datetime));

// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Обновление users
$sql = "UPDATE users SET type_users='".$type_users."', f_name='".$f_name."', s_name='".$s_name."', l_name='".$l_name."', company='".$company."', phone='".$phone."', bl_list='".$bl_list."' WHERE email='".$email."'";
                                                                                       
if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// запись в архив
$today = date("Y-m-d H:i:s");

$sql = "INSERT INTO arch_user (date_event, type_users, f_name, s_name, l_name, company, phone, email, bl_list) VALUES ('".$today."', '".$type_users."', '".$f_name."', '".$s_name."', '".$l_name."', '".$company."', '".$phone."', '".$email."', '".$bl_list."')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// запись в лог
$events = 'update';
$sql = "INSERT INTO log (date_event, events, email) VALUES ('".$today."', '".$events."', '".$email."')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

echo 1;

$conn->close();
?>