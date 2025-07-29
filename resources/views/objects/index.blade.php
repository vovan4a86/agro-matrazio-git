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
                    <!--.objects-->
                    <div class="objects">
                        <div class="objects__grid">
                            @foreach($items as $item)
                                @include('objects.list_item')
                            @endforeach
                        </div>
                        <div class="objects__pagination">
                            @include('paginations.with_pages', ['paginator' => $items])
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection