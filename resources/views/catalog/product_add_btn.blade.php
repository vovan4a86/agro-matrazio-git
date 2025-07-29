@if($in_cart)
    <a href="{{ route('cart') }}" class="btn btn--red btn-reset btn--small" type="button"
            aria-label="В корзине">
        <span>В корзине</span>
    </a>
@else
    <button class="btn btn--accent btn--small btn-reset add-to-cart" type="button"
            aria-label="В корзину" data-popup="data-popup" data-src="#one-click"
            data-id="{{ $product->id }}"
            data-image="{{ $product->image ? $product->single_image->thumb(1) : $product->single_catalog_image }}"
            data-title="{{ $product->name }}">
        <span>В корзину</span>
    </button>
@endif