
 <?php include 'header_mod.php'; ?> 

 <body onload="userProfilLoad();"> 
    <h2 class="title-company"></h2>
    <!-- Форма профиля ---------------------------------------->
    <div class="desk-form" id="desk-profile">
        <h1>Профиль</h1>
        <div class="form-wrap">
            <form action="" method="post" name="profile_mod" id="profile_mod">
                <div class="row-input">
                    <label for="f_name" class="label">Имя</label>
                    <input type="text" name="f_name" id="f_name">
                </div>
                <div class="row-input">
                    <label for="s_name" class="label">Отчество</label>
                    <input type="text" name="s_name" id="s_name">
                </div>
                <div class="row-input">
                    <label for="l_name" class="label">Фамилия</label>
                    <input type="text" name="l_name" id="l_name">
                </div>
                <div class="row-input">
                    <label for="company" class="label">Организация</label>
                    <textarea name="company" id="company"></textarea>
                </div>
                <div class="row-input">
                    <label for="phone" class="label">Телефон</label>
                    <input type="text" name="phone" id="phone">
                </div>
                <div class="row-input">
                    <label for="email" class="label">Email</label>
                    <input name="email" type="text" readonly id="email-fix">
                </div>
                <div class="row-input">
                    <label for="status" class="label">Статус</label>
                    <select name="status" id="status">
                    <option value="1">Заявитель</option>
                    <option value="2">Исполнитель</option>
                    <option value="3">Модератор</option>
                    </select>
                </div>
                <div class="row-input">  
                 <label for="bl_list" class="label">Блокировка аккаунта</label>
                 <input name="bl_list" type="checkbox" id="bl_list"> 
            </div>
                <div class="row-input">
                    <h4><i>Подтвердите изменения действующим паролем</i></h4>
                    <input name="check_pass" id='check-pass' type="password">
                </div>
                <div class="row-input btn-reg">
                    <input type="submit" name="update_mod" id="update_mod" value="Изменить профиль">
                    <button class='cansel' onclick="history.back(-2); return false;">Отмена</button>
                </div>
            </form>
                        <button id="del-prof">Удалить аккаунт</button>
                        <button class='cansel' id="log-prof">Логи</button>
                        <div class="popup-fade">
                <div id="popUp">
                    <h4 id="pop-title">Вы действительно хотите удалить этот аккаунт?</h4>
                    <div class="block-btn">
                        <button id="del_us">Удалить</button>
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
        <div class="get-log"></div>    
    </div>

    <!-- Форма профиля end---------------------------------------->
     <?php include 'footer.php'; ?> 
