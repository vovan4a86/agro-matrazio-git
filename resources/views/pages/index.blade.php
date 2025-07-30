@extends('template')
@section('content')
    <main>
        @if($main_slider)
            <section class="hero splide" aria-label="Наш каталог" data-hero-slider="data-hero-slider">
                <div class="hero__track splide__track">
                    <ul class="hero__list splide__list">
                        @foreach($main_slider as $slider)
                            <li class="hero__slide splide__slide">
                                <div class="hero__container container">
                                    <div class="hero__content">
                                        <div class="hero__heading">
                                            @if($slider['header'])
                                                <div class="hero__title">{{ $slider['header'] }}</div>
                                            @endif
                                            @if($slider['text'])
                                                <div class="hero__text">
                                                    <p>{{ $slider['text'] }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        @if($slider['btn_name'] && $slider['btn_url'])
                                            <div class="hero__actions">
                                                <a class="button button--wide button--light"
                                                   href="{{ $slider['btn_url'] }}">
                                                    {{ $slider['btn_name'] }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if($img = $slider['image'])
                                    <div class="hero__view">
                                        <picture>
                                            <img src="{{ S::fileSrc($img) }}" alt="{{ $slider['header'] }}"/>
                                        </picture>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <div class="hero__nav">
                        <div class="hero__arrows site-arrows site-arrows--white splide__arrows">
                            <button class="hero__arrow site-arrow splide__arrow splide__arrow--prev btn-reset"
                                    type="button" aria-label="Предыдущий слайд">
                                <svg class="svg-sprite-icon icon-caret-right" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret-right"></use>
                                </svg>
                            </button>
                            <button class="hero__arrow site-arrow splide__arrow splide__arrow--next btn-reset"
                                    type="button" aria-label="Следующий слайд">
                                <svg class="svg-sprite-icon icon-caret-right" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret-right"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if($main_categories)
            <section class="cat-view">
                <div class="cat-view__container container">
                    @foreach($main_categories as $category)
                        <div class="cat-view__item">
                            <div class="cat-item">
                                <a class="cat-item__view lazy"
                                   data-bg="{{ $category->thumb(1) }}"
                                   href="{{ $category->url }}" title="{{ $category->name }}"></a>
                                <div class="cat-item__body">
                                    <a class="cat-item__title" href="{{ $category->url }}">{{ $category->name }}</a>
                                    <div class="cat-item__actions">
                                        <a class="button" href="{{ $category->url }}">Перейти в раздел</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="cat-view__item">
                        <!--.brand-label-->
                        <div class="brand-label">
                            <span class="brand-label__title">В комплекте всегда выгоднее!</span>
                            <img class="brand-label__img no-select" src="/static/images/common/brand-label.svg"
                                 width="168"
                                 height="57" alt="alt" loading="lazy"/>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <section class="s-about">
            @if($main_about)
                <div class="s-about__top page">
                    <div class="s-about__container container">
                        <div class="s-about__heading page__heading">
                            @if($main_about['header'])
                                <div class="s-about__title page__title">{{ $main_about['header'] }}</div>
                            @endif
                        </div>
                        <div class="s-about__body">
                            @if($img = $main_about['image'])
                                <div class="s-about__view">
                                    <img class="s-about__img" src="{{ S::fileSrc($img) }}"
                                         width="621" height="425"
                                         loading="lazy" alt="Агросталь-Комплект"/>
                                </div>
                            @endif
                            <div class="s-about__content">
                                @if($main_about['text_header'])
                                    <div class="s-about__subtitle page__subtitle">{{ $main_about['text_header'] }}</div>
                                @endif
                                @if($main_about['text'])
                                    <div class="s-about__text">
                                        {!! $main_about['text'] !!}
                                    </div>
                                @endif
                                <div class="s-about__actions">
                                    <a class="link" href="{{ url('about') }}">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($main_features)
                <div class="s-about__bottom">
                    <div class="s-about__container container">
                        <div class="s-about__heading page__heading">
                            <div class="s-about__title page__title">Наши преимущества</div>
                        </div>
                        <div class="s-about__feats">
                            @foreach($main_features as $feat)
                                <div class="feat-item">
                                    @if($feat['ico'])
                                        <div class="feat-item__view">
                                            <div class="feat-item__icon lazy"
                                                 data-bg="{{ S::fileSrc($feat['ico']) }}"></div>
                                        </div>
                                    @endif
                                    @if($feat['text'])
                                        <div class="feat-item__title">{{ $feat['text'] }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <img class="s-about__decor no-select" src="/static/images/common/about-decor.png" width="410"
                         height="507" loading="lazy" alt="Агросталь-Комплект"/>
                </div>
            @endif
        </section>
    </main>
    @include('blocks.callback')
@stop
