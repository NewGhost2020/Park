<?php include 'header_mng.php' ?>
    <body onload="allreqLoadM();">
        <div class="allreq_cont">
        <h2 class="title-company"></h2>
        <div class="desk-form" id="desk-allreqM">
            <h1>Все заявки</h1>
            <div class="form-wrap">
            </div>
            <div class="out-req"></div>
             <!-- Вывод окна Сменить статус -->
    <div class="popup-fade">
        <div id="popUp">
            <h4 id="pop-title">Выберите новый статус заявки</h4>
            <div class="row-input">
                <!--<label id="st_n"><input id="st_1" type="radio" name="status" value="1">Удовлетворена</label>-->
                <input type="radio" class='radio' id="st_1" name="status" value="uno" checked>
                <label id='st_n'>Удовлетворена</label>
            </div>
            <div class="row-input">
                <label><input id="st_2" class='radio' type="radio" name="status" value="Аннулирована">Аннулирована</label>
                <!--<input type="radio" id="st_2" name="status" value="Анулирована">-->
                <!--<label for="st_2">Анулирована</label>-->
            </div>
            <div class="block-btn">
                <button id="change">Изменить</button>
                <button id="esc">Отмена</button>
            </div>
        </div>
    </div>
    <div class="popup-fade2">
                <div id="popUp-check2">
                    <div class="pop-title">
                    <h4>Пожалуйста, введите код, отправленный вам на почту</h4>
                    <input id='code-user' type="text" max="99999999">
                    </div>
                    <div class="block-btn">
                        <button id="vale">Подтвердить</button>
                        <button id="esc">Отмена</button>
                    </div>
                </div>
    </div>
</div>
  <div class="push"></div>
    </div>
<?php include 'footer.php'; ?>