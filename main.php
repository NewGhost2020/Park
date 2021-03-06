<?php include 'header.php'; ?>

<h2 class="title-company">Личный кабинет </h2>
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
                <textarea name="company" id="company" class="required" title="Введите свою организацию"></textarea>
            </div>
            <div class="row-input">
                <label for="phone" class="label">Телефон</label>
                <input type="text" name="phone" id="phone" class="required" title="Введите свой телефон">
            </div>
            <div class="row-input">
                <label for="email" class="label">Email</label>
                <input name="email" type="text" readonly id="email">
            </div>
            <div class="row-input">
                <label for="password" class="label">Пароль</label>
                <input name="password" type="password" id="password" class="required" title="Введите свой пароль">
            </div>
            <div class="row-input">
                <label for="confirm_password" class="label">Подтвердите пароль</label>
                <input name="confirm_password" type="password" id="confirm_password" class="required"
                    title="Подтвердите свой пароль">
            </div>
            <div class="row-input">
                <label for="agree_mail" class="label">Получать рассылку</label>
                <input name="agree_mail" type="checkbox" id="agree_mail">
            </div>
            <div class="row-input btn-reg">
                <input type="submit" name="update" id="update" value="Обновить">
            </div>
        </form>
    </div>
</div>
<!-- Форма профиля end---------------------------------------->
<?php include 'footer.php'; ?>