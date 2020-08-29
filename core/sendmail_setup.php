
<?php
// Настройки PHPMailer

try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'admin@parkind.ru'; // Логин на почте
    $mail->Password   = 'AdminKSCnew'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('admin@parkind.ru', 'admin'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress($addMail1);  
    if($addMail2 !=="") {
    $mail->addAddress($addMail2);  
    }


// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";
    echo "Не отправлено";
}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
// echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);

// Настройки PhpMeiler-----end--------------------
?>