@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <!--section.contacts.page-->
        <section class="contacts page">
            <div class="contacts__container container">
                <div class="contacts__heading page__heading">
                    <h1 class="contacts__title page__title">{{ $h1 }}</h1>
                </div>
                <div class="contacts__grid">
                    @if($contacts = S::get('contacts'))
                        <div class="contacts__body">
                            @if($contacts['address'])
                                <div class="contacts__item">
                                    <span class="contacts__icon">
                                        <svg class="svg-sprite-icon icon-pin" width="1em" height="1em">
                                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#pin"></use>
                                        </svg>
                                    </span>{{ $contacts['address'] }}
                                </div>
                            @endif
                            @if($contacts['email'])
                                <a class="contacts__item" href="mailto:{{ $contacts['email'] }}"
                                   title="отправить Email">
								<span class="contacts__icon">
									<svg class="svg-sprite-icon icon-mail" width="1em" height="1em">
										<use xlink:href="/static/images/sprite/symbol/sprite.svg#mail"></use>
									</svg>
								</span>zakaz@agrostal-komplekt.ru
                                </a>
                            @endif
                            @if($contacts['phone'])
                                <a class="contacts__item" href="tel:{{ SiteHelper::clearPhone(($contacts['phone'])) }}"
                                   title="Позвонить нам">
								<span class="contacts__icon">
									<svg class="svg-sprite-icon icon-phone" width="1em" height="1em">
										<use xlink:href="/static/images/sprite/symbol/sprite.svg#phone"></use>
									</svg>
								</span>{{ $contacts['phone'] }}
                                </a>
                            @endif
                            <div class="contacts__links">
                                @if($wa = S::get('soc_wa'))
                                    <a class="contacts__item" href="{{ $wa }}" title="Наш Whatsapp">
									<span class="contacts__icon">
										<svg class="svg-sprite-icon icon-wa" width="1em" height="1em">
											<use xlink:href="/static/images/sprite/symbol/sprite.svg#wa"></use>
										</svg>
									</span>Whatsapp
                                    </a>
                                @endif
                                @if($tg = S::get('soc_tg'))
                                    <a class="contacts__item" href="{{ $tg }}" title="Наш Telegram">
									<span class="contacts__icon">
										<svg class="svg-sprite-icon icon-tg" width="1em" height="1em">
											<use xlink:href="/static/images/sprite/symbol/sprite.svg#tg"></use>
										</svg>
									</span>Telegram</a>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="contacts__form">
                        <div class="contacts__bg lazy" data-bg="/static/images/common/contacts-bg.webp"></div>
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