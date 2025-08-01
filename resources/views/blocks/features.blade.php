@if($main_features = S::get('main_features'))
    <div class="s-about__bottom">
        <div class="s-about__container container">
            <div class="s-about__heading page__heading">
                <div class="s-about__title page__title">{{ $title ?? 'Наши преимущества' }}</div>
            </div>
            <div class="s-about__feats">
                @foreach($main_features as $feat)
                    <div class="feat-item">
                        @if($feat['ico'])
                            <div class="feat-item__view">
                                <div class="feat-item__icon lazy"
                                     data-bg="{{ S::fileSrc($feat['ico']) }}"></div>
                            </div>
                        @endif
                        @if($feat['text'])
                            <div class="feat-item__title">{{ $feat['text'] }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <img class="s-about__decor no-select" src="/static/images/common/about-decor.png" width="410"
             height="507" loading="lazy" alt="Агросталь-Комплект"/>
    </div>
@endif