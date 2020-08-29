<?php
require_once 'config.php';

$emailMng= trim($_POST['email']);
$id_req = trim($_POST['id_req']);
$status = trim($_POST['n_status']);

if($emailMng =='' OR $id_req =='' OR $status =='') {
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
// ВЫтаскиваем email
$sql = "SELECT email FROM requests WHERE id_req='".$id_req."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
    $emailUs=$row['email'];

} else { echo 'Такой заявки нет';}

// запись в лог
$today = date("Y-m-d H:i:s");
$events = 'change_stat';
$coment = $status;
$sql = "INSERT INTO log (date_event, events, coment, email, id_req) VALUES ('".$today."', '".$events."', '".$coment."', '".$emailUs."', '".$id_req."')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//Обновляем статус заявки 
$sql = "UPDATE requests SET status_req = '".$status."' WHERE id_req='".$id_req."'";   
if ($conn->query($sql) !== TRUE) {
echo "Error updating record: " . $conn->error;    
} 
// Получение данных о пользователе

$sql = "SELECT * FROM users WHERE email='".$emailUs."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
    $m_status = $row['m_status'];
    $company=$row['company'];
    $f_name = $row['f_name'];
    $s_name = $row['s_name'];


        //------Письмо об изменении статуса Исполнителю-------
$address_site = "https://parkind.ru/cabinet/";
$subject = "Информация с сайта ".$_SERVER['HTTP_HOST'];
$subject = "=?utf-8?B?".base64_encode($subject)."?=";

//Составляем тело сообщения
$message = 'Вами изменен статус заявки № '.$id_req.' на техприсоединение к электрическим сетям.<br>
Заявитель '.$company.'.
<br>
<br>
<hr>
<br>
<br>
Письмо сформировано автоматическим сервисом Личный кабинет  ООО «Киришская сервисная компания».<br> 
Вы получили его как зарегистрированный пользователь сайта www.parkind.ru.<br>
Ознакомьтесь с нашей Политикой конфиденциальности и Правилами пользования Личным кабинетом.<br>
Данное письмо не требует ответа.<br>
По всем вопросам обращайтесь на тел. горячей линии <b>+8 (800) 234 12 78</b>  или на почту <b>servksk@yandex.ru</b>';

$message = wordwrap($message, 70, "\r\n");

//Составляем дополнительные заголовки для почтового сервиса mail.ru

$email_admin = "admin@parkind.ru";
$headers = "FROM: $email_admin\r\nReply-to: $email_admin\r\nContent-type: text/html; charset=utf-8\r\n";

 //Отправляем сообщение 
    if(!mail($emailMng, $subject, $message, $headers)){
    echo 0;
    }
//----------------end send-----------------
// ----------------Проверка на получение уведомления-----
    if($m_status === 0) {
        echo "m_status 0";
        die;
    }
 //------Письмо об изменении статуса Пользователю-------
 $address_site = "https://parkind.ru/cabinet/";
 $subject = "Информация с сайта ".$_SERVER['HTTP_HOST'];
 $subject = "=?utf-8?B?".base64_encode($subject)."?=";
 
 //Составляем тело сообщения
 $message = 'Уважаемый (ая) '.$f_name.' '.$s_name.'!<br/> <br/> 
 Статус вашей заявки № '.$id_req.' на техприсоединение к электрическим сетям изменен на <b>"'.$status.'"</b>.

 <br>
 <br>
 <hr>
 <br>
 <br>
 Письмо сформировано автоматическим сервисом Личный кабинет  ООО «Киришская сервисная компания».<br> 
 Вы получили его как зарегистрированный пользователь сайта www.parkind.ru.<br>
 Ознакомьтесь с нашей Политикой конфиденциальности и Правилами пользования Личным кабинетом.<br>
 Данное письмо не требует ответа.<br>
 По всем вопросам обращайтесь на тел. горячей линии <b>+8 (800) 234 12 78</b>  или на почту <b>servksk@yandex.ru</b>';
 
 $message = wordwrap($message, 70, "\r\n");
 
 //Составляем дополнительные заголовки для почтового сервиса mail.ru
$email_admin = "admin@parkind.ru";
$headers = "FROM: $email_admin\r\nReply-to: $email_admin\r\nContent-type: text/html; charset=utf-8\r\n";
 
 
  //Отправляем сообщение 
     if(!mail($emailUs, $subject, $message, $headers)){
     echo 0;
     } else { echo 1;}

} else {
    echo "0";
}

$conn->close();

?>


