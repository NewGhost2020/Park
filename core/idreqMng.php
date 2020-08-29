<?php
require_once 'config.php';
$id_req= trim($_POST['id_req']);
$email= trim($_POST['email']);
if ($id_req =='' || $email ==''){
    die;
}
// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$stat;
// Выбор номера записи
$sql = "SELECT * FROM requests WHERE id_req='".$id_req."' ORDER BY date_req DESC";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<br>";
    while($row = $result->fetch_assoc()) {
         echo "<b>Номер заявки:</b> " . $row["id_req"] 
         . "<br><b>Дата заявки:</b> " . $row["date_req"]
         . "<br><b>Статус заявки:</b><span id='sr'> " . $row["status_req"]
         . "</span><br><b>Примечание:</b> " . $row["comentary"]
        ; 
        $emailU = $row["email"];
        $stat = $row["status_req"];
    }
        
    echo "<h4>Загруженные файлы:</h4>";
        $dir = "../users/{$emailU}/{$id_req}/";
        if($handle = opendir($dir)){
            while(false !== ($file = readdir($handle))) {
                if($file != "." && $file != ".." && $file != ".DS_Store"){
            // echo $file."<br>";
            echo '<a href="core/dl_save.php?filename='.$dir.$file.'" >'.$file.'</a><br>';
            // echo '<a href="core/dl_save.php?filename=https://park.amilang.ru/cabinet/user/'.$emailU.'/'.$id_req.'/'.$file.'" >'.$file.'</a><br>';
                }
            }
        }
        
} else {
    echo "0";
}
// Выбор записи по id из log
$sql = "SELECT * FROM log WHERE id_req='".$id_req."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<br>";
    while($row = $result->fetch_assoc()) {
         echo "<br><b>Дата события:</b> " . $row["date_event"] 
         . "<br><b>Событие:</b> " . $row["events"]
         . "<br><b>Примечание:</b> " . $row["coment"]."<br>"
        ; 
    }
}
echo '<br><br><button class = "cansel" id="add-filesMng">Новые документы</button>';
if(!(($stat == 'Удовлетворена') OR ($stat == 'Аннулирована'))) {
//Вывод кнопки Добавить
// echo '<br><br><button class = "cansel" id="add-filesMng">Новые документы</button>';
//Вывод кнопки Сменить статус
echo '<button class = "cansel" id="ch-status">Сменить статус</button>';
}

$conn->close();

