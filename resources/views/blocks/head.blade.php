<head>
    <meta charset="utf-8">
    {!! SEOMeta::generate() !!}
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="application-name" content="name">
    <meta name="cmsmagazine" content="18db2cabdd3bf9ea4cbca88401295164">
    <meta name="author" content="Fanky.ru">
    <meta name="apple-mobile-web-app-title" content="Agrostal">
    <link rel="icon" type="image/png" href="/static/images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/static/images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/static/images/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/static/images/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Agrostal" />
    <link rel="manifest" href="/static/images/favicon/site.webmanifest" />
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-config" content="/static/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:type" content="website">
    {!! OpenGraph::generate() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preload" href="/static/fonts/Geologica-Light.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/static/fonts/Geologica-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/static/fonts/Geologica-Medium.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/static/fonts/Geologica-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" as="image" href="/static/images/common/popup-bg.webp">
    <link rel="stylesheet" type="text/css" href="{{ mix('static/css/all.css') }}" media="all">
    <script src="{{ mix('static/js/all.js') }}" defer></script>

    @if(isset($canonical))
        <link rel="canonical" href="{{ $canonical }}"/>
    @endif

{{--    @if(Route::is('contacts'))--}}
{{--        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>--}}
{{--    @endif--}}
</head>
