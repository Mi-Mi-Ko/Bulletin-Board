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
    return view('auth.login');
});

Route::Get('password/forget', 'Auth\LoginController@showLinkRequestForm')
    ->name('password.request');

/**
 * Login routes
 */
Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'Auth\LoginController@showLogin')
        ->name('showLogin');
    Route::post('/', 'Auth\LoginController@login')
        ->name('login');
});

Route::post('/logout', 'Auth\LoginController@logout')
    ->name('logout');

Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/create', 'User\UserController@create')
            ->name('users#create');
        Route::post('/confirm', 'User\UserController@confirmation')
            ->name('users#confirmation');
        Route::post('/', 'User\UserController@store')
            ->name('users#store');
    });
});

Route::group(['middleware' => 'user'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/profile/{id}', 'User\UserController@profile')
            ->name('users#profile');
    });
});

Route::group(['middleware' => 'login'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'User\UserController@index')
            ->name('users#index');
        Route::get('/{id}', 'User\UserController@show')
            ->name('users#show');
        Route::any('/{id}/updateConfirmation', 'User\UserController@updateConfirmation')
            ->name('users#updateConfirmation');
        Route::match(['PUT', 'PATCH'], '/{user}', 'User\UserController@update')
            ->name('users#update');
    });
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', 'Post\PostController@index')
            ->name('posts#index');
        Route::get('/create', 'Post\PostController@create')
            ->name('posts#create');
        Route::post('/confirm', 'Post\PostController@confirmation')
            ->name('posts#confirmation');
        Route::post('/', 'Post\PostController@store')
            ->name('posts#store');
        Route::get('/importView', 'Post\PostController@getCsv')
            ->name('posts#getCsv');
        Route::post('/import', 'Post\PostController@import')
            ->name('posts#import');
        Route::get('/{id}', 'Post\PostController@show')
            ->name('posts#show');
        Route::any('/{id}/updateConfirmation', 'Post\PostController@updateConfirmation')
            ->name('posts#updateConfirmation');
        Route::match(['PUT', 'PATCH'], '/{post}', 'Post\PostController@update')
            ->name('posts#update');
    });
    Route::group(['prefix' => 'password'], function () {
        Route::get('/reset/{id}', 'Auth\ResetPasswordController@showResetForm')
            ->name('password#showResetForm');
        Route::post('/reset', 'Auth\ResetPasswordController@update')
            ->name('password#update');
    });
});
