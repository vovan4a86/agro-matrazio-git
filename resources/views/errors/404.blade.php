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
                    <!--.b-error-->
                    <div class="b-error">
                        <div class="b-error__grid">
                            <div class="b-error__body">
                                <div class="b-error__head">
                                    <div class="b-error__title">Что-то пошло не так...</div>
                                    <div class="b-error__text">К сожалению, такой страницы не существует, вернитесь на Главную страницу.</div>
                                </div>
                                <div class="b-error__actions">
                                    <a class="btn btn--outlined-red" href="{{ route('main') }}">Вернуться на главную</a>
                                </div>
                            </div>
                            <div class="b-error__view">
                                <img class="b-error__img no-select" src="/static/images/common/error.png" width="392" height="391" alt="error" loading="lazy" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@stop
