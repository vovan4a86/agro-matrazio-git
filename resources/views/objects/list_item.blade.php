<div class="card-obj">
    <a class="card-obj__view" href="{{ $item->url }}" title="{{ $item->name }}">
        @if($item->city)
            <div class="card-obj__badge">
                <div class="badge badge--sky">{{ $item->city }}</div>
            </div>
        @endif
        @if($item->image)
            <img class="card-obj__img" src="{{ $item->thumb(2) }}" width="407" height="306"
                 alt="{{ $item->name }}"
                 loading="lazy"/>
        @endif
    </a>
    <div class="card-obj__body">
        <a class="card-obj__title" href="{{ $item->url }}">{{ $item->name }}</a>
        <div class="card-obj__foot">
            <div class="card-obj__year">{{ $item->dateFormat('Y') }} год</div>
        </div>
    </div>
</div>