@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.catalog') }}"><i class="fa fa-list"></i> Каталог</a></li>
        @foreach($product->getParents(false, true) as $parent)
            <li><a href="{{ route('admin.catalog.products', [$parent->id]) }}">{{ $parent->name }}</a></li>
        @endforeach
        <li class="active">{{ $product->id ? $product->name : 'Новый товар' }}</li>
    </ol>
@stop
@section('page_name')
    <h1>Каталог
        <small style="max-width: 350px;">{{ $product->id ? $product->name : 'Новый товар' }}</small>
    </h1>
@stop

<form action="{{ route('admin.catalog.productSave') }}" onsubmit="return productSave(this, event)">
    {!! Form::hidden('id', $product->id) !!}

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Параметры</a></li>
            <li><a href="#tab_catalogs" data-toggle="tab">Доп каталоги</a></li>
            <li><a href="#tab_2" data-toggle="tab">Текст</a></li>
            <li><a href="#tab_chars" data-toggle="tab">Характеристики</a></li>
            <li><a href="#tab_4" data-toggle="tab">Изображения</a></li>
            <li><a href="#tab_related" data-toggle="tab">Связанные товары</a></li>
{{--            <li><a href="#tab_docs" data-toggle="tab">Документы</a></li>--}}
            <li class="pull-right">
                <a href="{{ route('admin.catalog.products', [$product->catalog_id]) }}"
                   onclick="return catalogContent(this)">К списку товаров</a>
            </li>
            @if($product->id)
                <li class="pull-right">
                    <a href="{{ $product->url }}" target="_blank">Посмотреть</a>
                </li>
            @endif
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                {!! Form::groupText('name', $product->name, 'Название') !!}
                {!! Form::groupText('h1', $product->h1, 'H1') !!}
                {!! Form::groupSelect('catalog_id', $catalogs, $product->catalog_id, 'Каталог') !!}
{{--                {!! Form::groupText('article', $product->article, 'Артикул') !!}--}}
                {!! Form::groupSelect('brand_id', array_merge([0 => 'Не указано'], $brands), $product->brand_id, 'Бренд') !!}
                {!! Form::groupText('alias', $product->alias, 'Alias') !!}
                {!! Form::groupText('title', $product->title, 'Title') !!}
                {!! Form::groupText('keywords', $product->keywords, 'keywords') !!}
                {!! Form::groupText('description', $product->description, 'description') !!}
                {!! Form::groupText('price', $product->price ?: 0, 'Цена') !!}
                {!! Form::groupText('old_price', $product->old_price ?: 0, 'Старая цена') !!}
                {!! Form::groupText('measure', $product->measure ?: 'шт', 'Измерение') !!}
                {!! Form::groupText('delivery', $product->delivery, 'Доставка') !!}

                <hr>
                {!! Form::hidden('in_stock', 0) !!}
                {!! Form::groupCheckbox('published', 1, $product->published, 'Показывать товар') !!}
                {!! Form::groupCheckbox('in_stock', 1, $product->in_stock, 'В наличии') !!}
                {!! Form::groupCheckbox('is_popular', 1, $product->is_popular, 'Популярный товар') !!}
                {!! Form::groupCheckbox('is_new', 1, $product->is_new, 'Новинка') !!}
            </div>

            <div class="tab-pane" id="tab_catalogs">
                @include('admin::catalog.tab_catalogs')
            </div>

            <div class="tab-pane" id="tab_2">
                {!! Form::groupRichtext('text', $product->text, 'Текст') !!}
            </div>

            <div class="tab-pane" id="tab_chars">
                {!! Form::groupText('sizes', $product->sizes, 'Размеры, см') !!}
                {!! Form::groupText('square', $product->square, 'Площадь остекления, м2') !!}
                {!! Form::groupText('configuration', $product->configuration, 'Конфигурация') !!}
                {!! Form::groupText('manufacturer', $product->manufacturer, 'Производитель') !!}
                {!! Form::groupText('material', $product->material, 'Материал') !!}
                {!! Form::groupText('type', $product->type, 'Тип') !!}
                {!! Form::groupText('handle', $product->handle, 'Ручка') !!}

                <h4>Дополнительные параметры</h4>
                @if(!$product->id)
                    <div>Добавление дополнительных параметров доступно только после сохранения товара</div>
                @else
                    <table class="table table-hover table-condensed" id="param_list">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Значение</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($product->params as $param)
                            @include('admin::catalog.param_row', ['param' => $param])
                        @endforeach
                        </tbody>
                    </table>

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <input type="text" class="param-name form-control" placeholder="Название">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="param-value form-control" placeholder="Значение">
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('admin.catalog.add_param', $product->id) }}" onclick="addParam(this, event)"
                               class="btn btn-primary add-param">Добавить
                                параметр</a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="tab-pane" id="tab_4">
                <input id="product-image" type="hidden" name="image" value="{{ $product->image }}">
                @if ($product->id)
                    <div class="form-group">
                        <label class="btn btn-success">
                            <input id="offer_imag_upload" type="file" multiple
                                   data-url="{{ route('admin.catalog.productImageUpload', $product->id) }}"
                                   style="display:none;" onchange="productImageUpload(this, event)">
                            Загрузить изображения
                        </label>
                    </div>

                    <div class="images_list">
                        @foreach ($product->images as $image)
                            @include('admin::catalog.product_image', ['image' => $image, 'active' => $product->image])
                        @endforeach
                    </div>
                @else
                    <p class="text-yellow">Изображения можно будет загрузить после сохранения товара!</p>
                @endif
            </div>

            <div class="tab-pane" id="tab_related">
                @include('admin::catalog.product_edit_tabs.tab_related')
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(".images_list").sortable({
        update: function (event, ui) {
            var url = "{{ route('admin.catalog.productImageOrder') }}";
            var data = {};
            data.sorted = $('.images_list').sortable("toArray", {attribute: 'data-id'});
            sendAjax(url, data);
        },
    }).disableSelection();

    $("#param_list tbody").sortable({
        update: function (event, ui) {
            var url = "{{ route('admin.catalog.productParamOrder') }}";
            var data = {};
            data.sorted = $('#param_list tbody').sortable("toArray", {attribute: 'data-id'});
            sendAjax(url, data);
            //console.log(data);
        },
    }).disableSelection();
</script>
