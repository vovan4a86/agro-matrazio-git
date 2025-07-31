<?php

use App\Http\Controllers\AjaxController;

Route::get('robots.txt', 'PageController@robots')->name('robots');

Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::post('callback', [AjaxController::class, 'postCallback'])->name('callback');
    Route::post('write', [AjaxController::class, 'postWrite'])->name('write');
    Route::post('order', [AjaxController::class, 'postOrder'])->name('order');

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

    Route::any('contacts', ['as' => 'contacts', 'uses' => 'PageController@contacts']);
    Route::any('about', function() {
        abort(404, 'Страница не найдена');
    });

//    Route::any('news', ['as' => 'news', 'uses' => 'NewsController@index']);
//    Route::get('news/{alias}', ['as' => 'news.item', 'uses' => 'NewsController@item']);

    Route::any('catalog', ['as' => 'catalog.index', 'uses' => 'CatalogController@index']);
    Route::any('catalog/{alias}', ['as' => 'catalog.view', 'uses' => 'CatalogController@view'])
        ->where('alias', '([A-Za-z0-9\-\/_]+)');

    Route::any('{alias}', ['as' => 'default', 'uses' => 'PageController@page'])
        ->where('alias', '([A-Za-z0-9\-\/_]+)');
});
