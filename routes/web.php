<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'test'], function () {
    Route::get('test', [
        'uses' => 'TestController@test'
    ]);
    Route::get('news', [
        'uses' => 'TestController@crawlNews'
    ]);
    Route::get('views', [
        'uses' => 'TestController@getTestViews'
    ]);
    Route::get('find', [
        'uses' => 'TestController@find_replace'
    ]);
    Route::get('p/{id?}', [
        'as' => 'test.detail',
        'uses' => 'TestController@getDetails'
    ]);
    Route::get('vue', [
        'uses' => 'TestController@vueTest'
    ]);
    Route::get('vue-views', [
        'uses' => 'TestController@vueViews'
    ]);
});


Route::group(['prefix' => 'telegram'], function () {
    Route::get('/updated-activity', [
        'as' => 'update',
        'uses' => 'TelegramBotController@updatedActivity'
    ]);
});


Route::group([
    'as' => 'tracker.'
], function () {
    Route::group(['prefix' => 'tracker'], function () {
        Route::get('/route-data', [
            'as' => 'route',
            'uses' => 'Stats@routeData'
        ]);
    });
});

Route::group([
    'as' => 'practice.'
], function () {
    Route::group(['prefix' => 'practice'], function () {
        Route::get('/export-excel', [
            'as' => 'export',
            'uses' => 'PracticeController@exportExcel'
        ]);
    });
});
