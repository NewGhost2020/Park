<?php 
require_once 'core/config.php';

//Проверяем, если существует переменная token в глобальном массиве GET

if(isset($_GET['token']) && !empty($_GET['token'])){
    $token = $_GET['token'];
} else
{
    exit("<p><strong>Ошибка!</strong> Отсутствует проверочный код.</p>");
}

//Проверяем, если существует переменная email в глобальном массиве GET

if(isset($_GET['email']) && !empty($_GET['email'])){
    $email = $_GET['email'];
}else{
    exit("<p><strong>Ошибка!</strong> Отсутствует адрес электронной почты.</p>");
}

// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT token FROM users WHERE email='".$email."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    //Проверяем совпадает ли token
    if($token == $row['token']) {
         //Обновляем статус активации 
        $sql = "UPDATE users SET status_account = 1 WHERE email = '".$email."'";   
        if ($conn->query($sql) !== TRUE) {
        echo "Error updating record: " . $conn->error;    
        } 
        //Удаляем токен
        $sql = "UPDATE users SET token = 0 WHERE email='".$email."'";
        if ($conn->query($sql) !== TRUE) {
        echo "Error updating record: " . $conn->error;    
        } 
    }  else{ // токен не совпадает
        exit("<p><strong>Ошибка!</strong> Неправильный проверочный код.</p>");
    }
   
     //Подключение шапки
     require_once("header_min.php");

     //Выводим сообщение о том, что почта успешно подтверждена.
     echo '<h1 style="text-align: center">Почта успешно подтверждена!</h1>';
     echo '<p style="text-align: center">Теперь Вы можете войти в свой аккаунт.</p><br><br>';
    echo '<a href="index.php" class="a-center">Вход в личный кабинет</a>';
    //Подключение подвала
    // require_once("footer.php");
} else {
    echo 0;
    }
$conn->close();
?>

