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

// Выбор номера записи
$sql = "SELECT * FROM users";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<table>
                <tr>
                    <th>Статус</th>
                    <th>Email</th>
                    <th>Название организации</th>
                    <th>Блокировка</th>
                </tr>";

    while($row = $result->fetch_assoc()) {
        if($row["type_users"] == 1) {
            $user = "Заявитель";
        } 
        else if($row["type_users"] == 2) {
            $user = "Исполнитель";
        }
        else if($row["type_users"] == 3) {
            $user = "Модератор";
        }if($row["bl_list"] == 1) {
            $blList = "Да";
        } 
        else if($row["bl_list"] == 0) {
            $blList = "Нет";
        }
         echo "<tr><td class='type_users'>" . $user
        . "</td><td class='prof_us_email'>" . $row["email"] 
        . "</td><td class='prof_company'>" . $row["company"]
        . "</td><td class='prof_bl'>" . $blList
        . "</td></tr>"; 
    }
    echo "</table>";

} else {
    echo "0";
}


$conn->close();
?>

