<div class="newses__item faded is-active" data-newses-view="{{ $item->type == 1 ? 'news' : 'action'}}">
    <div class="card-obj">
        <a class="card-obj__view" href="{{ $item->url }}" title="{{ $item->name }}">
            <span class="card-obj__badge">
                @if($item->type == 1)
                    <div class="badge badge--sky">Новость</div>
                @else
                    <div class="badge badge--alert">Акция</div>
                @endif
            </span>
            @if($item->image)
                <img class="card-obj__img" src="{{ $item->thumb(2) }}" width="407" height="306" alt="{{ $item->name }}"
                     loading="lazy"/>
            @endif
        </a>
        <div class="card-obj__body">
            <a class="card-obj__title" href="{{ $item->url }}" title="{{ $item->name }}">{{ $item->name }}</a>
            @if($item->announce)
                <div class="card-obj__text">
                    <p>{{ $item->announce }}</p>
                </div>
            @endif
            <div class="card-obj__foot">
                <div class="card-obj__year">{{ $item->dateFormat('d.m.Y') }}</div>
                <div class="card-obj__link">Подробнее</div>
            </div>
        </div>
    </div>
</div>
