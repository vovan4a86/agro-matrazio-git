@extends('template')
@section('content')
    <div class="layout body-content">
        @include('blocks.bread')
        <div class="layout__container container">
            <div class="layout__heading">
                <div class="title">{{ $h1 ?? '' }}</div>
            </div>
        </div>
        <main>
            <div class="container">
                <div class="layout layout--brands">
                    <div class="layout__grid">
                        @if($text)
                            <div class="layout__content text-block">
                                {!! $text !!}
                            </div>
                        @endif
                        @if($item->image)
                            <div class="layout__view">
                                <img class="layout__pic" src="{{ $item->thumb(3) }}" width="561" height="317"
                                     alt="{{ $item->name }}" loading="lazy">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection