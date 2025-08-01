@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <!--section.product.page-->
        <section class="product page">
            <div class="product__container container">
                <div class="product__heading page__heading">
                    <h1 class="product__title page__title">{{ $h1 }}</h1>
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
                        @if($product->text_title)
                            <div class="product__heading page__heading">
                                <div class="product__title page__subtitle">{{ $product->text_title }}</div>
                            </div>
                        @endif
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
        @if($product->text_description)
            <section class="seo is-gray">
                <div class="seo__container container">
                    <div class="seo__text text-block">
                        {!! $product->text_description !!}
                    </div>
                </div>
            </section>
        @endif
        <!--section.s-about.-small-->
        <section class="s-about s-about--small">
            @include('blocks.features', ['title' => 'Преимущества работы с нами'])
        </section>
    </main>
    @include('blocks.callback')
@endsection
