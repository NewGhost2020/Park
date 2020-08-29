<?php 
session_start(); 

?>
<?php include 'header.php'; ?>
 <h2 class="title-company"></h2>
    <div class="desk-form" id="desk-newreq">
        <h1>Новая заявка</h1>
        <div class="form-wrap">
            <p>Загрузите вашу оформленную заявку на технологическое присоединение либо подписанную электронной подписью, либо в отсканированном виде, а также приложите к заявке сканы всех требуемых документов.<br> Бланки заявок и образцы документов можно просмотреть и скачать
           <a href="https://yadi.sk/d/kAI22oXl3YGFsh/Информация%20подлежащая%20раскрытию/Технологическое%20присоединение%20(ТП)%20к%20сетям%20ООО%20КСК" target="_blank"> здесь</a><br> 
Документы, содержащие более одной страницы, должны быть отсканированы в многостраничном формате *.pdf или *.tif.<br> 
Для удобства отправки вы можете поместить все файлы в архив *.rar или *.zip<br> 
Общий размер отправляемых файлов не должен превышать 20 Мб.<br> 
Общее количество отправляемых файлов не должно превышать 10-ти.<br> 
Вы можете сопроводить отправку документов комментарием не более 255 символов.<br> 
</p>
            <form action="core/newreq.php" method="post" name="newreq" id="newreq" enctype="multipart/form-data">
            <h2>Загрузите файлы</h2>
            <hr>
            <div class="upload-files-left">
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>    
            </div>
            <div class="upload-files-right">
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>
                <div class="row-input">
                    <input type="file" name='uploads[]' class="uploads">
                </div>    
            </div>
            <hr>                    
                <div class="row-input">     
                <label for="comentary" id='l-com' class="label">Комментарий</label>
                <textarea maxlength="255" name="comentary" id="comentary" title="Введите свой комментарий"></textarea>
                </div>
                <h3 id="result"></h3>
                <div class="row-input my-btn">
                    <input type="submit" name="upload" id="upload" value="Отправить">
                    <button class="cansel" id="no">Отменить</button>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>