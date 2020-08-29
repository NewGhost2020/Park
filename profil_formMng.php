
 <?php include 'header_mng.php'; ?> 

<body onload="profilLoad();">
    <h2 class="title-company"></h2>
    <!-- Форма профиля ---------------------------------------->
    <div class="desk-form" id="desk-profile">
        <h1>Профиль</h1>
        <div class="form-wrap">
            <form action="core/profile.php" method="post" name="profile" id="profile">
                <div class="row-input">
                    <label for="f_name" class="label">Имя</label>
                    <input type="text" name="f_name" id="f_name" class="required" title="Введите своё имя">
                </div>
                <div class="row-input">
                    <label for="s_name" class="label">Отчество</label>
                    <input type="text" name="s_name" id="s_name" class="required" title="Введите своё Отчество">
                </div>
                <div class="row-input">
                    <label for="l_name" class="label">Фамилия</label>
                    <input type="text" name="l_name" id="l_name" class="required" title="Введите свою фамилию">
                </div>
                <div class="row-input">
                    <label for="company" class="label">Организация</label>
                    <textarea name="company" id="company-fix" readonly></textarea>
                </div>
                <div class="row-input">
                    <label for="phone" class="label">Телефон</label>
                    <input type="text" name="phone" id="phone" class="required" title="Введите свой телефон">
                </div>
                <div class="row-input">
                    <label for="email" class="label">Email</label>
                    <input name="email" type="text" readonly id="email-fix">
                </div>
                <!--<div class="row-input">-->
                <!--    <label for="dop_email" class="label">Второй Email</label>-->
                <!--    <input name="email" type="text" id="dop_email">-->
                <!--</div>-->
                <div class="row-input">
                    <h4><i>Здесь вы можете задать новый пароль</i></h4>
                </div>
                <div class="row-input">
                    <label for="password" class="label">Новый пароль</label>
                    <input name="password" type="password" id="password" title="Введите свой пароль">
                </div>
                <div class="row-input">
                    <label for="confirm_password" class="label">Повторите пароль</label>
                    <input name="confirm_password" type="password" id="confirm_password"
                        title="Подтвердите свой пароль">
                </div>
                <div class="row-input">
                    <h4><i>Подтвердите изменения действующим паролем</i></h4>
                    <input name="check_pass" id='check-pass' type="password">
                </div>
                <div class="row-input btn-reg">
                    <input type="submit" name="update_mng" id="update_mng" value="Изменить профиль">
                </div>
            </form>
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
    </div>
    <!-- Форма профиля end---------------------------------------->
     <?php include 'footer.php'; ?> 
