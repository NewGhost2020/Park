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
$sql = "SELECT * FROM requests WHERE email='".$email."' AND NOT(status_req = 'Аннулирована'  OR  status_req = 'Удовлетворена')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo 0;
} else {
    $code = genPass(8);
    echo $code;
    sendCheckMail($email, $code);
}
function genPass($length) {
    
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
    $strlength = strlen($characters);
    
    $random = '';
    
    for ($i = 0; $i < $length; $i++) {
        $random .= $characters[rand(0, $strlength - 1)];
    }
    return $random;
}
function sendCheckMail($email, $code) {
$address_site = "https://parkind.ru/cabinet/";
$subject = "Подтверждение действий на сайте ".$_SERVER['HTTP_HOST'];
$subject = "=?utf-8?B?".base64_encode($subject)."?=";

//Составляем тело сообщения
$message = 'Уважаемый пользователь!<br/> <br/>
Код подтверждения: '.$code.'<br>
Введите его для подтверждения удаления профиля.
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

