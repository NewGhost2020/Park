<?php
require_once 'config.php';

$email = trim($_POST['email']);
$subject = trim($_POST['subject']);
$content = trim($_POST['content']);

if ($email =='' OR $subject =='' OR $content==''){
    echo 2;
    die;
}
// Mail---------------------------------
$to  = "<i2972347@icloud.com>, " ; 
$to .= "2972347@gmail.com>"; 

$subject = "Тестовое письмо"; 
$subject = "=?utf-8?B?".base64_encode($subject)."?=";

$message = ' <p>Вам пришло письмо счастья</p> </br> <b>Ура!</b> </br><i>Наконец-то!</i> </br>';
// На случай если какая-то строка письма длиннее 70 символов мы используем wordwrap()
$message = wordwrap($message, 70, "\r\n");

$headers  = "Content-type: text/html; charset= UTF-8 \r\n"; 
$headers .= "From: От администрации Парка <from@example.com>\r\n"; 
$headers .= "Reply-To: reply-to@example.com\r\n"; 

// Отправляем
if(mail($to, $subject, $message, $headers)) {
    echo 0;
}