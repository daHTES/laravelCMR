<?php

Route::group(['prefix' => 'task_comments', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\TaskCommentController@index')->name('api.task_comments.index');

    Route::post('/', 'Api\TaskCommentController@store')->name('api.task_comments.store');

    Route::get('/{task_comments}', 'Api\TaskCommentController@show')->name('api.task_comments.read');
    Route::put('/{task_comments}', 'Api\TaskCommentController@update')->name('api.task_comments.update');
    Route::delete('/{task_comments}', 'Api\TaskCommentController@destroy')->name('api.task_comments.delete');

});
