<?php
require_once 'config.php';


$f_name = trim($_POST['f_name']);
$s_name = trim($_POST['s_name']);
$l_name = trim($_POST['l_name']);
$company = trim($_POST['company']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$agree_mail = trim($_POST['agree_mail']);
$agree_rules = trim($_POST['agree_rules']);
$agree_data = trim($_POST['agree_data']);

if ($l_name =='' OR $s_name =='' OR $f_name =='' OR $company =='' OR $phone =='' OR $password=='' OR $email=='' OR $agree_data=='' OR $agree_rules ==''){
    die;
}

$agree_mail =='' ? $agree_mail = 0 :  $agree_mail = 1; 

// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Проверка уникальности email
$sql = "SELECT * FROM users WHERE email='".$email."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo 0;
    die();
} 
// Запись в user
//Составляем зашифрованный и уникальный token
$token=md5($email.time());

$sql = "INSERT INTO users (f_name, s_name, l_name, company, phone, email, password, m_status, token) VALUES ('".$f_name."', '".$s_name."', '".$l_name."', '".$company."', '".$phone."', '".$email."', '".$password."', '".$agree_mail."', '".$token."')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// запись в архив
$today = date("Y-m-d H:i:s");
$sql = "INSERT INTO arch_user (date_event, f_name, s_name, l_name, company, phone, email, password, m_status) VALUES ('".$today."', '".$f_name."', '".$s_name."', '".$l_name."', '".$company."', '".$phone."', '".$email."', '".$password."', '".$agree_mail."')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// запись в лог
$events = 'reg';

$sql = "INSERT INTO log (date_event, events, email) VALUES ('".$today."', '".$events."', '".$email."')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//------Отправляем письмо с подтверждением-------
$address_site = "https://parkind.ru/cabinet/";
$subject = "Подтверждение почты на сайте ".$_SERVER['HTTP_HOST'];
$subject = "=?utf-8?B?".base64_encode($subject)."?=";

//Составляем тело сообщения
$message = 'Уважаемый (ая) '.$f_name.' '.$s_name.'!<br/> <br/>
Сегодня '.date("d.m.Y", time()).', Вами зарегистрирован аккаунт в Личном кабинете ООО «Киришская сервисная компания».<br>
Для подтверждения действительности данных действий перейдите, пожалуйста, по ссылке:<br>
<a href="'.$address_site.'activation.php?token='.$token.'&email='.$email.'">'.$address_site.'activation/'.$token.'</a>. <br/> <br/>
В случае, если не вы осуществляли регистрацию в Личном кабинете, то переходить по данной ссылке не нужно.
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
$headers = "FROM: $email_admin\r\nContent-type: text/html; charset=utf-8\r\n";


//Отправляем сообщение с ссылкой для подтверждения
if(mail($email, $subject, $message, $headers)){
echo 1;
} else {
    echo 0;
}

$conn->close();
?>