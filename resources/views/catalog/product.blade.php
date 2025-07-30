@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <!--section.product.page-->
        <section class="product page">
            <div class="product__container container">
                <div class="product__heading page__heading">
                    <div class="product__title page__title">{{ $h1 }}</div>
                </div>
                <div class="product__grid">
                    <div class="product__slider">
                        <!--.slider.splide(aria-label=title data-product-slider)-->
                        <div class="slider splide" aria-label="{{ $product->name }}"
                             data-product-slider="data-product-slider">
                            <div class="slider__track splide__track">
									<span class="slider__icon">
										<svg class="svg-sprite-icon icon-zoom" width="1em" height="1em">
											<use xlink:href="/static/images/sprite/symbol/sprite.svg#zoom"></use>
										</svg>
									</span>
                                <ul class="slider__list splide__list">
                                    @foreach($images as $image)
                                        <li class="slider__slide splide__slide">
                                            <a class="slider__link" href="{{ $image->image_src }}"
                                               data-fancybox="product-gallery" data-caption="{{ $product->name }}"
                                               title="{{ $product->name }}">
                                                <img class="slider__img" src="{{ $image->thumb(3) }}" width="407"
                                                     height="407" alt="{{ $product->name }}" loading="lazy"/>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="slider__nav">
                                <div class="slider__arrows splide__arrows">
                                    <button class="slider__arrow splide__arrow splide__arrow--prev btn-reset"
                                            type="button" aria-label="Предыдущий слайд">
                                        <svg class="svg-sprite-icon icon-caret-right--small" width="1em" height="1em">
                                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret-right--small"></use>
                                        </svg>
                                    </button>
                                    <button class="slider__arrow splide__arrow splide__arrow--next btn-reset"
                                            type="button" aria-label="Следующий слайд">
                                        <svg class="svg-sprite-icon icon-caret-right--small" width="1em" height="1em">
                                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret-right--small"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="slider__pagination splide__pagination"></div>
                        </div>
                    </div>
                    <div class="product__body">
                        <div class="product__heading page__heading">
                            <div class="product__title page__subtitle">Cow mattress type 1</div>
                        </div>
                        @if($text)
                            <div class="product__text text-block">
                                {!! $text !!}
                            </div>
                        @endif
                        @if(count($params))
                            <div class="product__data">
                                <!--.data-->
                                <div class="data">
                                    <div class="data__title">Характеристики</div>
                                    @foreach($params as $param)
                                        <dl class="data__list">
                                            <dt class="data__key">{{ $param->name }}</dt>
                                            <dd class="data__value">{{ $param->value }}</dd>
                                        </dl>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="product__actions">
                            <button class="button button--light btn-reset" type="button" data-popup="data-popup"
                                    data-src="#order-popup" aria-label="Оставить заявку">
                                <svg class="svg-sprite-icon icon-badge" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#badge"></use>
                                </svg>
                                Оставить заявку
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--section.seo.is-gray-->
        <section class="seo is-gray">
            <div class="seo__container container">
                <div class="seo__text text-block">
                    <p>
                        <strong>Мы долгие годы сотрудничаем с проектными организациями и производителями стальных
                            каркасов для коровников.</strong>&nbsp; При обращении к нам, мы заложим на этапе
                        проектирования стойловое оборудование производства «Завода Агросталь».</p>
                    <p>Вы получите каркас по цене завода изготовителя с готовой планировкой стойлового оборудования,
                        понятным качеством и сроками поставки. Это позволит сэкономить ваши средства и время при
                        проектировании, монтаже и вводе в эксплуатацию объекта.</p>
                </div>
            </div>
        </section>
        <!--section.s-about.-small-->
        <section class="s-about s-about--small">
            <div class="s-about__bottom">
                <div class="s-about__container container">
                    <div class="s-about__heading page__heading">
                        <div class="s-about__title page__title">Преимущества работы с нами</div>
                    </div>
                    <div class="s-about__feats">
                        <!--.feat-item-->
                        <div class="feat-item">
                            <div class="feat-item__view">
                                <div class="feat-item__icon lazy" data-bg="/static/images/common/feat-icon-1.svg"></div>
                            </div>
                            <div class="feat-item__title">Комплексный подход</div>
                        </div>
                        <!--.feat-item-->
                        <div class="feat-item">
                            <div class="feat-item__view">
                                <div class="feat-item__icon lazy" data-bg="/static/images/common/feat-icon-2.svg"></div>
                            </div>
                            <div class="feat-item__title">Опыт с 2008 года</div>
                        </div>
                        <!--.feat-item-->
                        <div class="feat-item">
                            <div class="feat-item__view">
                                <div class="feat-item__icon lazy" data-bg="/static/images/common/feat-icon-3.svg"></div>
                            </div>
                            <div class="feat-item__title">Высокое качество продукции</div>
                        </div>
                        <!--.feat-item-->
                        <div class="feat-item">
                            <div class="feat-item__view">
                                <div class="feat-item__icon lazy" data-bg="/static/images/common/feat-icon-4.svg"></div>
                            </div>
                            <div class="feat-item__title">Сотни довольных клиентов</div>
                        </div>
                    </div>
                    <div class="s-about__brand">
                        <!--+brand-label()(class="brand-label--small")-->
                        <!--.brand-label-->
                        <div class="brand-label brand-label--small">
                            <span class="brand-label__title">В комплекте всегда выгоднее!</span>
                            <img class="brand-label__img no-select" src="/static/images/common/brand-label.svg"
                                 width="168" height="57" alt="alt" loading="lazy"/>
                        </div>
                    </div>
                </div>
                <img class="s-about__decor no-select" src="/static/images/common/about-decor.png" width="410"
                     height="507" loading="lazy" alt="Агросталь-Комплект"/>
            </div>
        </section>
    </main>
    @include('blocks.callback')
@endsection
