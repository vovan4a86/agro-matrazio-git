@extends('admin::template')

@section('scripts')
	<script type="text/javascript" src="/adminlte/interface_news.js"></script>
@stop

@section('page_name')
	<h1>Статьи
		<small><a href="{{ route('admin.publications.edit') }}">Добавить статью</a></small>
	</h1>
@stop

@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active">Статьи</li>
	</ol>
@stop

@section('content')
	<div class="box box-solid">
		<div class="box-body">
			@if (count($publications))
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="150">Дата</th>
							<th width="100">Изображение</th>
							<th>Название</th>
							<th>Анонс</th>
							<th width="50"></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($publications as $item)
							<tr>
								<td>{{ $item->dateFormat() }}</td>
								<td style="text-align: center;">
									@if($item->image)
										<img src="{{ $item->thumb(1) }}" alt="{{ $item->name }}">
									@endif
								</td>
								<td><a href="{{ route('admin.publications.edit', [$item->id]) }}"
									   style="text-decoration: {{ !$item->published ? 'line-through' : 'none' }}">{{ $item->name }}</a></td>
								<td><a href="{{ route('admin.publications.edit', [$item->id]) }}"
									   style="text-decoration: {{ !$item->published ? 'line-through' : 'none' }}">{{ str_limit($item->announce) }}</a></td>
								<td>
									<a class="glyphicon glyphicon-trash" href="{{ route('admin.publications.delete', [$item->id]) }}"
									   style="font-size:20px; color:red;" title="Удалить" onclick="return newsDel(this)"></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{!! Pagination::render('admin::pagination') !!}
			@else
				<p>Нет статей!</p>
			@endif
		</div>
	</div>
	<style>
		.table tbody tr td {
			vertical-align: middle;
		}
	</style>
@stop
