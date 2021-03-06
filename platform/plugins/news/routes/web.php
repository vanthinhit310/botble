<?php

Route::group(['namespace' => 'Botble\News\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'news'], function () {

            Route::get('/', [
                'as' => 'news.list',
                'uses' => 'NewsController@getList',
            ]);

            Route::get('/create', [
                'as' => 'news.create',
                'uses' => 'NewsController@getCreate',
            ]);

            Route::post('/create', [
                'as' => 'news.create',
                'uses' => 'NewsController@postCreate',
            ]);

            Route::get('/edit/{id}', [
                'as' => 'news.edit',
                'uses' => 'NewsController@getEdit',
            ]);

            Route::post('/edit/{id}', [
                'as' => 'news.edit',
                'uses' => 'NewsController@postEdit',
            ]);

            Route::get('/delete/{id}', [
                'as' => 'news.delete',
                'uses' => 'NewsController@getDelete',
            ]);

            Route::post('/delete-many', [
                'as' => 'news.delete.many',
                'uses' => 'NewsController@postDeleteMany',
                'permission' => 'news.delete',
            ]);
        });
    });
    Route::group(['prefix'=> 'news', 'middleware' => 'web'], function (){
        Route::get('list',[
           'as' => 'public.news' ,
            'uses' => 'NewsController@getNews'
        ]);
        Route::get('{slug}',[
            'as' => 'public.news.details' ,
            'uses' => 'NewsController@getNewsDetails'
        ]);
    });
});
