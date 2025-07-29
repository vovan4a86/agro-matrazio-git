<div class="mob-nav">
    <div class="mob-nav__top">
        <div class="mob-nav__container mob-nav__container--top container">
            <button class="mob-nav__burger hamburger hamburger--collapse" type="button" aria-label="Открыть меню" :class="overlayIsOpen &amp;&amp; 'is-active'" @click="overlayIsOpen = true">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
            </button>
            <a class="mob-nav__logo" href="javascript:void(0)" title="На главную" aria-label="На главную">
                <img class="mob-nav__pic" src="/static/images/common/logo--mobile.svg" width="88" height="30" alt="Агросталь-Комплект" />
            </a>
            <button class="mob-nav__actions btn-reset" type="button" data-popup="data-popup" data-src="#write-popup" aria-label="Написать нам">
                <svg class="svg-sprite-icon icon-mail" width="1em" height="1em">
                    <use xlink:href="/static/images/sprite/symbol/sprite.svg#mail"></use>
                </svg>
            </button>
        </div>
    </div>
</div>