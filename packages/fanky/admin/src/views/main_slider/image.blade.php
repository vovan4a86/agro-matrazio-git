<span class="images_item" data-id="{{ $item->id }}">
	<img class="img-polaroid" src="{{ $item->src }}" width="60" height="60"
		 style="cursor:pointer; background-color: #2c3b41" data-image="{{ $item->src }}"
		 onclick="popupImage('{{ $item->src }}')">
	<a class="images_del" href="{{ route('admin.main-slider.feat-del', $item->id) }}"
	   onclick="return featDelete(this)">
		<span class="glyphicon glyphicon-trash"></span>
	</a>
	<a class="images_edit" href="{{ route('admin.main-slider.feat-edit', [$item->id]) }}"
	   onclick="featEdit(this, event)"><span class="glyphicon glyphicon-edit"></span></a>
</span>
