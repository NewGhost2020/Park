<?php
require_once 'config.php';

$email= trim($_POST['email']);
$id_req= trim($_POST['id_req']);
if ($email =='' OR $id_req ==''){
    die;
}
// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$code = genPass(8);
echo $code;
sendCheckMail($email, $code, $id_req);

function genPass($length) {    
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
    $strlength = strlen($characters);    
    $random = '';   
    for ($i = 0; $i < $length; $i++) {
        $random .= $characters[rand(0, $strlength - 1)];
    }
    return $random;
}

function sendCheckMail($email, $code, $id_req) {
$address_site = "https://parkind.ru/cabinet/";
$subject = "Подтверждение действий на сайте ".$_SERVER['HTTP_HOST'];
$subject = "=?utf-8?B?".base64_encode($subject)."?=";

//Составляем тело сообщения
$message = 'Вы собираетесь изменить статус заявки № '.$id_req.' на техприсоединение к электрическим сетям.<br>
Временный пароль для осуществления данной процедуры: '.$code.'<br> 
Пароль действителен в течение 10 минут.
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

