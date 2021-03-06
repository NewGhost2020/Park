<?php
require_once 'config.php';
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();


$email= trim($_POST['email']);

if ($email ==''){
    echo 2;
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
$id_req = trim($_POST['id_req']);

// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//Работа с файлами

$structure = "../users/{$email}/{$id_req}/";

 if($_FILES)
{
    foreach ($_FILES["uploads"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["uploads"]["tmp_name"][$key];
            $soloName = $_FILES["uploads"]["name"][$key];
            $name = $structure.$soloName;
        // Проверка наличия файла    
            if (file_exists($name)) {
                die("Файл <b>$soloName</b> уже существует.<br>Пожалуйста, переименуйте файл и отправьте <b>ВСЕ</b> файлы ещё раз.") ;                               
                }   
        // Проверка наличия файла end ----------------------------                                     
            move_uploaded_file($tmp_name, $name);  
            $mail->addAttachment($name);
            }                   
    }
          
            echo '<h2>Документы по заявке № ' .$id_req. ' отправлены.</h2><br><p class="repost">Вам на почту направлено уведомление об отправке документов.<br><br>Для автоматического отслеживания  изменения статусов вашей заявки на странице редактирования  профиля  пользователя вы можете установить режим уведомления о смене статусов.</p >';
}
else {
    die('Нет файлов для загрузки!');
}
// запись в лог
$today = date("Y-m-d H:i:s");
$files = implode(" ", $_FILES["uploads"]["name"]);
$comentary= trim($_POST['comentary']);
$events = 'upload_user';
$sql = "INSERT INTO log (date_event, events, coment, email, id_req, comentary) VALUES ('".$today."', '".$events."', '".$files."', '".$email."', '".$id_req."', '".$comentary."')";

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


        //------Отправляем письмо Заявителю о создании новой заявки-------
$address_site = "https://parkind.ru/cabinet/";
$subject = "Информация с сайта ".$_SERVER['HTTP_HOST'];
$subject = "=?utf-8?B?".base64_encode($subject)."?=";

//Составляем тело сообщения
$message = 'Уважаемый (ая) '.$f_name.' '.$s_name.'!<br/> <br/>
Вами направлены документы по заявке  № '.$id_req.' на техприсоединение к электрическим сетям.<br>
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
$headers = "FROM: $email_admin\r\nContent-type: text/html; charset=utf-8\r\n";


 //Отправляем сообщение 
    if(!mail($email, $subject, $message, $headers)){
    echo 0;
    }
} else {
    echo "0";
}
// PhpMeiler-Письмо с вложениями исполнителю------------------------
 // Получатель письма
    // $addMail1 = 'i2972347@icloud.com';
    $addMail1 = 'mipdz@yandex.ru';
    $addMail2 = 'servksk@yandex.ru';

// Формирование самого письма
$title = "Уведомление о новой заявке";
$body = "
<p>Вам направлены документы по заявке № $id_req от $company на техприсоединение к электрическим сетям.<br>
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


