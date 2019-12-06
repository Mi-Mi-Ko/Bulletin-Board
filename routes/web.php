<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

/**
 * Login routes
 */
// Route::Get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::Get('password/reset', 'Auth\LoginController@showLinkRequestForm')->name('password.request');
// Route::Post('/login', 'Auth\LoginController@login');

Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'Auth\LoginController@showLogin')
        ->name('showLogin');
    Route::post('/', 'Auth\LoginController@login')
        ->name('login');
});

Route::post('/logout', 'Auth\LoginController@logout')
    ->name('logout');

Route::group(['prefix' => 'users'], function () {

    Route::get('/', 'User\UserController@index')
        ->name('index')
        ->middleware('auth');

    Route::get('/create', 'User\UserController@create')
        ->name('users#create')
        ->middleware('auth');

    Route::post('/confirm', 'User\UserController@confirmation')
        ->name('users#confirmation')
        ->middleware('auth');

    Route::get('/{id}', 'User\UserController@show')
        ->name('users#show')
        ->middleware('auth');

    Route::match(['PUT', 'PATCH'], '/{user}', 'User\UserController@update')
        ->name('users#update')
        ->middleware('auth');

    Route::post('/', 'User\UserController@store')
        ->name('users#store');
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', 'Post\PostController@index')
        ->name('index')
        ->middleware('auth');
});
