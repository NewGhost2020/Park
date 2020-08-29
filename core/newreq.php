<?php
require_once 'config.php';
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();


$email= trim($_POST['email']);

if ($email ==''){
    echo "Вы не авторизованы!";
    die;
}
//Проверка размера файлов
 if($_FILES)
{   
    $sizeFiles;
    $sizeMax = 20*1024*1024;
    foreach ($_FILES["uploads"]["error"] as $key => $error) {
            $size = $_FILES["uploads"]["size"][$key];
            // $type = $_FILES["uploads"]["type"][$key];
            $sizeFiles += $size/1024/1024;
            }  
           if($sizeFiles > $sizeMax) {
               die('Общий размер файлов превышает 20 Мб. ');
           }
}
else {
    die('Нет файлов для загрузки!');
}
//-------------------------------------------------------------

$com = trim($_POST['com']);
$company = trim($_POST['company']);

// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Проверка количества записей
$sql = "SELECT * FROM requests WHERE email='".$email."' AND NOT(status_req = 'Аннулирована'  OR  status_req = 'Удовлетворена')";
$result = $conn->query($sql);
if ($result->num_rows > 9) {
    echo '<h2>Вы не можете создать более 10 заявок на техприсоединение.</h2>';
    die;
} 
//Создание новой заявки
$today = date("Y-m-d H:i:s");
$files = implode(", ", $_FILES["uploads"]["name"]);
$comentary= trim($_POST['comentary']);
$sql = "INSERT INTO requests (email, comentary, files, date_req, company) VALUES ('".$email."', '".$comentary."', '".$files."', '".$today."', '".$company."' )";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Выбор номера записи
$sql = "SELECT * FROM requests WHERE id = (SELECT MAX(id) FROM requests) AND email='".$email."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
    $id=$row['id'];
     $id_req = 'ТП-00'.$id;
} else {
    echo "0";
}
//Присвоить номер заявки
$sql = "UPDATE requests SET id_req = '".$id_req."' WHERE id='".$id."'";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// запись в лог
$events = 'upload_user';
$sql = "INSERT INTO log (date_event, events, coment, email, id_req) VALUES ('".$today."', '".$events."', '".$files."', '".$email."', '".$id_req."')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Получение данных о пользователе

$sql = "SELECT * FROM users WHERE email='".$email."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
    $company=$row['company'];
    $f_name = $row['f_name'];
    $s_name = $row['s_name'];

//Работа с файлами
$structure = "../users/{$email}/";
if (!file_exists($structure)) {
    mkdir($structure, 0777, true);
}
$structure = "../users/{$email}/{$id_req}/";
if (!file_exists($structure)) {
    mkdir($structure, 0777, true);
}



 if($_FILES)
{
    foreach ($_FILES["uploads"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["uploads"]["tmp_name"][$key];
            $soloName = $_FILES["uploads"]["name"][$key];
            $name = $structure.$soloName;
        // Проверка наличия файла    
            if (file_exists($name)) {
                die("Файл <b>$soloName</b> уже существует") ;                               
                }   
        // Проверка наличия файла end ----------------------------                                     
            move_uploaded_file($tmp_name, $name);  
            $mail->addAttachment($name);
            }                   
    }
            // echo 'Загрузка прошла успешно!'; 
            echo '<h2>Ваша заявка на техприсоединение создана.</h2><br><p class="repost">Вам на почту отправлено уведомление о создании заявки.<br>Вы можете при необходимости в Личном кабинете дополнить переданную вами информацию.<br>После  рассмотрения компанией ваших документов при отсутствии ошибок и замечаний статус вашей заявки изменится на «Принята в работу».<br>В случае, если вы дали согласие на уведомление об изменении статусов заявки, вам на почту придет сообщение, о том, что статус заявки изменен.<br>Вы всегда можете отменить или подтвердить возможность уведомления о смене статусов заявки в Профиле вашего личного кабинета.</p >';
}
else {
    die('Нет файлов для загрузки!');
}

        //------Отправляем письмо о создании новой заявки-------
$address_site = "https://parkind.ru/cabinet/";
$subject = "Информация с сайта ".$_SERVER['HTTP_HOST'];
$subject = "=?utf-8?B?".base64_encode($subject)."?=";

//Составляем тело сообщения
$message = 'Уважаемый (ая) '.$f_name.' '.$s_name.'!<br/> <br/>
Вами создана заявка № '.$id_req.' на техприсоединение к электрическим сетям.
После проверки направленных документов при отсутствии замечаний или ошибок заявка будет принята в работу.
Направленные документы всегда можно скачать в Личном кабинете на сайте www.parkind.ru
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
    if(!mail($email, $subject, $message, $headers)){
    echo 0;
    }
} else {
    echo "0";
}
// PhpMeiler-Письмо с вложениями исполнителю------------------------
 // Получатель письма
    $addMail1 = 'mipdz@yandex.ru';
    $addMail2 = 'servksk@yandex.ru';
    // $mail->addAddress('i2972347@icloud.com');  
    // $mail->addAddress('2972347@gmail.com'); // Ещё один, если нужен
// Формирование самого письма
$title = "Уведомление о новой заявке";
$body = "
<p>Заявителем $company создана заявка № $id_req на техприсоединение к электрическим сетям.<br>
К письму приложены направленные Заявителем документы.<br>
 В случае отсутствия замечаний или ошибок, измените статус заявки.<br>
Направленные документы всегда можно скачать в Личном кабинете на сайте www.parkind.ru<br>
Комментарий:  $comentary
</p>
<br>
<br>
<hr>
Письмо сформировано автоматическим сервисом Личный кабинет  ООО «Киришская сервисная компания». <br>
Вы получили его как зарегистрированный пользователь сайта www.parkind.ru.<br>
Данное письмо не требует ответа.
";

// Файлы настройки - послать письмо

require 'sendmail_setup.php';



$conn->close();

?>


