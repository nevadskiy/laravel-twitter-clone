<?php
/** Auth */
Auth::routes();

/** Post */
Route::get('/', 'PostController@getIndex')
    ->name('dashboard');
Route::post('/post/create', 'PostController@create')
    ->name('post.create');
Route::get('/post/{post}/delete', 'PostController@destroy')
    ->name('post.destroy');
