<?php
Route::group([
    'prefix'     => 'news'
], function() {

    Route::get('/', [
            'as' => 'admin.news.index',
            'uses' => 'News\NewsController@index'
        ]);

    Route::get('create', [
            'as' => 'admin.news.create',
            'uses' => 'News\NewsController@create'
        ]);

    Route::post('store', [
            'as' => 'admin.news.store',
            'uses' => 'News\NewsController@store'
        ]);

    Route::get('{id}/edit', [
            'as' => 'admin.news.edit',
            'uses' => 'News\NewsController@edit'
        ]);

    Route::put('{id}', [
            'as' => 'admin.news.update',
            'uses' => 'News\NewsController@update'
        ]);

    Route::delete('{id}', [
            'as' => 'admin.news.destroy',
            'uses' => 'News\NewsController@destroy'
        ]);

});


?>
