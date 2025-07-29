@extends('template')
@section('content')
    <div class="layout body-content">
        @include('blocks.bread')
        <div class="layout__container container">
            <div class="layout__heading">
                <div class="title">{{ $h1 ?? '' }}</div>
            </div>
        </div>
        @if(count($images))
            <main>
                <div class="container">
                    <div class="layout layout--brands">
                        <div class="b-gallery">
                            @foreach($images as $image)
                                <a class="b-gallery__link" href="{{ $image->image_src }}" title="{{ $image->name ?: $item->name }}"
                                   data-caption="{{ $image->name ?: $item->name }}" data-fancybox="gallery">
                                    <img class="b-gallery__img" src="{{ $image->thumb(2) }}" width="465"
                                         height="316" alt="{{ $image->name ?: $item->name }}" loading="lazy"/>
                                </a>
                            @endforeach
                        </div>
                        <div class="objects__pagination">
                            @include('paginations.with_pages', ['paginator' => $images])
                        </div>
                    </div>
                </div>
            </main>
        @endif
    </div>
@endsection