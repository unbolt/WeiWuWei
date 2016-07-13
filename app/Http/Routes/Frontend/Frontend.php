<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('/roster', 'FrontendController@roster')->name('frontend.roster');

// Image routes - for the news stuff
Route::get('/news/image/{id}', 'ImageController@show');
Route::get('/news/image/blur/{id}', 'ImageController@blur');
Route::get('/news/image/small/{id}', 'ImageController@small');

/* Frontend raid controllers */
Route::group(['middleware' => 'access.routeNeedsPermission:access-raids'], function()
{
    Route::get('raids', 'RaidController@index');
    Route::get('raids/{id}-{slug}', 'RaidController@show');
    Route::get('raids/sign/{id}/{attending}', 'RaidController@sign');
    Route::post('raids/{id}/comments', 'RaidController@comment');
});

/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');

        // Profile edit routes
            Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
            Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');

            Route::get('character/{server}/{name}', 'ProfileController@characterSearch')->name('fontend.user.profile.character.search');
    });
});

Route::group(['namespace' => 'User'], function() {
    Route::get('character/{server}/{name}', 'ProfileController@characterSearch')->name('fontend.user.profile.character.search');
});
