@if(isset($similar) && count($similar))
    <section class="s-cards section s-cards--gray">
        <div class="s-cards__container container">
            <div class="section__head">
                <div class="title">Похожие товары</div>
                <div class="site-arrows site-arrows--row">
                    <button class="site-arrows__arrow site-arrows__arrow--prev site-arrow btn-reset" type="button" aria-label="Предыдущий слайд" data-related-prev="data-related-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 5l-7 7 7 7" />
                        </svg>
                    </button>
                    <button class="site-arrows__arrow site-arrows__arrow--next site-arrow btn-reset" type="button" aria-label="Следующий слайд" data-related-next="data-related-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="s-cards__slider swiper" data-related-slider="data-related-slider">
                <div class="s-cards__wrapper swiper-wrapper">
                    @foreach($similar as $product)
                        <div class="s-cards__item swiper-slide">
                            @include('catalog.product_card')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endif