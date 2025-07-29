<aside class="layout__aside">
    @include('catalog.aside_menu')
    <!--.filter-->
    <form class="filter" action="{{ $category->url ?? route('catalog.index') }}">
        <button class="filter__toggle btn-reset" type="button" data-filter-toggle="data-filter-toggle"
                aria-label="Показать / скрыть фильтр">
            <svg class="svg-sprite-icon icon-filter" width="1em" height="1em">
                <use xlink:href="/static/images/sprite/symbol/sprite.svg#filter"></use>
            </svg>
            <span>Показать фильтр</span>
        </button>
        <div class="filter__view" data-filter-view="data-filter-view">
            <div class="filter__heading">
                @include('catalog.filter_title')
                <button class="filter__reset btn-reset" type="reset" aria-label="Сбросить">Сбросить</button>
            </div>
            <div class="filter__body">
                <!--.h-group(x-data="{ isOpen: false }")-->
                <div class="h-group" x-data="{ isOpen: true }" :class="isOpen &amp;&amp; 'is-active'">
                    <button class="h-group__head btn-reset" @click="isOpen = !isOpen"
                            :class="isOpen &amp;&amp; 'is-active'" type="button"
                            aria-label="Показать Диапазон цен, руб.">
                        <span class="h-group__title">Диапазон цен, руб.</span>
                        <svg class="svg-sprite-icon icon-caret" width="1em" height="1em">
                            <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret"></use>
                        </svg>
                    </button>
                    <div class="h-group__body" :class="isOpen &amp;&amp; 'is-active'">
                        <div class="filter__list">
                            <div class="filter__ranges">
                                <div class="filter__inputs">
                                    <label class="filter__inputs-label" data-prefix="от">
                                        <input class="filter__input filter__input--from"
                                               name="price_from" type="number" value="0"/>
                                    </label>
                                    <div class="filter__input-label">-</div>
                                    <label class="filter__inputs-label" data-prefix="до">
                                        <input class="filter__input filter__input--to"
                                               name="price_to" type="number" value="{{ $filter_max_price }}"/>
                                    </label>
                                </div>
                                <input class="filter__range js-range-slider"
                                       data-type="double"
                                       data-min="{{ $filter_min_price }}"
                                       data-max="{{ $filter_max_price }}"
                                       data-from="0"
                                       data-to="{{ $filter_max_price }}"
                                       data-step="100"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!--.h-group(x-data="{ isOpen: false }")-->
                @if(count($filter_brands))
                    <div class="h-group" x-data="{ isOpen: false }" :class="isOpen &amp;&amp; 'is-active'">
                        <button class="h-group__head btn-reset" @click="isOpen = !isOpen"
                                :class="isOpen &amp;&amp; 'is-active'" type="button" aria-label="Показать Бренд">
                            <span class="h-group__title">Бренд</span>
                            <svg class="svg-sprite-icon icon-caret" width="1em" height="1em">
                                <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret"></use>
                            </svg>
                        </button>
                        <div class="h-group__body" :class="isOpen &amp;&amp; 'is-active'">
                            <div class="filter__list">
                                @foreach($filter_brands as $id => $name)
                                    <label class="c-checkbox">
                                        <input class="c-checkbox__input" type="checkbox" name="brand[]"
                                               value="{{ $id }}"/>
                                        <span class="c-checkbox__box"></span>
                                        <span class="c-checkbox__label">{{ $name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
{{--                @if(count($filter_countries))--}}
{{--                    <div class="h-group" x-data="{ isOpen: false }" :class="isOpen &amp;&amp; 'is-active'">--}}
{{--                        <button class="h-group__head btn-reset" @click="isOpen = !isOpen"--}}
{{--                                :class="isOpen &amp;&amp; 'is-active'" type="button"--}}
{{--                                aria-label="Показать Страна производства">--}}
{{--                            <span class="h-group__title">Страна производства</span>--}}
{{--                            <svg class="svg-sprite-icon icon-caret" width="1em" height="1em">--}}
{{--                                <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret"></use>--}}
{{--                            </svg>--}}
{{--                        </button>--}}
{{--                        <div class="h-group__body" :class="isOpen &amp;&amp; 'is-active'">--}}
{{--                            <div class="filter__list">--}}
{{--                                @foreach($filter_countries as $id => $country)--}}
{{--                                    <label class="c-checkbox">--}}
{{--                                        <input class="c-checkbox__input" type="checkbox" name="country[]"--}}
{{--                                               value="{{ $id }}"/>--}}
{{--                                        <span class="c-checkbox__box"></span>--}}
{{--                                        <span class="c-checkbox__label">{{ $country }}</span>--}}
{{--                                    </label>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}

                @foreach($filters_list as $filter_en => $values)
                    <div class="h-group" x-data="{ isOpen: false }" :class="isOpen &amp;&amp; 'is-active'">
                        <button class="h-group__head btn-reset" @click="isOpen = !isOpen"
                                :class="isOpen &amp;&amp; 'is-active'" type="button"
                                aria-label="Показать {{ $values['name'] }}">
                            <span class="h-group__title">{{ $values['name'] }}</span>
                            <svg class="svg-sprite-icon icon-caret" width="1em" height="1em">
                                <use xlink:href="/static/images/sprite/symbol/sprite.svg#caret"></use>
                            </svg>
                        </button>
                        <div class="h-group__body" :class="isOpen &amp;&amp; 'is-active'">
                            @if(count($values['values']))
                                <div class="filter__list">
                                    @foreach($values['values'] as $val)
                                        <label class="c-checkbox">
                                            <input class="c-checkbox__input" type="checkbox"
                                                   name="{{ $filter_en }}[]" value="{{ $val }}"/>
                                            <span class="c-checkbox__box"></span>
                                            <span class="c-checkbox__label">{{ $val }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </form>
</aside>