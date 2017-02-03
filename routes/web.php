<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::group(['prefix' => ''], function () {
    Route::get('/', 'AdminController@index')->name('root');

    Route::group(['prefix' => '/employees', 'middleware' => 'web'], function () {
        // Auth
        Route::get('login', 'Employee\Auth\LoginController@showLoginForm')->name('employee.login');
        Route::post('login', 'Employee\Auth\LoginController@login');
        Route::get('logout', 'Employee\Auth\LoginController@logout')->name('employee.logout');
        // Password Reset Routes...
        Route::get('password/request', 'Employee\Auth\ForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
        Route::post('password/email', 'Employee\Auth\ForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
        Route::get('password/reset/{token}', 'Employee\Auth\ResetPasswordController@showResetForm')->name('employee.password.reset');
        Route::post('password/reset', 'Employee\Auth\ResetPasswordController@reset');
        // Main
        Route::group(['middleware' => 'auth.employee:employee'], function () {
            Route::get('/', 'Employee\HomeController@index')->name('employee.dashboard');
        });
    });

    // Szülők
    Route::group(['prefix' => '/customers', 'middleware' => 'web'], function () {
        // Auth
        Route::get('login', 'Customer\Auth\LoginController@showLoginForm')->name('customer.login');
        Route::post('login', 'Customer\Auth\LoginController@login');
        Route::get('logout', 'Customer\Auth\LoginController@logout')->name('customer.logout');
        // Password Reset Routes...
        Route::get('password/request', 'Customer\Auth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
        Route::post('password/email', 'Customer\Auth\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
        Route::get('password/reset/{token}', 'Customer\Auth\ResetPasswordController@showResetForm')->name('customer.password.reset');
        Route::post('password/reset', 'Customer\Auth\ResetPasswordController@reset');
        // Main
        Route::group(['middleware' => 'auth.customer:customer'], function () {
            Route::get('/', 'Customer\HomeController@index')->name('customer.dashboard');
        });
    });
});
