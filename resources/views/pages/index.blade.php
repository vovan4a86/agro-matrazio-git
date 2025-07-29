@extends('template')
@section('content')
    <main>
        <!--section.hero-->
        <section class="hero splide" aria-label="Наш каталог" data-hero-slider="data-hero-slider">
            <div class="hero__track splide__track">
                <ul class="hero__list splide__list">
                    <li class="hero__slide splide__slide">
                        <div class="hero__container container">
                            <div class="hero__content">
                                <div class="hero__heading">
                                    <div class="hero__title">Резиновые покрытия</div>
                                    <div class="hero__text">
                                        <p>создают среду, близкую к естественному содержанию</p>
                                    </div>
                                </div>
                                <div class="hero__actions">
                                    <a class="button button--wide button--light" href="javascript:void(0)">Перейти в каталог</a>
                                </div>
                            </div>
                        </div>
                        <div class="hero__view">
                            <picture>
                                <source media="(max-width: 820px)" srcset="/static/images/common/hero-1--820.webp" type="image/webp" />
                                <source media="(max-width: 820px)" srcset="/static/images/common/hero-1--820.jpg" />
                                <source srcset="/static/images/common/hero-1.webp" type="image/webp" />
                                <img src="/static/images/common/hero-1.jpg" alt="picture" />
                            </picture>
                        </div>
                    </li>
                    <li class="hero__slide splide__slide">
                        <div class="hero__container container">
                            <div class="hero__content">
                                <div class="hero__heading">
                                    <div class="hero__title">Стальные каркасы для ферм</div>
                                </div>
                                <div class="hero__actions">
                                    <a class="button button--wide button--light" href="javascript:void(0)">Перейти в каталог</a>
                                </div>
                            </div>
                        </div>
                        <div class="hero__view">
                            <picture>
                                <source media="(max-width: 820px)" srcset="/static/images/common/hero-2--820.webp" type="image/webp" />
                                <source media="(max-width: 820px)" srcset="/static/images/common/hero-2--820.jpg" />
                                <source srcset="/static/images/common/hero-2.webp" type="image/webp" />
                                <img src="/static/images/common/hero-2.jpg" alt="picture" />
                            </picture>
                        </div>
                    </li>
                </ul>
                <div class="hero__nav">
                    <div class="hero__arrows site-arrows site-arrows--white splide__arrows">
                        <button class="hero__arrow site-arrow splide__arrow splide__arrow--prev btn-reset" type="button" aria-label="Предыдущий слайд">
                            <svg class="svg-sprite-icon icon-caret-right" width="1em" height="1em">
                                <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret-right"></use>
                            </svg>
                        </button>
                        <button class="hero__arrow site-arrow splide__arrow splide__arrow--next btn-reset" type="button" aria-label="Следующий слайд">
                            <svg class="svg-sprite-icon icon-caret-right" width="1em" height="1em">
                                <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret-right"></use>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!--section.cat-view-->
        <section class="cat-view">
            <div class="cat-view__container container">
                <div class="cat-view__item">
                    <!--.cat-item-->
                    <div class="cat-item">
                        <a class="cat-item__view lazy" data-bg="/static/images/common/cat-view-1.jpg" href="javascript:void(0)" title="Стальные каркасы для ферм"></a>
                        <div class="cat-item__body">
                            <a class="cat-item__title" href="javascript:void(0)">Стальные каркасы для ферм</a>
                            <div class="cat-item__actions">
                                <a class="button" href="javascript:void(0)">Перейти в раздел</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cat-view__item">
                    <!--.cat-item-->
                    <div class="cat-item">
                        <a class="cat-item__view lazy" data-bg="/static/images/common/cat-view-2.jpg" href="javascript:void(0)" title="Резиновые маты для содержания КРС"></a>
                        <div class="cat-item__body">
                            <a class="cat-item__title" href="javascript:void(0)">Резиновые маты для содержания КРС</a>
                            <div class="cat-item__actions">
                                <a class="button" href="javascript:void(0)">Перейти в раздел</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cat-view__item">
                    <!--.brand-label-->
                    <div class="brand-label">
                        <span class="brand-label__title">В комплекте всегда выгоднее!</span>
                        <img class="brand-label__img no-select" src="/static/images/common/brand-label.svg" width="168" height="57" alt="alt" loading="lazy" />
                    </div>
                </div>
            </div>
        </section>
        <!--section.s-about-->
        <section class="s-about">
            <div class="s-about__top page">
                <div class="s-about__container container">
                    <div class="s-about__heading page__heading">
                        <div class="s-about__title page__title">О компании</div>
                    </div>
                    <div class="s-about__body">
                        <div class="s-about__view">
                            <img class="s-about__img" src="/static/images/common/s-about.jpg" width="621" height="425" loading="lazy" alt="Агросталь-Комплект" />
                        </div>
                        <div class="s-about__content">
                            <div class="s-about__subtitle page__subtitle">Опыт производства и комплектования животноводческих ферм с 2008 года.</div>
                            <div class="s-about__text">
                                <p>Сотни довольных клиентов в России и странах СНГ. Наш комплексный подход сможет удовлетворить самые высокие требования клиента по качеству продукции, срокам поставки и шеф-монтаж. Вместе сможем реализовать самые крупные и амбициозные проекты.</p>
                                <p style="text-align: right">С уважением, А.А. Огибенин</p>
                            </div>
                            <div class="s-about__actions">
                                <a class="link" href="javascript:void(0)">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="s-about__bottom">
                <div class="s-about__container container">
                    <div class="s-about__heading page__heading">
                        <div class="s-about__title page__title">Наши преимущества</div>
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
                </div>
                <img class="s-about__decor no-select" src="/static/images/common/about-decor.png" width="410" height="507" loading="lazy" alt="Агросталь-Комплект" />
            </div>
        </section>
    </main>
@stop
