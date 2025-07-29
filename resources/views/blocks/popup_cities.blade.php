<div class="cities-page">
    <div class="cities-page__title">Выберите регион:</div>
    <div class="cities-page__current_popup"
         data-home="{{ route('main') }}"
         data-current="{{ url()->previous() }}">
        <a class="cities-page__link" href="{{ route('main') }}" data-id="0">
            @if(!session('city_alias'))
                <span style="color: var(--error)">Екатеринбург</span>
            @else
                Екатеринбург
            @endif
        </a>
    </div>

    <div class="cities-page__content">
        @foreach($cities as $letter => $letterCities)
            <ul class="cities-page__list">
                <li class="cities-page__label">{{ $letter }}</li>
                @foreach($letterCities as $letterCity)
                    <li>
                        <a class="cities-page__link"
                           data-id="{{ $letterCity->id }}"
                           href="{{ url($letterCity->alias) }}"
                           rel="nofollow">
                            @if(session('city_alias') == $letterCity->alias )
                                <span style="color: var(--error)">{{ $letterCity->name }}</span>
                            @else
                                {{ $letterCity->name }}
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
</div>

