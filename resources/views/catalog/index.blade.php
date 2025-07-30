@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <!--section.catalog-->
        <section class="catalog page">
            <div class="catalog__container container">
                <div class="catalog__heading page__heading">
                    <div class="catalog__title page__title">Каталог продукции</div>
                </div>
                <div class="catalog__grid">
                    <div class="catalog__main">
                        <!--.prods-view-->
                        <div class="prods-view">
                            <div class="prods-view__bg lazy" data-bg="static/images/common/prods-view-1.webp"></div>
                            <div class="prods-view__body">
                                <a class="prods-view__head" href="javascript:void(0)">Резиновые маты для содержания
                                    КРС</a>
                                <ul class="prods-view__list list-reset">
                                    <li class="prods-view__list-item">
                                        <a class="prods-view__list-link" href="javascript:void(0)">Матрасная система в
                                            боксы для отдыха</a>
                                    </li>
                                    <li class="prods-view__list-item">
                                        <a class="prods-view__list-link" href="javascript:void(0)">Рулонные резиновые
                                            покрытия для содержания</a>
                                    </li>
                                    <li class="prods-view__list-item">
                                        <a class="prods-view__list-link" href="javascript:void(0)">Беспривязное
                                            содержание в боксы для отдыха</a>
                                    </li>
                                    <li class="prods-view__list-item">
                                        <a class="prods-view__list-link" href="javascript:void(0)">Привязное содержание
                                            в стойло-место</a>
                                    </li>
                                    <li class="prods-view__list-item">
                                        <a class="prods-view__list-link" href="javascript:void(0)">Навозные проходы,
                                            галереи в том числе для щелевых полов</a>
                                    </li>
                                    <li class="prods-view__list-item">
                                        <a class="prods-view__list-link" href="javascript:void(0)">Переходы, галереи,
                                            зоны поилок и чесалок</a>
                                    </li>
                                    <li class="prods-view__list-item">
                                        <a class="prods-view__list-link" href="javascript:void(0)">ДМБ, накопители, для
                                            доильных установок в том числе Карусель</a>
                                    </li>
                                    <li class="prods-view__list-item">
                                        <a class="prods-view__list-link" href="javascript:void(0)">Родильное отделение,
                                            для содержания молодняка и МРС</a>
                                    </li>
                                    <li class="prods-view__list-item">
                                        <a class="prods-view__list-link" href="javascript:void(0)">Покрытия для
                                            передвижения людей</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="catalog__other">
                        <!--.prods-view-->
                        <div class="prods-view">
                            <div class="prods-view__bg lazy" data-bg="static/images/common/prods-view-2.webp"></div>
                            <div class="prods-view__body">
                                <a class="prods-view__head" href="javascript:void(0)">Стальные каркасы для ферм</a>
                            </div>
                        </div>
                    </div>
                    <div class="catalog__brand">
                        <!--.brand-label-->
                        <div class="brand-label">
                            <span class="brand-label__title">В комплекте всегда выгоднее!</span>
                            <img class="brand-label__img no-select" src="static/images/common/brand-label.svg"
                                 width="168" height="57" alt="alt" loading="lazy"/>
                        </div>
                    </div>
                </div>
                <div class="catalog__titles">
                    <div class="page__subtitle">При покупке любого стойлового оборудования производства «Завода
                        Агросталь» вы получаете индивидуальные условия на приобретение резиновых покрытий для вашей
                        фермы
                    </div>
                    <div class="page__subtitle">Мы долгие годы сотрудничаем с проектными организациями и производителями
                        стальных каркасов для коровников.
                    </div>
                </div>
                <div class="catalog__text text-block">
                    <p>При обращении к нам, мы заложим на этапе проектирования стойловое оборудование производства
                        «Завода Агросталь».</p>
                    <p>Вы получите каркас по цене завода изготовителя с готовой планировкой стойлового оборудования,
                        понятным качеством и сроками поставки. Это позволит сэкономить ваши средства и время при
                        проектировании, монтаже и вводе в эксплуатацию объекта.</p>
                    <p>
                        <strong>За подробной консультацией обращайтесь в отдел продаж «Агросталь Комплект»</strong>
                    </p>
                </div>
            </div>
        </section>
    </main>
    @include('blocks.callback')
@endsection