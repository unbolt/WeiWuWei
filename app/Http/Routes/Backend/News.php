<?php

Route::group([
    'prefix'     => 'news',
    'namespace'  => 'News',
    'middleware' => 'access.routeNeedsPermission:create-news',
], function() {
    Route::get('/', [
        'as'   => 'news::dashboard',
        'uses' => 'NewsController@dashboard',
    ]);

    Route::get('create', 'NewsController@create')->name('admin.news.create');
});

?>
