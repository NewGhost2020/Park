<?php include 'header_corto.php'; ?>
    <div class="desk-form" id="desk-login">
        <h1>Вход в личный кабинет</h1>
        <div class="form-wrap">
            <form action="core/login.php" method="post" name="login" id="login">
                <div class="row-input">
                    <label for="email" class="label">Email</label>
                    <input name="email" type="text" id="email" class="required" title="Введите свой email">
                </div>
                <div class="row-input">
                    <label for="password" class="label">Пароль</label>
                    <input name="password" type="password" id="password" class="required" title="Введите свой пароль">
                </div>
                <div class="row-input">
                    <input type="submit" class='cansel' name="enter" id="enter" value="Войти">
                    <button class='cansel'  id="site">Отменить</button>
                </div>
            </form>
            <div class="row-link">
                <a href="reg_form.php">Регистрация</a>
                <p>/</p>
                <a href="#" id="foget-pass">Забыли пароль?</a>
                <p>/</p>
                <a href="tech_form.php" id="return">Помощь (Вопрос)</a>
            </div>
            <div class="popup-fade2">
                <div id="popUp-check2">
                    <div class="pop-title">
                         <h4 class="mess">Укажите электронный адрес, который вы используете для входа в Личный кабинет.<br> На
                        данный адрес будет отправлен ваш текущий пароль.<br> Не показывайте и не передавайте пароль
                        посторонним лицам. <br>Изменить
                        пароль вы всегда можете в разделе Профиль пользователя.</h4>
                        <form action="" id="ch-pass">
                            <input name="email" type="email" id="email-conf" title="Введите свой email">
                        </form>
                    </div>
                    <div class="block-btn">
                        <button id="send-mail">Отправить</button>
                        <button id="esc">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="push"></div>
    </div>
    <footer class='my-footer'>
        <div class="connect">
            <div class="f-tel">
                <img src="img/Call-black.png" alt="">
                <a href="tel:+79110974264">
                    +7 (911) 097 42 64
                </a>
            </div>
            <div class="f-mail">
                <img src="img/Mail-black.png" alt="">
                <a href="mailto:servksk@yandex.ru">
                    servksk@yandex.ru
                </a>
            </div>
        </div>
        <p>© 2018-2020 Индустриальный парк "Левобережный"</p>
    </footer>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script src="js/detect.min.js"></script>
    <script src="js/main.js"></script>
    <script>

$(document).ready(function () {
    var user = detect.parse(navigator.userAgent);
    let userBrowser = user.browser.family;
    console.log(userBrowser);
    if (userBrowser == 'IE' || userBrowser == 'Edge') {
        alert('Личный кабинет ООО "КСК" не работает в браузерах EDGE и IE' );
        $(location).attr('href', 'https://parkind.ru'); 
    }
    let titleCompany = getCookie('company');
    $('.title-company').text('Личный кабинет ' + titleCompany);
    if(titleCompany) {
        waitTime();
    }
});
</script>
    </body>

</html>
    
    
    
    
    