<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('/roster', 'FrontendController@roster')->name('frontend.roster');

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
