<?php

    Route::resource('raid', 'Raid\RaidController',
            [
                'except' => ['show'],
                'names'  =>
                    ['index' => 'admin.raid.index']
            ]
        );


?>
