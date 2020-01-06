<?php

use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return 555;
});

Route::get('post', 'PostController@index')->name('posts.list');

Route::middleware(['auth'])->group(function () {
    Route::post('post', 'PostController@create');
    Route::put('post/{post}', 'PostController@update')->name('edit.post');
    Route::delete('post/{post}', 'PostController@delete')->name('remove.post');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();
Route::get('/home', 'PostController@index')->name('home');
