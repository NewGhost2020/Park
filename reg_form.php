
<?php include 'header_min.php'; ?>
<div class="desk-form" id="desk-reg">
    <h1>Регистрация</h1>
    <div class="form-wrap">
        <form action="core/reg.php" method="post" name="signup" id="signup">
            <div class="row-input">
                <label for="f_name" class="label">*Имя</label>
                <input type="text" maxlength="20" name="f_name" id="f_name" class="required" title="Введите своё имя">
            </div>
            <div class="row-input">
                <label for="s_name" class="label">*Отчество</label>
                <input type="text" maxlength="20" name="s_name" id="s_name" class="required" title="Введите своё Отчество">
            </div>
            <div class="row-input">
                <label for="l_name" class="label">*Фамилия</label>
                <input type="text" maxlength="20" name="l_name" id="l_name" class="required" title="Введите свою фамилию">
            </div>
            <div class="row-input">
                <label for="company" class="label">*Организация или ФИО Заявителя</label>
                <textarea name="company" id="company" class="required" title="Введите свою организацию"></textarea>
            </div>
            <div class="row-input">
                <p class = "text-com">В поле указывается сокращенное наименование компании или Фамилия И.О. физического лица, которые заявляются на получение услуги по техприсоединению</p>
            </div>
            <div class="row-input">
                <label for="phone" class="label">*Телефон</label>
                <input type="text" name="phone" id="phone" class="required" title="Введите свой телефон">
            </div>
            <div class="row-input">
                <label for="email" class="label">*Электронная почта</label>
                <input name="email" type="text" id="email" class="required" title="Введите свой email">
            </div>
            <div class="row-input">
                <label for="password" class="label">*Пароль</label>
                <input name="password" type="password" id="password" value="" class="required" title="Введите свой пароль">
            </div>
            <label id='put' class="error"></label>
             <div class="row-input">
                <p class = "text-com">Для пароля используйте не менее 8 символов, в том числе минимум одну заглавную букву, одну строчную и одну цифру!</p>
            </div>
            <div class="row-input">
                <label for="confirm_password" class="label">*Подтвердите пароль</label>
                <input name="confirm_password" type="password" id="confirm_password" class="required"
                    title="Подтвердите свой пароль">
            </div>
            <div class="row-input" id='check-row'>
                <input name="agree_data" type="checkbox" id="agree_data" class="required">
                <h5>*Согласен на обработку персональных данных</h5>
            </div>
            <div class="row-input">    
                <input name="agree_rules" type="checkbox" id="agree_rules" class="required">
                <h5><a href="https://yadi.sk/i/lfMS9THrexKT4w" target="_blank">*С Правилами использования личного кабинета для оформления заявки на техническое присоединение</a> ознакомлен.</h5>
            </div>
            <div class="row-input">                
                <input name="agree_mail" type="checkbox" id="agree_mail">
                <h5>Хочу получать уведомления  об изменениях статусов заявок на ТП</h5>
            </div>
            <h5 id='com'>Поля, отмеченные символом «*» – являются обязательными для заполнения.<br>
Нажимая на кнопку «Отправить», я подтверждаю, что ознакомился с <a href="https://yadi.sk/i/NCJcqkOntbUeJw" target="_blank">Политикой конфиденциальности ООО «Киришская сервисная компания»</a>  и даю согласие на обработку всех моих персональных данных, указанных в форме регистрации,  а также тех, что впоследствии будут передаваться мной через  личный кабинет.
</h5>
            <div class="row-input btn-reg">
                <input type="submit" name="reg" id="reg" value="Отправить">
                <!--<button class = 'cansel' id="start">Отмена</button>-->
                <button class='cansel' onclick="history.back(-2); return false;">Отмена</button>
            </div>
        </form>
    </div>
</div>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script src="js/main.js"></script>
    </body>

</html>
