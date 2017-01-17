<?php

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'can:show,App\Task'], function () {
        Route::get('/tasks', function () {
            return view('tasks');
        });
    });

    Route::get('/profile/tokens', function () {
        return view('tokens');
    });

    #adminlte_routes
    Route::get('csstables', 'CsstablesController@index')->name('csstables');

    Route::get('layoutfloat', 'LayoutfloatController@index')->name('layoutfloat');

    Route::get('boxmodel', 'BoxmodelController@index')->name('boxmodel');

    Route::get('float', function () {
        return view('float');
    });

    
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpinfo', function () {
    phpinfo();
});
