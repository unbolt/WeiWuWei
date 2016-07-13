<?php
Route::group([
    'prefix'     => 'raid'
], function() {

    Route::get('/', [
            'as' => 'admin.raid.index',
            'uses' => 'Raid\RaidController@index'
        ]);

    Route::get('create', [
            'as' => 'admin.raid.create',
            'uses' => 'Raid\RaidController@create'
        ]);

    Route::post('store', [
            'as' => 'admin.raid.store',
            'uses' => 'Raid\RaidController@store'
        ]);

    Route::get('{id}/edit', [
            'as' => 'admin.raid.edit',
            'uses' => 'Raid\RaidController@edit'
        ]);

    Route::put('{id}', [
            'as' => 'admin.raid.update',
            'uses' => 'Raid\RaidController@update'
        ]);

    Route::delete('{id}', [
            'as' => 'admin.raid.destroy',
            'uses' => 'Raid\RaidController@destroy'
        ]);

});


?>
