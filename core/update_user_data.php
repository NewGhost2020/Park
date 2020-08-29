<?php
require_once 'config.php';

$f_name = trim($_POST['f_name']);
$s_name = trim($_POST['s_name']);
$l_name = trim($_POST['l_name']);
$company = trim($_POST['company']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$agree_mail = trim($_POST['agree_mail']);

$agree_mail =='' ? $agree_mail = 0 :  $agree_mail = 1; 

if ($email ==''){
    echo 2;
    die;
}

// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Обновление users
$sql = "UPDATE users SET f_name='".$f_name."', s_name='".$s_name."', l_name='".$l_name."', company='".$company."', phone='".$phone."', password='".$password."', m_status='".$agree_mail."' WHERE email='".$email."'";
                                                                                       
if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// запись в архив
$today = date("Y-m-d H:i:s");
$sql = "INSERT INTO arch_user (date_event, f_name, s_name, l_name, company, phone, email, password, m_status) VALUES ('".$today."', '".$f_name."', '".$s_name."', '".$l_name."', '".$company."', '".$phone."', '".$email."', '".$password."', '".$agree_mail."')";

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