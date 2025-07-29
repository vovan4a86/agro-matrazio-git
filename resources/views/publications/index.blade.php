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
                    <!--.infos-->
                    <div class="infos">
                        <ul class="infos__list">
                            @foreach($items as $item)
                                <li class="infos__item">
                                    <a class="infos__view" href="{{ $item->url }}" title="{{ $item->name }}">
                                        @if($item->image)
                                            <img class="infos__img" src="{{ $item->thumb(1) }}" width="200" height="140"
                                                 alt="{{ $item->name }}" loading="lazy" />
                                        @endif
                                    </a>
                                    <div class="infos__body">
                                        <div class="infos__head">
                                            <time class="infos__date" datetime="{{ $item->dateFormat('Y-m-d') }}">{{ $item->dateFormat() }}</time>
                                            <a class="infos__title" href="{{ $item->url }}">{{ $item->name }}</a>
                                        </div>
                                        <div class="infos__text">
                                            {!! $item->announce !!}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @include('paginations.with_pages', ['paginator' => $items])
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection