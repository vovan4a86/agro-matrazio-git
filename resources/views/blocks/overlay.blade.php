<div class="c-overlay" :class="overlayIsOpen &amp;&amp; 'is-active'" x-cloak="x-cloak">
    <div class="c-overlay__item">
        <button class="city-btn btn-reset" type="button" data-src="_ajax-cities.html" data-fancybox="data-fancybox" data-type="ajax">
            <svg class="svg-sprite-icon icon-pin" width="1em" height="1em">
                <use xlink:href="/static/images/sprite/symbol/sprite.svg#pin"></use>
            </svg>
            <span class="city-btn__label">Екатеринбург</span>
        </button>
        <button class="c-overlay__close btn-reset" type="button" aria-label="Закрыть меню" @click="overlayIsOpen = false">
            <svg class="svg-sprite-icon icon-close" width="1em" height="1em">
                <use xlink:href="/static/images/sprite/symbol/sprite.svg#close"></use>
            </svg>
        </button>
    </div>
    <div class="c-overlay__item">
        <nav class="c-overlay__nav">
            <ul class="c-overlay__nav-list">
                <li class="c-overlay__nav-item">
                    <a class="c-overlay__nav-link" href="javascript:void(0)">
                        <span>О компании</span>
                    </a>
                </li>
                <li class="c-overlay__nav-item">
                    <a class="c-overlay__nav-link" href="javascript:void(0)">
                        <span>Каталог</span>
                    </a>
                </li>
                <li class="c-overlay__nav-item">
                    <a class="c-overlay__nav-link" href="javascript:void(0)">
                        <span>Контакты</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="c-overlay__item">
        <ul class="links list-reset">
            <li class="links__item">
                <a class="links__link" href="javascript:void(0)">
                    <span class="links__icon lazy" data-bg="/static/images/common/ico_wa.svg"></span>
                    <span class="links__label">whatsapp</span>
                </a>
            </li>
            <li class="links__item">
                <a class="links__link" href="javascript:void(0)">
                    <span class="links__icon lazy" data-bg="/static/images/common/ico_tg.svg"></span>
                    <span class="links__label">telegram</span>
                </a>
            </li>
            <li class="links__item">
                <a class="links__link" href="mailto:zakaz@agrostal-komplekt.ru">
                    <span class="links__icon lazy" data-bg="/static/images/common/ico_mail.svg"></span>
                    <span class="links__label">zakaz@agrostal-komplekt.ru</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="c-overlay__item">
        <a class="phone" href="tel:8800445566" title="Позвонить нам" aria-label="Позвонить нам">
					<span class="phone__body">
						<svg class="svg-sprite-icon icon-phone" width="1em" height="1em">
							<use xlink:href="/static/images/sprite/symbol/sprite.svg#phone"></use>
						</svg>
						<span class="phone__num">8 800 44-55-66</span>
					</span>
            <span class="phone__label">Звонок по России бесплатный</span>
        </a>
    </div>
    <div class="c-overlay__item">
        <button class="btn btn-reset" type="button" data-popup="data-popup" data-src="#write-popup" aria-label="Написать нам">Написать нам
        </button>
    </div>
</div>
<div class="c-overlay c-overlay--backdrop" :class="overlayIsOpen &amp;&amp; 'is-active'" @click="overlayIsOpen = false"></div>