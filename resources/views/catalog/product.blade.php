@extends('template')
@section('content')
    <div class="layout body-content">
        @include('blocks.bread')
        <div class="layout__container layout__container--column">
            <div class="layout__heading container">
                <div class="title title--small">{{ $h1 }}</div>
            </div>
            <main class="layout__body">
                <!--.product-->
                <div class="product container">
                    <div class="product__grid">
                        <div class="product__col">
                            @if(count($images))
                                <div class="product__sliders">
                                    <div class="product__slider-prod swiper" data-product-slider="data-product-slider">
                                        <div class="product__slider-wrapper swiper-wrapper">
                                            @foreach($images as $image)
                                                <a class="product__slide swiper-slide" href="{{ $image->image_src }}"
                                                   data-fancybox="data-fancybox" title="{{ $product->name }}">
                                                    <img class="product__view" src="{{ $image->thumb(4) }}" width="639"
                                                         height="527" alt="{{ $product->name }}" loading="lazy"/>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="product__slider-nav swiper" data-product-nav="data-product-nav">
                                        <div class="product__slider-wrapper swiper-wrapper">
                                            @foreach($images as $image)
                                                <div class="product__slide swiper-slide">
                                                    <img class="product__thumb" src="{{ $image->thumb(3) }}" width="131"
                                                         height="87" alt="{{ $product->name }}" loading="lazy"/>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @elseif($image)
                                <div class="product__sliders">
                                    <div class="product__slider-prod swiper" data-product-slider="data-product-slider">
                                        <div class="product__slider-wrapper swiper-wrapper">
                                            <a class="product__slide swiper-slide" href="{{ $image }}"
                                               data-fancybox="data-fancybox" title="{{ $product->name }}">
                                                <img class="product__view" src="{{ $product->catalog->thumb(4) }}" width="639"
                                                     height="527" alt="{{ $product->name }}" loading="lazy"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product__slider-nav swiper" data-product-nav="data-product-nav">
                                        <div class="product__slider-wrapper swiper-wrapper">
                                            <div class="product__slide swiper-slide">
                                                <img class="product__thumb" src="{{ $product->catalog->thumb(3) }}" width="131"
                                                     height="87" alt="{{ $product->name }}" loading="lazy"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="product__col">
                            <div class="product__head">
                                <div class="product__head-stock">
                                    <!-- not availability? add class is-out (class="c-availability is-out")-->
                                    <div class="c-availability is-wide {{ $product->in_stock ? '' : 'is-out' }}">
                                        {{ $product->in_stock ? 'В наличии' : 'под заказ'}}
                                    </div>
                                </div>
                                @if($product->brand_id > 0)
                                    <div class="product__head-info">
                                        <div class="product__manufacturer">Производитель:
                                            <span>{{ $product->brand->name }}{{ $product->manufacturer ? ', '.$product->manufacturer : '' }}</span>
                                        </div>
                                        <a class="product__brand" href="{{ $product->brand->url }}"
                                           title="Все окна {{ $product->brand->name }}">
                                            @if($product->brand->image)
                                                <img class="product__brand-img" src="{{ $product->brand->image_src }}"
                                                     width="129" height="41"
                                                     alt="{{ $product->brand->name }} {{ $product->manufacturer ? ', '.$product->manufacturer : '' }}"
                                                     loading="lazy"/>
                                            @else
                                                <span>{{ $product->brand->name }}</span>
                                            @endif
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="product__content text-block">
                                @if($product->text)
                                    <h4>Описание модели:</h4>
                                    {!! $product->text !!}
                                @endif

                                <div class="product__pricing">
                                    @if($product->price > 0)
                                        <div class="product__price">{{ $product->priceFormat }}
                                            &nbsp;руб/{{ $product->measure ?: 'шт' }}</div>
                                    @else
                                        <div class="product__price">Цена по запросу</div>
                                    @endif

                                    @if($product->old_price > 0)
                                        <div class="product__price product__price--old">
                                            <del>{{ $product->oldPriceFormat }}&nbsp;руб/{{ $product->measure }}</del>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="product__controls">
                                <span>Количество:</span>
                                <div class="product__counter">
                                    <div class="counter" data-counter="data-counter">
                                        <button class="counter__btn counter__btn--prev btn-reset" type="button"
                                                aria-label="Меньше">
                                            <span class="iconify" data-icon="ic:round-minus" data-width="14"></span>
                                        </button>
                                        <input class="counter__input input-reset" type="number" name="count"
                                               value="{{ Cart::ifInCartGetCount($product->id) ? Cart::ifInCartGetCount($product->id) : 1 }}"
                                               data-count="data-count"
                                               data-id="{{ Cart::ifInCart($product->id) ? $product->id : null }}"/>
                                        <button class="counter__btn counter__btn--next btn-reset" type="button"
                                                aria-label="Больше">
                                            <span class="iconify" data-icon="ic:round-plus" data-width="14"></span>
                                        </button>
                                    </div>
                                    <div class="product__counter-value">шт.</div>
                                </div>
                            </div>
                            <div class="product__actions">
                                @include('catalog.product_add_btn')
                                <button class="btn btn--outlined btn--small btn-reset" type="button"
                                        aria-label="Купить в 1 клик" data-popup="data-popup"
                                        data-src="#order"
                                        data-image="{{ $product->image ? $product->single_image->thumb(1) : $product->single_catalog_image }}"
                                        data-title="{{ $product->name }}">
                                    <span>Купить в 1 клик</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--.prod-data-->
                <div class="prod-data">
                    <div class="container">
                        <div class="title title--small">Характеристики</div>
                        <!--dl.data-list.-columns-->
                        <dl class="data-list data-list--columns">
                            @if($product->brand_id > 0)
                                <div class="data-list__item">
                                    <dt class="data-list__key">Бренд</dt>
                                    <dd class="data-list__value">{{ $product->brand->name }}</dd>
                                </div>
                            @endif
                            @if($product->country)
                                <div class="data-list__item">
                                    <dt class="data-list__key">Страна производства</dt>
                                    <dd class="data-list__value">{{ $product->country }}</dd>
                                </div>
                            @endif
                            @if($product->sizes)
                                <div class="data-list__item">
                                    <dt class="data-list__key">Размеры, см</dt>
                                    <dd class="data-list__value">{{ $product->sizes }}</dd>
                                </div>
                            @endif
                            @if($product->material)
                                <div class="data-list__item">
                                    <dt class="data-list__key">Материал</dt>
                                    <dd class="data-list__value">{{ $product->material }}</dd>
                                </div>
                            @endif
                            @if($product->square)
                                <div class="data-list__item">
                                    <dt class="data-list__key">Площадь остекления, м2</dt>
                                    <dd class="data-list__value">{{ $product->square }}</dd>
                                </div>
                            @endif
                            @if($product->type)
                                <div class="data-list__item">
                                    <dt class="data-list__key">Тип</dt>
                                    <dd class="data-list__value">{{ $product->type }}</dd>
                                </div>
                            @endif
                            @if($product->handle)
                                <div class="data-list__item">
                                    <dt class="data-list__key">Ручка</dt>
                                    <dd class="data-list__value">{{ $product->handle }}</dd>
                                </div>
                            @endif
                            @if($product->configuration)
                                <div class="data-list__item">
                                    <dt class="data-list__key">Конфигурация</dt>
                                    <dd class="data-list__value">{{ $product->configuration }}</dd>
                                </div>
                            @endif
                            @foreach($params as $param)
                                <div class="data-list__item">
                                    <dt class="data-list__key">{{ $param->name }}</dt>
                                    <dd class="data-list__value">{{ $param->value ?: 'Да' }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>
                <!--.prod-data.-gray-->
                @if($product->text)
                    <div class="prod-data prod-data--gray">
                        <div class="container">
                            <div class="title title--small">Описание</div>
                            <div class="text-block">
                                {!! $product->text !!}
                            </div>
                        </div>
                    </div>
                @endif

                @include('blocks.questions')

                @include('catalog.need')

                @include('catalog.similar')

                @include('blocks.our_features')
            </main>
        </div>
    </div>
@endsection
