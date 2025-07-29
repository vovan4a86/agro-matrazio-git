<div class="cart-item" data-id="{{ $item['id'] }}">
    <a class="cart-item__view" href="{{ $item['url'] }}" title="{{ $item['name'] }}">
        @if($item['image'])
            <img class="cart-item__pic" src="{{ $item['image'] }}" width="100" height="100"
                 alt="{{ $item['name'] }}" loading="lazy" />
        @endif
    </a>
    <div class="cart-item__body">
        <a class="cart-item__title" href="{{ $item['url'] }}">{{ $item['name'] }}</a>
    </div>
    <div class="cart-item__price">{{ number_format($item['price'], 0, ',', ' ') }} руб/{{ $item['measure'] }}</div>
    <div class="cart-item__counter">
        <div class="counter" data-counter="data-counter">
            <button class="counter__btn counter__btn--prev btn-reset" type="button" aria-label="Меньше">
                <span class="iconify" data-icon="ic:round-minus" data-width="14"></span>
            </button>
            <input class="counter__input input-reset cart__input" type="number" name="count"
                   value="{{ $item['count'] }}" data-count="data-count" data-id="{{ $item['id'] }}" />
            <button class="counter__btn counter__btn--next btn-reset" type="button" aria-label="Больше">
                <span class="iconify" data-icon="ic:round-plus" data-width="14"></span>
            </button>
        </div>
    </div>
    <div class="cart-item__actions">
        <button class="cart-item__delete btn-reset" type="button" aria-label="Удалить из корзины">
            <svg class="svg-sprite-icon icon-close" width="1em" height="1em">
                <use xlink:href="/static/images/sprite/symbol/sprite.svg#close"></use>
            </svg>
        </button>
    </div>
</div>