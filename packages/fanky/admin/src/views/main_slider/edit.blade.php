@extends('admin::template')

@section('scripts')
    <script type="text/javascript" src="/adminlte/interface_main_slider.js"></script>
@stop

@section('page_name')
    <h1>
        Слайд
        <small>{{ $slide->id ? 'Редактировать' : 'Новый' }}</small>
    </h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.main-slider') }}">Слайдер</a></li>
        <li class="active">{{ $slide->id ? 'Редактировать' : 'Новый' }}</li>
    </ol>
@stop

@section('content')
    <form action="{{ route('admin.main-slider.save') }}" onsubmit="return sliderSave(this, event)">
        <input type="hidden" name="id" value="{{ $slide->id }}">

        <div class="box box-solid">
            <div class="box-body">

                {!! Form::groupText('name', $slide->name, 'Заголовок') !!}
                {!! Form::groupTextarea('text', $slide->text, 'Текст') !!}
                {!! Form::groupText('url', $slide->url, 'Ссылка') !!}

                <div class="form-group" style="display: flex; column-gap: 30px;">
                    <div>
                        <label for="article-image">Изображение (1920x660)</label>
                        <input id="article-image" type="file" name="image"
                               accept=".jpg,.jpeg,.png"
                               onchange="return sliderImageAttache(this, event)">
                        <div id="slider-image-block">
                            @if ($slide->image)
                                <img class="img-polaroid"
                                     src="{{ $slide->image_src }}" width="200"
                                     data-image="{{ $slide->image_src }}"
                                     onclick="return popupImage($(this).data('image'))" alt="">
                                <a class="images_del"
                                   href="{{ route('admin.main-slider.image-delete', $slide->id) }}"
                                   onclick="return sliderImageDel(this, event)">
                                    <span class="glyphicon glyphicon-trash text-red"></span>
                                </a>
                            @else
                                <p class="text-yellow">Изображение не загружено.</p>
                            @endif
                        </div>
                    </div>
                </div>
                {!! Form::groupCheckbox('published', 1, $slide->published, 'Показывать слайд') !!}
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@stop
