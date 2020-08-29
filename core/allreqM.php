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
$sql = "SELECT * FROM requests  ORDER BY date_req DESC";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<table>
                <tr>
                    <th id='title_req'>Номер заявки</th>
                    <th id='title_date'>Дата заявки</th>
                    <th id='title_status'>Статус заявки</th>
                    <th id='title_company'>Название организации</th>
                </tr>";

    while($row = $result->fetch_assoc()) {
        $date_temp = date("d-m-Y H:i:", strtotime($row["date_req"]));
         echo "<tr><td class='id-reqMng'>" . $row["id_req"]
        . "</td><td>" . $date_temp 
        . "</td><td class='status_req'>" . $row["status_req"]
        . "</td><td>" . $row["company"]
        . "</td></tr>"; 
    }
    echo "</table>";

} else {
    echo "0";
}


$conn->close();
?>

