<section class="s-callback">
    <div class="s-callback__bg lazy" data-bg="/static/images/common/callback-bg.webp"></div>
    <div class="s-callback__container container container--small">
        <div class="s-callback__grid">
            <div class="s-callback__body">
                <div class="s-callback__title">Если у Вас есть вопросы, напишите нам</div>
                <div class="s-callback__subtitle">мы с удовольствием ответим в ближайшее время</div>
                <div class="s-callback__policy">* Нажимая кнопку Отправить, вы соглашаетесь с
                    <a href="{{ url('policy') }}">Политикой конфиденциальности</a>
                </div>
            </div>
            <div class="s-callback__col">
                <form class="b-form" action="#">
                    <div class="b-form__fields">
                        <input class="b-form__field" type="text" name="name" placeholder="Ваше имя" required="required" />
                        <input class="b-form__field" type="tel" name="phone" placeholder="Телефон" required="required" />
                        <textarea class="b-form__field" name="message" rows="3" placeholder="Сообщение"></textarea>
                        <button class="b-form__btn btn-reset" name="submit" aria-label="Отправить сообщение">Отправить сообщение</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>