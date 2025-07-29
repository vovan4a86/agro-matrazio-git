@extends('admin::template')

@section('scripts')
    <script type="text/javascript" src="/adminlte/interface_main_slider.js"></script>
@stop

@section('page_name')
    <h1>Слайдер
        <small><a href="{{ route('admin.main-slider.edit') }}">Добавить слайд</a></small>
    </h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Слайдер</li>
    </ol>
@stop

@section('content')
    @if (isset($main_slider) && count($main_slider))
        <table class="table table-striped table-v-middle">
            <tbody id="main-slider-list">
            @foreach ($main_slider as $item)
                <tr data-id="{{ $item->id }}">
                    <td width="40"><i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i></td>
                    <td width="100">
                        @if($item->image)
                            <img src="{{ $item->image_src }}" width="100" alt="slider">
                        @endif
                    </td>
                    <td width="400">{{ $item->name }}</td>
                    <td>{{ $item->text }}</td>
                    <td>{{ $item->url }}</td>
                    <td width="60">
                        <a class="glyphicon glyphicon-edit"
                           href="{{ route('admin.main-slider.edit', $item->id) }}"
                           style="font-size:20px; color:orange;"></a>
                    </td>
                    <td width="60">
                        <a class="glyphicon glyphicon-trash"
                           href="{{ route('admin.main-slider.delete', $item->id) }}"
                           style="font-size:20px; color:red;" onclick="sliderDel(this, event)"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <script type="text/javascript">
            $("#main-slider-list").sortable({
                update: function (event, ui) {
                    const url = "{{ route('admin.main-slider.reorder') }}";
                    let data = {};
                    data.sorted = ui.item.closest('#main-slider-list').sortable("toArray", {attribute: 'data-id'});
                    sendAjax(url, data);
                }
            }).disableSelection();
        </script>
    @else
        <p>Нет слайдов!</p>
    @endif
@stop
