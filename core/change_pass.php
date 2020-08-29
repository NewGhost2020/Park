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

// Проверка  email и пароль
$sql = "SELECT password FROM users WHERE email='".$email."' AND status_account='".'1'."'";
$result = $conn->query($sql);


if ($result->num_rows == 0) {     
    echo 0; // Ошибка!
} else if($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $password=$row['password'];
    echo $password;
    sendPassMail($email, $password);
    //  echo json_encode($row); // Авторизация
}
function sendPassMail($email, $password) {
    $address_site = "https://parkind.ru/cabinet/";
    $subject = "Подтверждение действий на сайте ".$_SERVER['HTTP_HOST'];
    $subject = "=?utf-8?B?".base64_encode($subject)."?=";
    
    //Составляем тело сообщения
    $message = 'Уважаемый пользователь!<br/> <br/>
    Ваш пароль: '.$password.'<br>
    Не показывайте и не передавайте пароль посторонним лицам.<br> Изменить пароль вы всегда можете в разделе Профиль пользователя.
    <br>
    <hr>
    <br>
    <br>
    Письмо сформировано автоматическим сервисом Личный кабинет  ООО «Киришская сервисная компания».<br> 
    Вы получили его как зарегистрированный пользователь сайта www.parkind.ru.<br>
    Ознакомьтесь с нашей Политикой конфиденциальности и Правилами пользования Личным кабинетом.<br>
    Данное письмо не требует ответа.<br>
    По всем вопросам обращайтесь на тел. горячей линии <b>+8 (800) 234 12 78</b>  или на почту servksk@yandex.ru';
    $message = wordwrap($message, 70, "\r\n");
    
    //Составляем дополнительные заголовки для почтового сервиса mail.ru
$email_admin = "admin@parkind.ru";
$headers = "FROM: $email_admin\r\nReply-to: $email_admin\r\nContent-type: text/html; charset=utf-8\r\n";
 
    
    //Отправляем сообщение 
    if(mail($email, $subject, $message, $headers)){
    // echo 1;
    } else { 
                echo 0;
        }
    }
    
$conn->close();
?>