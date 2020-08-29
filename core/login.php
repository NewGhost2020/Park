<?php
require_once 'config.php';

$email= trim(addslashes($_POST['email']));
// $email= trim($_POST['email']);
$password = trim($_POST['password']);

if ($email =='' OR $password==''){
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

// Проверка  email и пароль
$sql = "SELECT * FROM users WHERE email='".$email."' AND password='".$password."' AND status_account='".'1'."' AND bl_list='".'0'."'";
$result = $conn->query($sql);


if ($result->num_rows === 0) {     
    echo "0"; // Ошибка!
} else if($result->num_rows == 1) {
    $row = $result->fetch_assoc();
     echo json_encode($row); // Авторизация
}
$conn->close();
?>