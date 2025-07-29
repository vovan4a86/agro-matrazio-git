@extends('admin::template')

@section('scripts')
	<script type="text/javascript" src="/adminlte/interface_brands.js"></script>
@stop

@section('page_name')
	<h1>
		Производители
		<small>{{ $brand->id ? 'Редактировать' : 'Новый' }}</small>
	</h1>
@stop

@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li><a href="{{ route('admin.brands') }}">Производители</a></li>
		<li class="active">{{ $brand->id ? 'Редактировать' : 'Новый' }}</li>
	</ol>
@stop

@section('content')
	<form action="{{ route('admin.brands.save') }}" onsubmit="return brandSave(this, event)">
		<input type="hidden" name="id" value="{{ $brand->id }}">

		<div class="box box-solid">
			@if($brand->id)
				<div class="pull-right" style="margin: 7px 20px">
					<a href="{{ $brand->url }}" target="_blank">Посмотреть</a>
				</div>
			@endif
			<div class="box-body">
				{!! Form::groupText('name', $brand->name, 'Название') !!}
{{--				{!! Form::groupText('country', $brand->country, 'Страна') !!}--}}
				{!! Form::groupTextarea('announce', $brand->announce, 'Анонс', ['rows' => 2]) !!}
				{!! Form::groupRichtext('text', $brand->text, 'Основной текст') !!}

				<div class="form-group" style="display: flex; column-gap: 30px;">
					<div>
						<label for="brand-image">Изображение (.svg 210x140)</label>
						<input id="brand-image" type="file" name="image"
							   accept=".svg" onchange="return brandImageAttache(this, event)">
						<div id="brand-image-block">
							@if ($brand->image)
								<img class="img-polaroid"
									 src="{{ $brand->image_src }}" height="100"
									 data-image="{{ $brand->image_src }}"
									 onclick="return popupImage($(this).data('image'))" alt="image">
							@else
								<p class="text-yellow">Изображение не загружено.</p>
							@endif
						</div>
					</div>
				</div>

				{!! Form::groupCheckbox('published', 1, $brand->published, 'Показывать производителя') !!}
				{!! Form::groupCheckbox('on_main', 1, $brand->on_main, 'Показывать на главной') !!}
			</div>

			<div class="box-footer">
    			<button type="submit" class="btn btn-primary">Сохранить</button>
    		</div>
		</div>
	</form>
@stop