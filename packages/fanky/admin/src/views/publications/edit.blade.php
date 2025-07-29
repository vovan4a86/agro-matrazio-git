@extends('admin::template')

@section('scripts')
    <script type="text/javascript" src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/adminlte/plugins/autocomplete/jquery.autocomplete.min.js"></script>
    <script type="text/javascript" src="/adminlte/interface_news.js"></script>
    <style>
        .tag-item {
            padding: 5px;
            margin: 5px;
            background: #dedede;
            border-radius: 5px;
        }

        .tag-item:hover {
            cursor: pointer;
            background: #fc6969;
        }
    </style>
@stop

@section('page_name')
    <h1>
        Статьи
        <small>{{ $publication->id ? 'Редактировать' : 'Новая' }}</small>
    </h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Главная</a></li>
        <li><a href="{{ route('admin.publications') }}">Новости</a></li>
        <li class="active">{{ $publication->id ? 'Редактировать' : 'Новая' }}</li>
    </ol>
@stop

@section('content')
    <form action="{{ route('admin.publications.save') }}" onsubmit="return newsSave(this, event)">
        <input type="hidden" name="id" value="{{ $publication->id }}">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Параметры</a></li>
                <li><a href="#tab_2" data-toggle="tab">Текст</a></li>
                @if($publication->id)
                    <li class="pull-right">
                        <a href="{{ route('publications.item', [$publication->alias]) }}" target="_blank">Посмотреть</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">

                    {!! Form::groupDate('date', $publication->date, 'Дата') !!}
                    {!! Form::groupText('name', $publication->name, 'Название') !!}
                    {!! Form::groupText('alias', $publication->alias, 'Alias') !!}
                    {!! Form::groupText('title', $publication->title, 'Title') !!}
                    {!! Form::groupText('keywords', $publication->keywords, 'keywords') !!}
                    {!! Form::groupText('description', $publication->description, 'description') !!}

                    {!! Form::groupText('og_title', $publication->og_title, 'OpenGraph Title') !!}
                    {!! Form::groupText('og_description', $publication->og_description, 'OpenGraph description') !!}
                    <div class="form-group">
                        <label for="article-image">Изображение (558x315)</label>
                        <input id="article-image" type="file" name="image" accept=".jpg,.jpeg,.png"
                               onchange="return newsImageAttache(this, event)">
                        <div id="article-image-block">
                            @if ($publication->image)
                                <img class="img-polaroid" src="{{ $publication->thumb(1) }}" height="100"
                                     data-image="{{ $publication->thumb(1) }}"
                                     onclick="return popupImage($(this).data('image'))" alt="image">
                                <a class="images_del" href="{{ route('admin.publications.delete-image', [$publication->id]) }}"
                                   onclick="return newsImageDel(this, event)">
                                    <span class="glyphicon glyphicon-trash text-red"></span></a>
                            @else
                                <p class="text-yellow">Изображение не загружено.</p>
                            @endif
                        </div>
                    </div>

                    {!! Form::groupCheckbox('published', 1, $publication->published, 'Показывать статью') !!}
                </div>

                <div class="tab-pane" id="tab_2">
                    {!! Form::groupText('announce', $publication->announce, 'Анонс') !!}
                    {!! Form::groupRichtext('text', $publication->text, 'Текст', ['rows' => 3]) !!}
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@stop
