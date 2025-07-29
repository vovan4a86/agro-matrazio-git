@extends('template')
@section('content')
    <div class="layout body-content">
        @include('blocks.bread')
        <div class="layout__container container">
            <div class="layout__heading">
                <div class="title">{{ $h1 }}</div>
            </div>
        </div>
        <main>
            <div class="container">
                <div class="layout layout--brands">
                    @if(count($items))
                        <form class="cart send-form" action="{{ route('ajax.order') }}">
                        <div class="cart__title">1. Проверьте заказ</div>
                        <div class="cart__block">
                            <div class="cart__container">
                                @foreach($items as $item)
                                    @include('cart.cart_item')
                                @endforeach

                                @include('cart.cart_total')
                            </div>
                        </div>
                        <div class="cart__title">2. Оформление</div>
                        <div class="cart__block">
                            <div class="cart__container">
                                <div class="cart__fields">
                                    <label class="user-input user-input--white">
                                        <input class="user-input__field" type="text" name="name" required="required" />
                                        <span class="user-input__label">Ваше имя *</span>
                                    </label>
                                    <label class="user-input user-input--white">
                                        <input class="user-input__field" type="text" name="email" required="required" />
                                        <span class="user-input__label">Email *</span>
                                    </label>
                                    <label class="user-input user-input--white">
                                        <input class="user-input__field" type="tel" name="phone" required="required" />
                                        <span class="user-input__label">Телефон *</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="cart__actions">
                            <button class="btn btn--red btn-reset" name="submit" aria-label="Оформить заказ">Оформить заказ</button>
                        </div>
                    </form>
                    @else
                        Пусто
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection
