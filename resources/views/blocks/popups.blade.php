<div class="popup lazy" id="callback-popup" style="display: none" data-bg="/static/images/common/popup-bg.webp">
    <div class="popup__container">
        <div class="popup__head">
            <div class="popup__title">Заказать звонок</div>
        </div>
        <div class="popup__form">
            <!--form.b-form.-wide(action="#")-->
            <form class="b-form b-form--wide" action="{{ route('ajax.callback') }}">
                <div class="b-form__fields">
                    <input class="b-form__field" type="text" name="name" placeholder="Ваше имя *" required="required" />
                    <input class="b-form__field" type="tel" name="phone" placeholder="Телефон *" required="required" />
                    <button class="b-form__btn btn-reset" name="submit" aria-label="Заказать звонок">Заказать звонок</button>
                    <div class="b-form__policy">* Нажимая кнопку Отправить сообщение, вы соглашаетесь с
                        <a href="{{ url('policy') }}">Политикой конфиденциальности</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="popup lazy" id="write-popup" style="display: none" data-bg="/static/images/common/popup-bg.webp">
    <div class="popup__container">
        <div class="popup__head">
            <div class="popup__title">Если у Вас есть вопросы, напишите нам</div>
        </div>
        <div class="popup__form">
            <!--form.b-form.-wide(action="#")-->
            <form class="b-form b-form--wide" action="{{ route('ajax.write') }}">
                <div class="b-form__fields">
                    <input class="b-form__field" type="text" name="name" placeholder="Ваше имя *" required="required" />
                    <input class="b-form__field" type="tel" name="phone" placeholder="Телефон *" required="required" />
                    <textarea class="b-form__field" name="text" rows="3" placeholder="Сообщение"></textarea>
                    <button class="b-form__btn btn-reset" name="submit" aria-label="Отправить сообщение">Отправить сообщение
                    </button>
                    <div class="b-form__policy">* Нажимая кнопку Отправить сообщение, вы соглашаетесь с
                        <a href="{{ url('policy') }}">Политикой конфиденциальности</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="popup lazy" id="order-popup" style="display: none" data-bg="/static/images/common/popup-bg.webp">
    <div class="popup__container">
        <div class="popup__head">
            <div class="popup__title">Оставить заявку</div>
        </div>
        <div class="popup__form">
            <!--form.b-form.-wide(action="#")-->
            <form class="b-form b-form--wide" action="{{ route('ajax.order') }}">
                <div class="b-form__fields">
                    <input class="b-form__field" type="text" name="name" placeholder="Ваше имя *" required="required" />
                    <input class="b-form__field" type="tel" name="phone" placeholder="Телефон *" required="required" />
                    <textarea class="b-form__field" name="text" rows="3" placeholder="Сообщение"></textarea>
                    <button class="b-form__btn btn-reset" name="submit" aria-label="Отправить заявку">Отправить заявку
                    </button>
                    <div class="b-form__policy">* Нажимая кнопку Отправить сообщение, вы соглашаетесь с
                        <a href="{{ url('policy') }}">Политикой конфиденциальности</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="popup" id="complete-popup" style="display: none">
    <div class="popup__container">
        <div class="popup__head">
            <div class="popup__subtitle" data-popup-title="data-popup-title"></div>
            <div class="popup__text" data-popup-text="data-popup-text"></div>
        </div>
    </div>
</div>