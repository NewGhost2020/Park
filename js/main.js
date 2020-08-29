//Main page -------------------------------------------
// $(document).ready(function () {
//     var user = detect.parse(navigator.userAgent);
//     let userBrowser = user.browser.family;
//     console.log(userBrowser);
//     if (userBrowser == 'IE' || userBrowser == 'Edge') {
//         alert('Личный кабинет ООО "КСК" не работает в браузерах EDGE и IE' );
//         $(location).attr('href', 'https://parkind.ru'); 
//     }
//     let titleCompany = getCookie('company');
//     $('.title-company').text('Личный кабинет ' + titleCompany);
//     if(titleCompany) {
//         waitTime();
//     }
// });

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// function checkBrowser() {
//     var user = detect.parse(navigator.userAgent);
//     let userBrowser = user.browser.family;
//     console.log(userBrowser);
//     if(userBrowser == 'IE' || userBrowser == 'Chrome') {
//         alert('Личный кабинет ООО "КСК" не работает в браузерах EDGE и IE' );
//         $(location).attr('href', 'https://parkind.ru'); 
//     }
// }
//Форма Регистрации  START  -------------------------------
$('#signup').validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            rangelength: [8, 16]
        },
        confirm_password: {
            equalTo: '#password'
        }
    }, // конец rules
    messages: {
        email: {
            required: "Введите свой email",
            email: "Неправильный адрес"
        },
        password: {
            required: "Введите пароль",
            rangelength: "Пароль должен содержать от 8 до 16 символов"
        },
        confirm_password: {
            equalTo: 'Пароли не совпадают'
        },
        agree_data: {
            required: "Подтвердите согласие"
        },
        agree_rules: {
            required: "Подтвердите согласие"
        }
    }
});
$("#phone").mask("+7(999) 999-99-99");
$('form#signup').submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post('core/reg.php', formData, processData);

    function processData(data) {
        if (data == '0') {
            alert('Такой логин уже существует');
        }
        else if (data == '1') {
            $('.form-wrap').html("<h4 class='success_message'><strong>Регистрация прошла успешно!!!</strong></h4><p class='success_message'> Теперь необходимо подтвердить введенный адрес электронной почты. Для этого, перейдите по ссылке, указанной в сообщении, которое вы получили на почту. Эту страницу можно теперь закрыть.</p>");
        }
    } // end processData
});
//Форма Регистрации  end  -------------------------------

//Форма Входа    start   -------------------------------

$('#login').validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            rangelength: [8, 16]
        }
    }, // конец rules
    messages: {
        email: {
            required: "Введите свой email",
            email: "Неправильный адрес"
        },
        password: {
            required: "Введите пароль",
            rangelength: "Пароль должен содержать от 8 до 16 символов"
        }
    }
});

$('#login').submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    if($.trim($('#email').val()) === '' || $.trim($('#password').val()) === '' ) {
        alert('Заполните все поля');
    } else {
    $.post('core/login.php', formData, processData);
    }
    function processData(data) {
        if (data === '0') {
            alert('Логин или пароль указан неправильно');
        }
        else if (data === '2') {
            alert('Поля заполнены неверно!');
        }
        else {
            // alert('Вы авторизованы!');
            setCookie(data);
            let row = JSON.parse(data);
            let typeUser = row.type_users;
            if (typeUser == '1') {
                $(location).attr('href', 'allreq_form.php');
            }
            else if (typeUser == '2') {
                $(location).attr('href', 'allreq_formM.php');
            }
            else if (typeUser == '3') {
                $(location).attr('href', 'allreq_formMod.php');
            }
            // console.log(typeUser);

        }
    } // end processData
    //Установка куки
    function setCookie(data) {
        let result = JSON.parse(data);
        var d = new Date();
        d.setTime(d.getTime() + (600 * 60 * 1000));
        var expires = d.toUTCString();
        document.cookie = `email=${result.email}; expires=${expires}; path=/`;
        document.cookie = `company=${result.company}; expires=${expires}; path=/`;
        document.cookie = `password=${result.password}; expires=${expires}; path=/`;
        location.href = "login.php";
    } // end setCookie
});
$('#site').click(function (e) {
    e.preventDefault();
    $(location).attr('href', 'https://parkind.ru');
});
//Форма Входа    end ------------------------------------------

//Форма Профиль    start ------------------------------------------

$('#profile').validate({
    rules: {
        password: {
            rangelength: [8, 16]
        },
        confirm_password: {
            equalTo: '#password'
        }
    }, // конец rules
    messages: {
        password: {
            required: "Введите пароль",
            rangelength: "Пароль должен содержать от 8 до 16 символов"
        },
        confirm_password: {
            equalTo: 'Пароли не совпадают'
        }
    }
});

function profilLoad() {
    // Получить данные из куки
    let userEmail = getCookie('email');
    if(!userEmail) {
        $(location).attr('href', "index.php");
    }
    $.post('core/get_user_data.php', { "email": userEmail }, getUserData);

    function getUserData(result) {
        result = JSON.parse(result);
        $('#f_name').val(result.f_name);
        $('#s_name').val(result.s_name);
        $('#l_name').val(result.l_name);
        $('#company-fix').val(result.company);
        $('#phone').val(result.phone);
        $('#email-fix').val(result.email);
        // let myPassword = $('#password').val(result.password);

        result.m_status == 1 ? $('#agree_mail').prop('checked', true) : $('#agree_mail').prop('checked', false);
    }
}

//------------------------ Обновление данных --------------------------------------
$('form#profile').submit(function (e) {
    e.preventDefault();
    let checkPass = $('#check-pass').val();
    let userPass = getCookie('password');
    if (checkPass == userPass) { // пароль совпадает
        let formPass = $('#password').val();
        if ($.trim(formPass) === '') {
            $('#password').val(userPass);
        }
        var formData = $(this).serialize();
        $.post('core/update_user_data.php', formData, updateUserData);
    } else {
        alert('Пароль не верен');
    }


    function updateUserData(result) {
        if (result == 1) {
            alert('Данные успешно обновлены!');
        }
        else {
            alert('ошибка обновления');
        }
    }
});
//---Удаление профиля
$('#del-prof').click(function () {
    $('.popup-fade').fadeIn();
    return false;
});

$('.block-btn').on('click', '#esc', function () {
    $(this).parents('.popup-fade').fadeOut();
    $(this).parents('.popup-fade2').fadeOut(function () {
        location.reload();  // нужна перезагрузка
    });
    return false;
});

$(document).keydown(function (e) {
    if (e.keyCode === 27) {
        e.stopPropagation();
        $('.popup-fade').fadeOut();
    }
});
$('.popup-fade').click(function (e) {
    if ($(e.target).closest('#popUp').length === 0) {
        $(this).fadeOut();
    }
});
$('#del').one('click', function () {
    let userEmail = getCookie('email');
    $.post('core/delprof.php', { "email": userEmail }, delProfData);
    function delProfData(result) {
        if (result == 0) {
            $('#pop-title').html('Вы не можете удалить профиль во время выполнения заявки');
            $('.block-btn').html('<button id="esc">Отмена</button>');
            $('#del-prof').off('click');
        }
        else {
            $('.popup-fade').fadeOut();
            $('.popup-fade2').fadeIn();
            setTimeout(timeEnd, 60000);
            checkCode(result, userEmail);
        }
    }
});
function timeEnd() {
    $('.pop-title').html('<h4>Истекло время для ввода пароля</h4><br><br><p>Время действия вашего пароля истекло, для отправки нового пароля повторите процедуру отправки временного пароля. Для этого вернитесь на предыдущую страницу.</p>');
    $('.block-btn').html('<button id="esc">Вернуться</button>');

}
function checkCode(result, userEmail) {
    $('#vale').click(function () {
        let codeUser = $('#code-user').val();
        if ($.trim(codeUser) !== $.trim(result)) {
            alert('Код   не верен');
        } else {
            // alert ('Ваш профиль удалён');
            $('.popup-fade2').fadeOut();
            $.post('core/delprof_base.php', { "email": userEmail }, delProfUser);
        }
        function delProfUser(data) {
            //   alert(data);
            alert('Ваш профиль удалён');
            $(location).attr('href', 'https://parkind.ru/');
        }
    })
}
// Форма Профиль end -----------------

//Форма Новая заявка ------------------ 
$('form#newreq').validate({
    rules: {
        comentary: {
            maxlength: 255
        }
    }, // конец rules
    messages: {
        comentary: {
            maxlength: "Комментарий не должен превышать 255 символов"
        }
    }
});
// ------------Отправка на сервер 

