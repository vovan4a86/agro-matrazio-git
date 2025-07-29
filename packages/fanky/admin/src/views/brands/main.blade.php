@extends('admin::template')

@section('scripts')
	<script type="text/javascript" src="/adminlte/interface_brands.js"></script>
@stop

@section('page_name')
	<h1>Бренды
		<small><a href="{{ route('admin.brands.edit') }}">Добавить бренд</a></small>
	</h1>
@stop

@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active">Производители</li>
	</ol>
@stop

@section('content')
	<div class="box box-solid">
		<div class="box-body">
			@if (count($brands))
				<table class="table table-striped table-v-middle">
					<tbody id="items-list">
						@foreach ($brands as $item)
							<tr data-id="{{ $item->id }}">
								<td width="40"><i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i></td>
								<td width="110" style="text-align: center">
									@if($item->image)
										<img src="{{ $item->image_src }}" alt="image" width="100">
									@else
										<span><b>{{ $item->name }}</b></span>
									@endif
								</td>
								<td>{{ $item->name }}</td>
								<td>{{ str_limit($item->announce, 100, '...') }}</td>
								<td>Товаров: {{ count($item->products) }}</td>
								<td width="150">{{ $item->on_main ? 'На главной' : '' }}</td>
								<td width="50"><a class="glyphicon glyphicon-edit" href="{{ route('admin.brands.edit', [$item->id]) }}"
												  style="font-size:20px; color:orange;"></a></td>
								<td width="50">
									<a class="glyphicon glyphicon-trash" href="{{ route('admin.brands.del', [$item->id]) }}"
									   style="font-size:20px; color:red;" onclick="brandDel(this, event, 'Удалить бренд?')"></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				<script type="text/javascript">
					$("#items-list").sortable({
						update: function( event, ui ) {
							var url = "{{ route('admin.brands.reorder') }}";
							var data = {};
							data.sorted = ui.item.closest('#items-list').sortable( "toArray", {attribute: 'data-id'} );
							sendAjax(url, data);
						}
					}).disableSelection();
				</script>
			@else
				<p>Нет брендов!</p>
			@endif
		</div>
	</div>
@stop