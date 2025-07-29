@extends('template')
@section('content')
    <div class="layout body-content">
        @include('blocks.bread')
        <div class="layout__container container">
            <div class="layout__heading">
                <div class="title">{{ $h1 }}</div>
            </div>
        </div>
        <div class="layout__container container">
            @include('catalog.aside')
            <main class="layout__content">
                @if(count($categories))
                    <nav class="sub-links">
                        <ul class="sub-links__list">
                            @foreach($categories as $cat)
                                <li class="sub-links__item">
                                    <a class="sub-links__card" href="{{ $cat->url }}" title="{{ $cat->name }}">
                                        <span class="sub-links__view">
                                            @if($cat->image)
                                                <img class="sub-links__img no-select" src="{{ $cat->thumb(1) }}"
                                                     width="78" height="100" alt="{{ $cat->name }}" loading="lazy"/>
                                            @endif
                                        </span>
                                        <span class="sub-links__title">{{ $cat->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                @endif
                @if(count($products))
                    <div class="layout__cards">
                        @foreach($products as $product)
                            @include('catalog.product_card')
                        @endforeach
                    </div>
                    @include('paginations.with_pages', ['paginator' => $products])
                @endif
            </main>
        </div>
    </div>

    @include('blocks.contact_us')

    @if($text)
        <div class="layout">
            <div class="layout__container container">
                <div class="layout__text text-block">
                    {!! $text !!}
                </div>
            </div>
        </div>
    @endif
@endsection