// Новая заявка ------------
$("#upload").click(function (event) {
    let userEmail = getCookie('email');
    let userCompany = getCookie('company');
    event.preventDefault();
// Проверка на тип и размер--------------------------------
    var up = $('.uploads');
    var fileTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    let fileSize = 0;
    let SizeMax = 20 * 1024 * 1024;
    up.each(function (index, $file) {
        fileUp = $file.files[0];
        if (fileUp) {
            fileSize += fileUp.size;
            //проверка типа данных
            // let fileType = fileUp.type;
            // if (fileTypes.indexOf(fileType) === -1) {
            //     alert('Тип данных не соответствует');
            // }
        }
    })
    if (fileSize > SizeMax) {
        alert('Общий размер файлов превышает 20 Мб.');
        $('.uploads').val('');
        return false;
    } else if (fileSize == 0) {
        alert('Не загружен ни один документ');
    }
//-------------Конец проверки--------------------------------------
    var form = $('form#newreq')[0];
    var data = new FormData(form);
    let com = form[10].value;
    //If you want to add an extra field for the FormData
    data.append("email", userEmail);
    data.append("com", com);
    data.append("company", userCompany);
    //disabled the submit button
    $("#upload").prop("disabled", true);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "core/newreq.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            $(".desk-form").html(data);
            $("#upload").prop("disabled", false);
        },
        error: function (e) {
            $("#result").text(e.responseText);
            $("#upload").prop("disabled", false);
        }
    });

});
// Добавить к заявке user------------
$("#upload-new").click(function (event) {
    let userEmail = getCookie('email');
    let userCompany = getCookie('company');
    let idReq = $('#req-id').val();
    event.preventDefault();
    if ($("input:file").val() === '') {
        alert('Не загружен ни один документ');
        return false;
    }
    // console.log($("input:file").size);
    //Get form
    var form = $('form#newreq')[0];

    //Create an FormData object
    var data = new FormData(form);

    // console.log(form[0].value);
    let com = form[10].value;
    //If you want to add an extra field for the FormData
    data.append("email", userEmail);
    data.append("com", com);
    data.append("company", userCompany);
    data.append("id_req", idReq);
    //disabled the submit button
    $("#upload-new").prop("disabled", true);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "core/addreq.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            // $("#result").html(data);
            $(".desk-form").html(data);
            $(".uploads").val('');
            // console.log("SUCCESS : ", data);
            $("#upload-new").prop("disabled", false);
        },
        error: function (e) {
            $("#result").text(e.responseText);
            // console.log("ERROR : ", e);
            $("#upload-new").prop("disabled", false);
        }
    });

});
// Добавить к заявке menager------------
$("#upload-newMng").click(function (event) {
    let userEmail = getCookie('email');
    let userCompany = getCookie('company');
    let idReq = $('#req-id').val();
    event.preventDefault();
    if ($("input:file").val() === '') {
        alert('Не загружен ни один документ');
        return false;
    }

    var form = $('form#newreq')[0];

    var data = new FormData(form);

    let com = form[10].value;
    //If you want to add an extra field for the FormData
    data.append("email", userEmail);
    data.append("com", com);
    data.append("company", userCompany);
    data.append("id_req", idReq);
    //disabled the submit button
    $("#upload-newMng").prop("disabled", true);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "core/addreqMng.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            $(".desk-form").html(data);
            $(".uploads").val('');
            // console.log("SUCCESS : ", data);
            $("#upload-newMng").prop("disabled", false);
        },
        error: function (e) {
            $("#result").text(e.responseText);
            // console.log("ERROR : ", e);
            $("#upload-newMng").prop("disabled", false);
        }
    });

});
$('#no').click(function (event) {
    event.preventDefault();
    location.reload(true);
})
//Страничка Все заявки

function allreqLoad() {
    let userEmail = getCookie('email');
     if(!userEmail) {
        $(location).attr('href', "index.php");
    }
    $.post('core/allreq.php', { "email": userEmail }, allReqData);
}
function allReqData(result) {
    $('.form-wrap').html(result);
}
// Вывод по номеру
$('.desk-form').on('click', '.id-req', function () {
    let userEmail = getCookie('email');
    let idReqQ = $(this).html();
    $.post('core/idreq.php', { 'id_req': idReqQ, "email": userEmail }, idReqData);

    function idReqData(result) {
        $('.out-req').html(result);
        // Кнопка добавить 
        $('.desk-form').on('click', '#add-files', function () {
            $(location).attr('href', "addreq_form.php?id_req=" + idReqQ);
        })
    }
});




