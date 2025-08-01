<div class="c-overlay" :class="overlayIsOpen &amp;&amp; 'is-active'" x-cloak="x-cloak">
    <div class="c-overlay__item">
        <button class="city-btn btn-reset" type="button" data-src="{{ route('ajax.show-popup-cities') }}"
                data-cities data-type="ajax">
            <svg class="svg-sprite-icon icon-pin" width="1em" height="1em">
                <use xlink:href="/static/images/sprite/symbol/sprite.svg#pin"></use>
            </svg>
            <span class="city-btn__label">Екатеринбург</span>
        </button>
        <button class="c-overlay__close btn-reset" type="button" aria-label="Закрыть меню"
                @click="overlayIsOpen = false">
            <svg class="svg-sprite-icon icon-close" width="1em" height="1em">
                <use xlink:href="/static/images/sprite/symbol/sprite.svg#close"></use>
            </svg>
        </button>
    </div>
    <div class="c-overlay__item">
        <nav class="c-overlay__nav">
            <ul class="c-overlay__nav-list">
                @foreach($mobile_menu as $mob_item)
                    <li class="c-overlay__nav-item">
                        <a class="c-overlay__nav-link" href="{{ $mob_item->url }}">
                            <span>{{ $mob_item->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
    <div class="c-overlay__item">
        <ul class="links list-reset">
            @if($wa = S::get('soc_wa'))
                <li class="links__item">
                    <a class="links__link" href="{{ $wa }}">
                        <span class="links__icon lazy" data-bg="/static/images/common/ico_wa.svg"></span>
                        <span class="links__label">whatsapp</span>
                    </a>
                </li>
            @endif
            @if($tg = S::get('soc_tg'))
                <li class="links__item">
                    <a class="links__link" href="{{ $tg }}">
                        <span class="links__icon lazy" data-bg="/static/images/common/ico_tg.svg"></span>
                        <span class="links__label">telegram</span>
                    </a>
                </li>
            @endif
            @if($email = S::get('header_email'))
                <li class="links__item">
                    <a class="links__link" href="mailto:{{ $email }}">
                        <span class="links__icon lazy" data-bg="/static/images/common/ico_mail.svg"></span>
                        <span class="links__label">{{ $email }}</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    @if($phone = S::get('header_phone'))
        <div class="c-overlay__item">
            <a class="phone" href="tel:{{ SiteHelper::clearPhone($phone) }}" title="Позвонить нам" aria-label="Позвонить нам">
					<span class="phone__body">
						<svg class="svg-sprite-icon icon-phone" width="1em" height="1em">
							<use xlink:href="/static/images/sprite/symbol/sprite.svg#phone"></use>
						</svg>
						<span class="phone__num">{{ $phone }}</span>
					</span>
                <span class="phone__label">Звонок по России бесплатный</span>
            </a>
        </div>
    @endif
    <div class="c-overlay__item">
        <button class="btn btn-reset" type="button" data-popup="data-popup" data-src="#write-popup"
                aria-label="Написать нам">Написать нам
        </button>
    </div>
</div>
<div class="c-overlay c-overlay--backdrop" :class="overlayIsOpen &amp;&amp; 'is-active'"
     @click="overlayIsOpen = false"></div>