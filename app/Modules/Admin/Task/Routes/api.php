<?php

Route::group(['prefix' => 'task', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\TaskController@index')->name('api.task.index');
    Route::post('/', 'Api\TaskController@store')->name('api.task.store');
    Route::get('/{task}', 'Api\TaskController@show')->name('api.task.read');


    Route::get('/archive/index', 'Api\TaskController@archive')->name('task.archive.index');

});
