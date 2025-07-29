@if(isset($catalog_menu) && $catalog_menu)
    <nav class="menu">
        <ul class="menu__list">
            @foreach($catalog_menu as $catalog)
                <li class="menu__item">
                        <span class="menu__head {{ $catalog->isActive ? 'is-active' : '' }}"
                              data-menu-head="data-menu-head">
                            <a class="menu__link" href="{{ $catalog->url }}"
                               title="{{ $catalog->name }}">{{ $catalog->name }}</a>
                            <button class="menu__btn btn-reset" type="button" data-menu-button="data-menu-button"
                                    aria-label="Показать каталог {{ $catalog->name }}">
                                 @if(count($catalog->public_children))
                                    <svg class="svg-sprite-icon icon-caret" width="1em" height="1em">
                                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret"></use>
                                </svg>
                                @endif
                            </button>
                        </span>
                    @if(count($catalog->public_children))
                        <ul class="menu__sublist {{ $catalog->isActive ? 'is-active' : '' }}"
                            data-menu-list="data-menu-list">
                            @foreach($catalog->public_children as $children)
                                <li class="menu__sublist-item">
                                    <a class="menu__sublist-link {{ $children->isActive ? 'is-active' : '' }}"
                                       href="{{ $children->url }}" data-link="data-link">{{ $children->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
@endif