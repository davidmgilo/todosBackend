<?php

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'can:show,Davidmgilo\TodosBackend\Task'], function () {
        Route::get('/tasks', function () {
            return view('tasks');
        });
    });

    Route::get('/profile/tokens', function () {
        return view('tokens');
    });

    #adminlte_routes
    Route::get('bootstraplayout', 'BootstraplayoutController@index')->name('bootstraplayout');

    Route::get('flexboxlayout', 'FlexboxlayoutController@index')->name('flexboxlayout');

    Route::get('csstables', 'CsstablesController@index')->name('csstables');

    Route::get('layoutfloat', 'LayoutfloatController@index')->name('layoutfloat');

    Route::get('boxmodel', 'BoxmodelController@index')->name('boxmodel');

    Route::get('float', function () {
        return view('float');
    });

    //Chat routes
    Route::get('chat', 'ChatController@index')->name('chat');
    Route::post('chat', 'ChatController@sendMessage');

    Route::get('messages','ChatController@fetchMessages');

    Route::post('/user/gcmtoken', 'GcmTokensController@addToken');
    Route::get('/user/messages', 'ChatController@fetchMessages');

    
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpinfo', function () {
    phpinfo();
});
