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

Route::group(['prefix' => 'password'], function () {
    Route::get('/reset/{id}', 'Auth\ResetPasswordController@showResetForm')
        ->name('password#showResetForm')
        ->middleware('auth');
    Route::post('/reset', 'Auth\ResetPasswordController@update')
        ->name('password#update')
        ->middleware('auth');
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

    Route::get('/profile/{id}', 'User\UserController@profile')
        ->name('users#profile')
        ->middleware('auth');

    Route::any('/{id}/updateConfirmation', 'User\UserController@updateConfirmation')
        ->name('users#updateConfirmation')
        ->middleware('auth');

    Route::match(['PUT', 'PATCH'], '/{user}', 'User\UserController@update')
        ->name('users#update')
        ->middleware('auth');

    Route::post('/', 'User\UserController@store')
        ->name('users#store')
        ->middleware('auth');
});

Route::group(['prefix' => 'posts'], function () {

    Route::get('/importView', 'Post\PostController@getCsv')
        ->name('posts#getCsv')
        ->middleware('auth');

    Route::post('/import', 'Post\PostController@import')
        ->name('posts#import')
        ->middleware('auth');

    Route::get('/', 'Post\PostController@index')
        ->name('index')
        ->middleware('auth');

    Route::get('/create', 'Post\PostController@create')
        ->name('posts#create')
        ->middleware('auth');

    Route::post('/confirm', 'Post\PostController@confirmation')
        ->name('posts#confirmation')
        ->middleware('auth');

    Route::get('/{id}', 'Post\PostController@show')
        ->name('posts#show')
        ->middleware('auth');

    Route::any('/{id}/updateConfirmation', 'Post\PostController@updateConfirmation')
        ->name('posts#updateConfirmation')
        ->middleware('auth');

    Route::match(['PUT', 'PATCH'], '/{post}', 'Post\PostController@update')
        ->name('posts#update')
        ->middleware('auth');

    Route::post('/', 'Post\PostController@store')
        ->name('posts#store')
        ->middleware('auth');
});