// -----------------Восстановление пароля---------
$('#foget-pass').click(function () {
    $('.popup-fade2').fadeIn();
    return false;
})

$('#ch-pass').validate({
    rules: {
        email: {
            required: true,
            email: true
        }
    }, // конец rules
    messages: {
        email: {
            required: "Введите свой email",
            email: "Ошибка в электронной почте"
        }
    }
});
$('#send-mail').click(function () {
    let userEmail = $('#email-conf').val();
    if($.trim(userEmail) == '') {
        alert('Введите свой email');
    } else {
    $.post('core/change_pass.php', { "email": userEmail }, chPassData);
    }
    function chPassData(data) {
        if (data == 0) {
            alert('Пользователь с указанным электронным адресом не зарегистрирован');
        } else {
            alert('Пароль отправлен');
            $('.popup-fade2').fadeOut();
        }
    }
})
// ==============================Исполнитель=====================
//Страничка Все заявки

function allreqLoadM() {
    let userEmail = getCookie('email');
     if(!userEmail) {
        $(location).attr('href', "index.php");
    }
    $.post('core/allreqM.php', { "email": userEmail }, allReqDataM);
}
function allReqDataM(result) {
    $('.form-wrap').html(result);
}
// Вывод по номеру id Mng
$('.desk-form').on('click', '.id-reqMng', function () {
    let userEmail = getCookie('email');
    let idReqQ = $(this).html();
    $.post('core/idreqMng.php', { 'id_req': idReqQ, "email": userEmail }, idReqData);

    function idReqData(result) {
        $('.out-req').html(result);
        // Кнопка добавить 
        $('.desk-form').on('click', '#add-filesMng', function () {
            $(location).attr('href', "addreq_formMng.php?id_req=" + idReqQ);
        })
    }

    //Сменить статус
    $('.desk-form').on('click', '#ch-status', function () {
        let old_status = $('#sr').html();
        $('.popup-fade').fadeIn();

        let n_status = setStatus(old_status);
        // console.log(n_status);
        $('#st_n').text(n_status);
        $('#st_1').val(n_status);
        return false;
    }) // end ch-status

$('#change').one('click', function () {
        var setStat = $('input[name="status"]:checked').val();
        let userEmail = getCookie('email');
        $.post('core/check.php', { "email": userEmail, "id_req": idReqQ }, checkData);
        
        function checkData(data) {
            if (data != 0) {
                $('.popup-fade').fadeOut();
                $('.popup-fade2').fadeIn();
                setTimeout(timeEnd, 60000);
                checkCodeStat(data, userEmail);
            } else { alert('Error'); }
        } //checkData
        
        function checkCodeStat(result, userEmail) {
            $('#vale').click(function () {
                let codeUser = $('#code-user').val();
                if ($.trim(codeUser) !== $.trim(result)) {
                    alert('Код   не верен');
                } else {
                    $('#code-user').val('');
                    $('.popup-fade2').fadeOut();
                    let n_status = $('#st_1').val();
                    $.post('core/change_stat.php', { "email": userEmail, "id_req": idReqQ, "n_status": setStat }, changeStat);
                }
              function changeStat(data)  {
                  if(data ==1) {
                      alert('Статус изменён');
                      location.reload();
                  } 
              }
            }) //end click #vale
        } // end checkCodeStat
}) // end change

}); // ВЫвод по номеру



function setStatus(old_status) {
    var status = ['Создана',
        'В работе',
        'Выполнение',
        'Удовлетворена',
        'Аннулирована'];
    let statusSet = '';
    let st;

    $.each(status, function (index, value) {

        if (value == $.trim(old_status)) {
            if (index == 4) {
                st = index;
                return false;
            }
            else {
                index++;
                st = index;
                return false;
            }
        }
    })
    return status[st];
}

