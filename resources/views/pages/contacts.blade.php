@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <!--section.contacts.page-->
        <section class="contacts page">
            <div class="contacts__container container">
                <div class="contacts__heading page__heading">
                    <div class="contacts__title page__title">Контакты</div>
                </div>
                <div class="contacts__grid">
                    <div class="contacts__body">
                        <div class="contacts__item">
								<span class="contacts__icon">
									<svg class="svg-sprite-icon icon-pin" width="1em" height="1em">
										<use xlink:href="static/images/sprite/symbol/sprite.svg#pin"></use>
									</svg>
								</span>Екатеринбург, Ленина 1
                        </div>
                        <a class="contacts__item" href="mailto:zakaz@agrostal-komplekt.ru" title="отправить Email">
								<span class="contacts__icon">
									<svg class="svg-sprite-icon icon-mail" width="1em" height="1em">
										<use xlink:href="static/images/sprite/symbol/sprite.svg#mail"></use>
									</svg>
								</span>zakaz@agrostal-komplekt.ru</a>
                        <a class="contacts__item" href="tel:8800445566" title="Позвонить нам">
								<span class="contacts__icon">
									<svg class="svg-sprite-icon icon-phone" width="1em" height="1em">
										<use xlink:href="static/images/sprite/symbol/sprite.svg#phone"></use>
									</svg>
								</span>8 800 44-55-66</a>
                        <div class="contacts__links">
                            <a class="contacts__item" href="javascript:void(0)" title="Наш Whatsapp">
									<span class="contacts__icon">
										<svg class="svg-sprite-icon icon-wa" width="1em" height="1em">
											<use xlink:href="static/images/sprite/symbol/sprite.svg#wa"></use>
										</svg>
									</span>Whatsapp</a>
                            <a class="contacts__item" href="javascript:void(0)" title="Наш Telegram">
									<span class="contacts__icon">
										<svg class="svg-sprite-icon icon-tg" width="1em" height="1em">
											<use xlink:href="static/images/sprite/symbol/sprite.svg#tg"></use>
										</svg>
									</span>Telegram</a>
                        </div>
                    </div>
                    <div class="contacts__form">
                        <div class="contacts__bg lazy" data-bg="static/images/common/contacts-bg.webp"></div>
                        <div class="contacts__subtitle">Напишите нам</div>
                        <div class="contacts__fields">
                            <!--form.b-form.-wide(action="#")-->
                            <form class="b-form b-form--wide" action="#">
                                <div class="b-form__fields">
                                    <input class="b-form__field" type="text" name="name" placeholder="Ваше имя *"
                                           required="required"/>
                                    <input class="b-form__field" type="tel" name="phone" placeholder="Телефон *"
                                           required="required"/>
                                    <input class="b-form__field" type="text" name="email" placeholder="Email"/>
                                    <textarea class="b-form__field" name="message" rows="3"
                                              placeholder="Сообщение"></textarea>
                                    <div class="b-form__policy b-form__policy--white">* Нажимая кнопку Отправить
                                        сообщение, вы соглашаетесь с
                                        <a href="{{ url('policy') }}">Политикой конфиденциальности</a>
                                    </div>
                                    <button class="b-form__btn btn-reset" name="submit"
                                            aria-label="Отправить сообщение">Отправить сообщение
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection