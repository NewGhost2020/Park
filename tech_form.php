<?php include 'header_min.php' ?>
<div class="my-cont">
    <div class="desk-form" id="desk-reg">
        <h1>Техподдержка</h1>
        <div class="form-wrap tech_pod">
            <a href="https://yadi.sk/i/lfMS9THrexKT4w" target="_blank">Правила использования личного кабинета для оформления заявки на техническое присоединение</a><br>
        <a href="https://yadi.sk/i/NCJcqkOntbUeJw" target="_blank">Политика конфиденциальности ООО «Киришская сервисная компания»</a><br>
        <a href="https://yadi.sk/d/kAI22oXl3YGFsh/Информация%20подлежащая%20раскрытию/Технологическое%20присоединение%20(ТП)%20к%20сетям%20ООО%20КСК" target="_blank">Документы для оформления заявки</a><br>
        <h2>Задать вопрос</h2>
            <form action="" method="post" name="tech_sup" id="tech_sup">
                <div class="row-input">
                    <label for="f_name" class="label">*Имя</label>
                    <input type="text" maxlength="20" name="f_name" id="f_name" class="required"
                        title="Введите своё имя">
                </div>
                <div class="row-input">
                    <label for="email" class="label">*Электронная почта</label>
                    <input name="email" type="text" id="email" class="required" title="Введите свой email">
                </div>
                <div class="row-input">
                    <label for="phone" class="label">*Телефон</label>
                    <input type="text" name="phone" id="phone" class="required" title="Введите свой телефон">
                </div>
                <div class="row-input">
                    <label for="pregunta" class="label">*Вопрос</label>
                    <textarea name="pregunta" id="pregunta" class="required" title="Напишите свой вопрос"></textarea>
                </div>

                <h5 id='com'>(*) поля, обязательные для заполнения.</h5>
                <div class="row-input btn-reg">
                    <input type="submit" class='cansel' name="tech" id="tech" value="Отправить">
                    <button class='cansel' onclick="history.back(-2); return false;">Выйти</button>
                </div>
            </form>
        </div>
    </div>
</div>
   <?php include 'footer.php' ?>