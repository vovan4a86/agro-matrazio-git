import $ from 'jquery';
import {showSuccessDialog} from "./popups";

export const sendAjax = (url, data, callback, type) => {
    data = data || {};
    if (typeof type == 'undefined') type = 'json';
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        dataType: type,
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (json) {
            if (typeof callback == 'function') {
                callback(json);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
            console.log(errorThrown);
        },
    });
}

export const sendFiles = (url, data, callback, type) => {
    if (typeof type == 'undefined') type = 'json';
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        cache: false,
        dataType: type,
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (json, textStatus, jqXHR) {
            if (typeof callback == 'function') {
                callback(json);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
        }
    });
}

export const resetForm = (form) => {
    $(form).trigger('reset');
    $(form).find('.err-msg-block').remove();
    $(form).find('.has-error').remove();
    $(form).find('.invalid').attr('title', '').removeClass('invalid');
}

// //Выбор города в попапе
$("body").on("click", ".cities-page__link", function(e) {
    e.preventDefault();
    const elem = $(this);
    const link = $('.cities-page__current_popup');
    const homeLink = link.data('home');
    const cur_url = link.data('current');
    const url = '/ajax/set-city';
    const city_id = $(elem).data('id');

    const data = {city_id}
    if (cur_url === homeLink + '/') {
        sendAjax(url, data, function (json) {
            if (typeof json.success !== 'undefined') {
                location.reload();
            }
        })
    } else {
        redirect_to_current_city(city_id, cur_url);
    }
});

export const redirect_to_current_city = (city_id, cur_url) => {
    sendAjax('/ajax/get-correct-region-link', {city_id, cur_url}, function (json) {
        if (typeof json.redirect != 'undefined') {
            location.href = json.redirect;
        }
    });
}

//Заказать звонок,  Вопрос, Заявка
export const sendForms = () => {
    $('#callback-popup form, #write-popup form, #order-popup form, #s-callback form').submit(function (e) {
        e.preventDefault();
        const form = $(this);
        const url = $(form).attr('action');
        const data = $(form).serialize();

        sendAjax(url, data, function (json) {
            if (json.success) {
                resetForm(form);
                showSuccessDialog({
                    'title': 'Ваша заявка отправлена!',
                    'text': 'Наши менеджеры свяжутся с Вами в ближайшее время.'
                });
                form.find('.is-close').click();
            }
            if (json.errors) {
                console.error(json.errors);
            }

        });
    })
}
sendForms();