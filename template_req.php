
         <div class="form-wrap">
            <p>Загрузите скан вашей оформленной заявки на техприсоединение, приложите к заявке сканы всех требуемых документов.<br> 
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
                <input type="hidden" id='req-id' value="<?php echo $id_req ; ?>">
                <h3 id="result"></h3>
                <div class="row-input my-btn">
                    <input type="submit" name="upload" id="upload-new" value="Отправить">
                    <button id="no">Отменить</button>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>