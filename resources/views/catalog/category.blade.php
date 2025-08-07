@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <!--section.preview-->
        <section class="preview page">
            <div class="preview__container container">
                <div class="preview__heading page__heading">
                    <h1 class="preview__title page__title">{{ $h1 }}</h1>
                </div>
                @if($category->image_text_preview)
                    <div class="preview__view">
                        <img class="preview__img no-select" src="{{ $category->preview_thumb(2) }}" width="1270"
                             height="440" title="{{ $category->name }}" alt="{{ $category->name }}"/>
                    </div>
                @endif
                <div class="preview__body">
                    <div class="preview__content">
                        @if($category->announce)
                            <div class="preview__titles">
                                <div class="page__subtitle">{{ $category->announce }}</div>
                            </div>
                        @endif
                        @if($text)
                            <div class="preview__text text-block">
                                {!! $text !!}
                            </div>
                        @endif
                    </div>
                    <div class="preview__aside">
                        <div class="brand-label">
                            <span class="brand-label__title">В комплекте всегда выгоднее!</span>
                            <img class="brand-label__img no-select" src="/static/images/common/brand-label.svg"
                                 width="168" height="57" alt="alt" loading="lazy"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(count($products))
            <section class="prods page">
                <div class="prods__container container">
                    @foreach($products as $product)
                        <div class="prods__item">
                            <a class="prods__view" href="{{ $product->url }}" title="{{ $product->name }}">
                                @if($product->single_image)
                                    <img class="prods__img no-select" src="{{ $product->single_image->thumb(2) }}"
                                         width="320" height="300" alt="{{ $product->name }}" title="{{ $product->name }}" loading="lazy"/>
                                @endif
                            </a>
                            <div class="prods__body">
                                <div class="prods__heading page__subheading">
                                    <a class="prods__title page__subtitle"
                                       href="{{ $product->url }}">{{ $product->name }}</a>
                                </div>
                                @if($product->announce)
                                    <div class="prods__text text-block">
                                        {!! $product->announce !!}
                                    </div>
                                @endif
                                <div class="prods__actions">
                                    <a class="button" href="{{ $product->url }}">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
    @include('blocks.callback')
@endsection