<!DOCTYPE html>
<html lang="ru-RU">

@include('blocks.head')

<body x-data="{ overlayIsOpen: false }">
    {!! Settings::get('counters') !!}

{{--    <h1 class="v-hidden">{{ $h1 ?? '' }}</h1>--}}

    @include('blocks.header')
    @include('blocks.mob_nav')
    @include('blocks.overlay')

    @yield('content')
    @include('blocks.footer')
    @include('blocks.popups')

    <div class="v-hidden" itemscope itemtype="https://schema.org/LocalBusiness" aria-hidden="true" tabindex="-1">
        {!! Settings::get('schema.org') !!}
    </div>
    <div class="scrolltop" aria-label="В начало страницы" tabindex="1">
        <svg class="svg-sprite-icon icon-up" width="1em" height="1em">
            <use xlink:href="static/images/sprite/symbol/sprite.svg#up"></use>
        </svg>
    </div>
    @if(isset($admin_edit_link) && strlen($admin_edit_link))
        <div class="adminedit">
            <div class="adminedit__ico"></div>
            <a href="{{ $admin_edit_link }}" class="adminedit__name" target="_blank">Редактировать</a>
        </div>
    @endif
</body>
</html>
