@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="catalog page">
            <div class="catalog__container container">
                <div class="catalog__heading page__heading">
                    <h1 class="catalog__title page__title">{{ $h1 }}</h1>
                </div>
                <div class="catalog__grid">
                    @foreach($categories as $category)
                        @if($loop->first)
                            <div class="catalog__main">
                                <div class="prods-view">
                                    <div class="prods-view__bg lazy"
                                         data-bg="{{ $category->thumb(2) }}"></div>
                                    <div class="prods-view__body">
                                        <a class="prods-view__head"
                                           href="{{ $category->url }}">{{ $category->name }}</a>
                                        @if(count($category->products()->public()->get()))
                                            <ul class="prods-view__list list-reset">
                                                @foreach($category->products()->public()->limit(9)->get() as $children)
                                                    <li class="prods-view__list-item">
                                                        <a class="prods-view__list-link" href="{{ $children->url }}">
                                                            {{ $children->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="catalog__other">
                                <div class="prods-view">
                                    <div class="prods-view__bg lazy"
                                         data-bg="{{ $category->thumb(3) }}"></div>
                                    <div class="prods-view__body">
                                        <a class="prods-view__head" href="{{ $category->url }}">{{ $category->name }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="catalog__brand">
                        <!--.brand-label-->
                        <div class="brand-label">
                            <span class="brand-label__title">В комплекте всегда выгоднее!</span>
                            <img class="brand-label__img no-select" src="/static/images/common/brand-label.svg"
                                 width="168" height="57" alt="alt" loading="lazy"/>
                        </div>
                    </div>
                </div>
                @if($feats = S::get('catalog_features'))
                    <div class="catalog__titles">
                        @foreach($feats as $feat)
                            <div class="page__subtitle">{{ $feat }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="catalog__text text-block">
                    {!! $text !!}
                </div>
            </div>
        </section>
    </main>
    @include('blocks.callback')
@endsection