// Сортировка по названию организации
$('.desk-form').on('click', '#title_company', function () {
    $title = 1;
    $.post('core/output.php', { "title": $title }, outputData);
    function outputData(result) {
        $('.form-wrap').html(result);
    }
})
// Сортировка по статусу
$('.desk-form').on('click', '#title_status', function () {
    $title = 2;
    $.post('core/output.php', { "title": $title }, outputData);
    function outputData(result) {
        $('.form-wrap').html(result);
    }
})
// Сортировка по дате
$('.desk-form').on('click', '#title_date', function () {
    $title = 0;
    $.post('core/output.php', { "title": $title }, outputData);
    function outputData(result) {
        $('.form-wrap').html(result);
    }
})
// Сортировка по id_req
$('.desk-form').on('click', '#title_req', function () {
    $title = 3;
    $.post('core/output.php', { "title": $title }, outputData);
    function outputData(result) {
        $('.form-wrap').html(result);
    }
})

// Техподдержка
$('#tech_sup').submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post('core/tech.php', formData, processData);

    function processData(data) {
        if (data === '0') {
            alert('Не сложилось');
        }
        else {
            //здесь проверка через почту
             $('.form-wrap').html("<h4 class='success_message'><strong>Ваше сообщение отправлено!!!</strong></h4><p class='success_message'>В ближайшее время Вы получите ответ на Вашу электронную почту.</p><br><button class='cansel' onclick='history.back(-2); return false;'>Назад</button>");  }
    } // end processData
});
//Валидация пароля
$('input[type="password"]').change(function () {
    let pass = $('#password').val();
    if (!checkPassword(pass)) {
        $('#put').html('Пароль не соответствует требованиям');
    } else {
        $('#put').html('');
    }
})

function checkPassword(form) {
    // var password = form.password.value; // Получаем пароль из формы
    var password = form;
    var s_letters = "qwertyuiopasdfghjklzxcvbnm"; // Буквы в нижнем регистре
    var b_letters = "QWERTYUIOPLKJHGFDSAZXCVBNM"; // Буквы в верхнем регистре
    var digits = "0123456789"; // Цифры
    var specials = "!@#$%^&*()_-+=\|/.,:;[]{}"; // Спецсимволы
    var is_s = false; // Есть ли в пароле буквы в нижнем регистре
    var is_b = false; // Есть ли в пароле буквы в верхнем регистре
    var is_d = false; // Есть ли в пароле цифры
    // var is_sp = false; // Есть ли в пароле спецсимволы
    for (var i = 0; i < password.length; i++) {
        /* Проверяем каждый символ пароля на принадлежность к тому или иному типу */
        if (!is_s && s_letters.indexOf(password[i]) != -1) is_s = true;
        else if (!is_b && b_letters.indexOf(password[i]) != -1) is_b = true;
        else if (!is_d && digits.indexOf(password[i]) != -1) is_d = true;
        // else if (!is_sp && specials.indexOf(password[i]) != -1) is_sp = true;
    }
    if (is_s && is_b && is_d) {
        return true;
    }
    return false; // Форму не отправляем
}


// ==============================Модератор=====================
//Страничка Все заявки

function allreqLoadMod() {
    let userEmail = getCookie('email');
     if(!userEmail) {
        $(location).attr('href', "index.php");
    }
    $.post('core/allreqMod.php', { "email": userEmail }, allReqDataM);
}
function allReqDataM(result) {
    $('.form-wrap').html(result);
}
// Вывод по номеру id Mod
$('.desk-form').on('click', '.id-reqMod', function () {
    let userEmail = getCookie('email');
    let idReqQ = $(this).html();
    $.post('core/idreqMod.php', { 'id_req': idReqQ, "email": userEmail }, idReqData);

    function idReqData(result) {
        $('.out-req').html(result);
    }
}); // ВЫвод по номеру


//----------------------Страница профили-----------------
function allProfilLoad() {
    let userEmail = getCookie('email');
     if(!userEmail) {
        $(location).attr('href', "index.php");
    }
    $.post('core/allprof.php', { "email": userEmail }, allProfData);
}

