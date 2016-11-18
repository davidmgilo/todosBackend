<?php

Route::group(['middleware' => 'auth'], function(){
    Route::get('/tasks', function () {
        return view('tasks');
    });
});

