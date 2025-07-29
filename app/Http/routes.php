<?php

use App\Http\Controllers\AjaxController;

Route::get('robots.txt', 'PageController@robots')->name('robots');

Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::post('add-to-cart', [AjaxController::class, 'postAddToCart'])->name('add-to-cart');
    Route::post('update-to-cart', [AjaxController::class, 'postUpdateToCart'])->name('update-to-cart');
    Route::post('remove-from-cart', [AjaxController::class, 'postRemoveFromCart'])->name('remove-from-cart');

    Route::post('free-calc', [AjaxController::class, 'postFreeCalc'])->name('free-calc'); //бесплатный расчет
    Route::post('request-calc', [AjaxController::class, 'postRequestCalc'])->name('request-calc'); //заявка на расчёт
    Route::post('callback', [AjaxController::class, 'postCallback'])->name('callback'); //обратный звонок
    Route::post('question', [AjaxController::class, 'postQuestion'])->name('question'); //задать вопрос
    Route::post('invite', [AjaxController::class, 'postInvite'])->name('invite'); //заказать замерщика
    Route::post('order', [AjaxController::class, 'postOrder'])->name('order');

    //+
    Route::get('show-popup-cities', [AjaxController::class, 'showCitiesPopup'])->name('show-popup-cities');
    Route::post('set-city', [AjaxController::class, 'postSetCity'])->name('set-city');
    Route::post('get-correct-region-link', [AjaxController::class, 'postGetCorrectRegionLink'])
        ->name('get-correct-region-link');
});

Route::group(['middleware' => ['redirects', 'regions']], function() {
    $cities = getCityAliases();
    $cities = implode('|', $cities);
    Route::group(
        [
            'prefix' => '{city}',
            'as' => 'region.',
            'where' => ['city' => $cities]
        ],
        function () use ($cities) {
            Route::get('/', ['as' => 'index', 'uses' => 'PageController@page']);
            Route::group(
                ['prefix' => 'catalog', 'as' => 'catalog.'],
                function () {
                    Route::any('/', ['as' => 'index', 'uses' => 'CatalogController@index']);
                    Route::any('{alias}', ['as' => 'view', 'uses' => 'CatalogController@view'])
                        ->where('alias', '([A-Za-z0-9\-\/_]+)');
                }
            );

            Route::any('{alias}', ['as' => 'pages', 'uses' => 'PageController@region_page'])
                ->where('alias', '([A-Za-z0-9\-\/_]+)');
        }
    );

    Route::get('/', ['as' => 'main', 'uses' => 'WelcomeController@index']);

    Route::any('discount', ['as' => 'discount', 'uses' => 'CatalogController@discount']);
    Route::any('search', ['as' => 'search', 'uses' => 'CatalogController@search']);

    Route::any('news', ['as' => 'news', 'uses' => 'NewsController@index']);
    Route::get('news/{alias}', ['as' => 'news.item', 'uses' => 'NewsController@item']);

    Route::any('publications', ['as' => 'publications', 'uses' => 'PublicationsController@index']);
    Route::get('publications/{alias}', ['as' => 'publications.item', 'uses' => 'PublicationsController@item']);

    Route::any('our-objects', ['as' => 'objects', 'uses' => 'ObjectsController@index']);
    Route::get('our-objects/{id?}', ['as' => 'objects.item', 'uses' => 'ObjectsController@item']);

    Route::any('brands', ['as' => 'brands', 'uses' => 'BrandsController@index']);
    Route::get('brands/{alias}', ['as' => 'brands.item', 'uses' => 'BrandsController@item']);

    Route::get('cart', ['as' => 'cart', 'uses' => 'CartController@getIndex']);

    Route::get('policy', ['as' => 'policy', 'uses' => 'PageController@policy']);

    Route::any('catalog', ['as' => 'catalog.index', 'uses' => 'CatalogController@index']);
    Route::any('catalog/{alias}', ['as' => 'catalog.view', 'uses' => 'CatalogController@view'])
        ->where('alias', '([A-Za-z0-9\-\/_]+)');

    Route::any('{alias}', ['as' => 'default', 'uses' => 'PageController@page'])
        ->where('alias', '([A-Za-z0-9\-\/_]+)');
});
