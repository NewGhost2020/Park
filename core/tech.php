<?php
require_once 'config.php';


$f_name = trim($_POST['f_name']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$pregunta = trim($_POST['pregunta']);

if ($f_name =='' OR $phone =='' OR $email=='' OR $pregunta==''){
    die;
}


//------Отправляем письмо с подтверждением-------
$address_site = "https://parkind.ru/cabinet/";
$subject = "Вопрос с сайта ".$_SERVER['HTTP_HOST'];
$subject = "=?utf-8?B?".base64_encode($subject)."?=";
$email_mod = "vip.box@mail.ru";
$email_mod2 = "sale@parkind.ru";

//Составляем тело сообщения
$message = 'Пользователь '.$f_name.' задал вопрос в техподдержку Личного кабинета ООО «КСК».<br/> <br/>
Почта для обратной связи: '.$email.'<br>
Телефон: '.$phone.'<br>			
Вопрос: '.$pregunta.'<br>	
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
if(mail($email_mod, $subject, $message, $headers)){
echo 1;
} else { echo 0;}
if(mail($email_mod2, $subject, $message, $headers)){
echo 1;
} else { echo 0;}
?>