function allProfData(result) {
    $('.form-wrap').html(result);
}
// Вывод по названию организации
$('.desk-form').on('click', '.prof_us_email', function () {
    let userProfEmail = $(this).html();
    document.cookie = `userEmail=${userProfEmail}`;
    $(location).attr('href', "profil_formMod.php");
})
function userProfilLoad() {
    let userEmail = getCookie('userEmail');
    $.post('core/get_user_data.php', { "email": userEmail }, getUserData);

    function getUserData(result) {
        result = JSON.parse(result);
        $('#f_name').val(result.f_name);
        $('#s_name').val(result.s_name);
        $('#l_name').val(result.l_name);
        $('#company').val(result.company);
        $('#phone').val(result.phone);
        $('#email-fix').val(result.email);
        $('#password').val(result.password);
        $('#status').val(result.type_users);
        result.bl_list == 1 ? $('#bl_list').prop('checked', true) : $('#bl_list').prop('checked', false);
    }
}

//------------------------ Изменение профиля --------------------------------------
$('form#profile_mod').submit(function (e) {
    e.preventDefault();
    let checkPass = $('#check-pass').val();
    let userPass = getCookie('password');
    if (checkPass == userPass) { // пароль совпадает
        let formPass = $('#password').val();
        if ($.trim(formPass) === '') {
            $('#password').val(userPass);
        }
        var formData = $(this).serialize();
        $.post('core/update_profil.php', formData, updateProfil);
    } else {
        alert('Пароль не верен');
    }


    function updateProfil(result) {
        if (result == 1) {
            alert('Данные успешно обновлены!');
        }
        else {
            alert('ошибка обновления');
        }
    }
});

//Удаление аккаунта
$('#del_us').one('click', function () {
   let userEmail = $('#email-fix').val();
   let modEmail = getCookie('email');
    $.post('core/delprof_us.php', { "email": userEmail, "mod_email": modEmail }, delProfData);
    function delProfData(result) {
        if (result == 0) {
            $('#pop-title').html('Вы не можете удалить профиль во время выполнения заявки');
            $('.block-btn').html('<button id="esc">Отмена</button>');
            $('#del_us').off('click');
        }
        else {
            $('.popup-fade').fadeOut();
            $('.popup-fade2').fadeIn();
            setTimeout(timeEnd, 60000);
            checkCodeUs(result, userEmail);
        }
    }
});

function checkCodeUs(result, userEmail) {
    $('#vale').click(function () {
        let codeUser = $('#code-user').val();
        if ($.trim(codeUser) !== $.trim(result)) {
            alert('Код   не верен');
        } else {
            $('.popup-fade2').fadeOut();
            $.post('core/delprof_base.php', { "email": userEmail }, delProfUs);
        }
        function delProfUs(data) {
            //   alert(data);
            alert('Аккаунт удалён');
            $(location).attr('href', 'allprofil_form.php');
        }
    })
}
// ------Вывод Логов----------------------
$('#log-prof').click(function(){
    let userEmail = getCookie('userEmail');
    $.post('core/log_profil.php', { "email": userEmail }, getLog);
    function getLog(result) {
        $('.get-log').html(result);
    }
})
// -------------------Модератор-------конец-------------

$('#burger').on('click', function () {

    $('.nav-is').slideToggle(300, function () {

        if ($(this).css('display') === "none") {
            $(this).removeAttr('style');
        }
    });
});
// Таймер бездействия
function waitTime() {
    idleTimer = null;
    idleState = false; // состояние отсутствия
    idleWait = 300000; // время ожидания в мс. (1/1000 секунды)
    $(document).bind('mousemove keydown scroll', function () {
        clearTimeout(idleTimer); // отменяем прежний временной отрезок
        if (idleState == true) {
            // Действия на возвращение пользователя
            // $("body").append("<p>С возвращением!</p>");
            alert('С возвращением!');
        }
        idleState = false;
        idleTimer = setTimeout(function () {
            alert('Вы отсутствовали более чем 15 минут. Авторизуйтесь заново.');
            deleteMyCookie();
            window.open('index.php', '_self');
            idleState = true;
        }, idleWait);
    });
}
function deleteMyCookie() {
            document.cookie = `email=0; max-age=-1; path=/`;
            document.cookie = `password=0; max-age=-1; path=/`;
            document.cookie = `company=0; max-age=-1; path=/`;
}
$('#exit').click(function() {
    event.preventDefault();
    deleteMyCookie();
    $(location).attr('href', "https://parkind.ru");
})
//    Проверка на авторизацию
function checkLoad() {
    let userEmail = getCookie('email');
    if(!userEmail) {
        $(location).attr('href', "index.php");
    }
}
    
    