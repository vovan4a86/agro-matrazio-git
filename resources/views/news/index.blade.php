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
                    <!--.newses-->
                    <div class="newses" data-newses-tabs="data-newses-tabs">
                        <!-- возможно тут вообще будут ссылки, тогда всё по data-newses удаляется, кнопки → ссылки-->
                        <nav class="newses__nav">
                            <button class="newses__btn btn-reset is-active" type="button" data-newses-button="all" aria-label="Показать все">
                                <span>Все</span>
                            </button>
                            <button class="newses__btn btn-reset" type="button" data-newses-button="news" aria-label="Показать новости">
                                <span>Новости</span>
                            </button>
                            <button class="newses__btn btn-reset" type="button" data-newses-button="action" aria-label="Показать акции">
                                <span>Акции</span>
                            </button>
                        </nav>
                        <div class="newses__grid">
                            @foreach($items as $item)
                                @include('news.list_item')
                            @endforeach
                        </div>
                        @include('paginations.with_pages', ['paginator' => $items])
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection