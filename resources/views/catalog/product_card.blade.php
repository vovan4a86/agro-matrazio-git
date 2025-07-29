<div class="card">
    <div class="card__top">
        @if($product->is_new || $product->old_price)
            <div class="card__badges">
                @if($product->old_price > 0)
                    <div class="badge {{ isset($discount_page) ? 'badge--alert' : '' }}">Скидка</div>
                @endif
                @if($product->is_new)
                    <div class="badge badge--sky">Новинка</div>
                @endif
            </div>
        @endif
        <a class="card__view" href="{{ $product->url }}"
           title="{{ $product->name }}">
            @if($product->card_thumb)
                <img class="card__img" src="{{ $product->card_thumb }}"
                     width="260" height="260" alt="{{ $product->name }}" loading="lazy"/>
            @endif
            @if($product->brand_id !== 0 && $product->brand->image)
                <img class="card__brand" src="{{ $product->brand->image_src }}" width="74"
                     height="53" loading="lazy" alt="product logo"/>
            @endif
        </a>
    </div>
    <div class="card__body">
        <a class="card__title" href="{{ $product->url }}">{{ $product->name }}</a>
        <div class="card__info">
            <!-- not availability? add class is-out (class="c-availability is-out")-->
            <div class="c-availability {{ !$product->in_stock ? 'is-out' : null }}">
                @if($product->in_stock)
                    В наличии
                @else
                    Под заказ
                @endif
            </div>
            @if($product->delivery)
                <div class="c-delivery">
                    <span class="c-delivery__icon lazy"
                          data-bg="/static/images/common/ico_cube.svg"></span>
                    <span class="c-delivery__label">{{ $product->delivery }}</span>
                </div>
            @endif
        </div>
        <div class="card__params">
            @if($product->sizes)
                <div class="card__params-item">
                    <div class="card__params-key">Размеры, см:</div>
                    <div class="card__params-value">{{ $product->sizes }}</div>
                </div>
            @endif
            @if($product->manufacturer)
                <div class="card__params-item">
                    <div class="card__params-key">Производитель:</div>
                    <div class="card__params-value">{{ $product->manufacturer }}</div>
                </div>
            @endif
        </div>
        <div class="card__pricing">
            @if($product->price > 0)
                <div class="card__price">
                    {{ $product->price_format }}&nbsp;₽&nbsp;@if($product->measure)
                        / {{$product->measure}}
                    @endif
                </div>
            @else
                <div class="card__price">
                    Цена по запросу
                </div>
            @endif
            @if($product->old_price > 0)
                <div class="card__price card__price--old">
                    <del>
                        {{ $product->old_price_format }}&nbsp;₽&nbsp;@if($product->measure)
                            / {{$product->measure}}
                        @endif
                    </del>
                </div>
            @endif
        </div>
        <div class="card__actions">
            <button class="btn btn--red f-width btn-reset" type="button"
                    aria-label="Заказать" data-popup="data-popup"
                    data-src="#order"
                    data-image="{{ $product->card_thumb }}"
                    data-title="{{ $product->name }}">
                <span>Заказать</span>
            </button>
        </div>
    </div>
</div>