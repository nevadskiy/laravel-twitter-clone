<?php
DB::enableQueryLog();

/** Auth */
Auth::routes();

/** Post */
Route::get('/', 'PostController@getIndex')
    ->name('dashboard');
Route::post('/post/create', 'PostController@create')
    ->name('post.create');
Route::get('/post/{post}/delete', 'PostController@destroy')
    ->name('post.destroy');
Route::put('/post/{post}', 'PostController@update')
    ->name('post.update');
Route::post('post/like', 'PostController@postLike')
    ->name('post.like');

/** Profile */
Route::get('/profile', 'ProfileController@getIndex')
    ->name('profile.index');
Route::post('/profile', 'ProfileController@update')
    ->name('profile.update');
Route::get('/image/{filename}', 'ProfileController@getUserImage')
    ->name('profile.image');