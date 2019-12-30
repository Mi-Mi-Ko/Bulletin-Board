<?php

/**
 * Login Routes
 */
Route::get('/', function () {
    return view('auth.login');
});
Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'Auth\LoginController@showLogin')
        ->name('showLogin');
    Route::post('/', 'Auth\LoginController@login')
        ->name('login');
});

/**
 * Forget Password Routes
 */
Route::get('password/forget', 'Auth\LoginController@showLinkRequestForm')
    ->name('password.request');

Route::post('save-photo', 'User\UserController@save');
/**
 * User Routes Group
 * Allow Admin Role
 */
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

/**
 * User Profile Routes
 * Allow User Role
 */
Route::group(['middleware' => 'user'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/profile/{id}', 'User\UserController@profile')
            ->name('users#profile');
    });
});

/**
 * User And Post Routes Group
 * Allow Login User
 */
Route::group(['middleware' => 'login'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'User\UserController@index')
            ->name('users#index');
        Route::any('/search', 'User\UserController@search')
            ->name('users#search');
        Route::get('/{id}', 'User\UserController@show')
            ->name('users#show');
        Route::any('/{id}/updateConfirmation', 'User\UserController@updateConfirmation')
            ->name('users#updateConfirmation');
        Route::post('/{id}', 'User\UserController@update')
            ->name('users#update');
        Route::delete('/{id}', 'User\UserController@delete')
            ->name('users#delete');
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
        Route::get('/export', 'Post\PostController@export')
            ->name('posts#export');
        Route::get('/{id}', 'Post\PostController@show')
            ->name('posts#show');
        Route::any('/{id}/updateConfirmation', 'Post\PostController@updateConfirmation')
            ->name('posts#updateConfirmation');
        Route::put('/{post}', 'Post\PostController@update')
            ->name('posts#update');
        Route::delete('/{id}', 'Post\PostController@delete')
            ->name('posts#delete');
    });
    Route::group(['prefix' => 'password'], function () {
        Route::get('/change/{id}', 'Auth\ResetPasswordController@showChangePasswordForm')
            ->name('password#showChangePasswordForm');
        Route::post('/change', 'Auth\ResetPasswordController@change')
            ->name('password#change');
    });
    Route::post('/logout', 'Auth\LoginController@logout')
        ->name('logout');
});
