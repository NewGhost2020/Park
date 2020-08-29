<?php
require_once 'config.php';

$email= trim($_POST['email']);

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

// Выбор номера записи
$sql = "SELECT * FROM log WHERE email='".$email."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<br>";
    while($row = $result->fetch_assoc()) {
         echo "<br><b>Дата события:</b> " . $row["date_event"] 
         . "<br><b>Событие:</b> " . $row["events"]
         . "<br><b>Примечание:</b> " . $row["coment"]."<br>"
        ; 
    }
} else {
    echo "0";
}


$conn->close();
?>