<?php

use Illuminate\Http\Request;

Route::prefix('auth')->group(function () {
    Route::post('/register', 'api\AuthController@register')->name('register_api');
    Route::post('/login', 'api\AuthController@login')->name('login_api');
});

Route::middleware(['auth.user'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', 'api\AuthController@logout')->name('logout_api');
    });

    Route::middleware(['auth.admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::post('/', 'api\DashboardController@dashboard')->name('dashboard_api');

            Route::prefix('car')->group(function() {
                Route::post('/', 'api\CarController@list')->name('list_car_api');
                Route::post('/add', 'api\CarController@add')->name('add_car_api');
                Route::post('/edit/{id}', 'api\CarController@edit')->name('edit_car_api');
                Route::post('/booked_car_list', 'api\CarController@booked_car_list')->name('booked_car_list_api');
            });

            Route::prefix('customers')->group(function() {
                Route::post('/', 'api\CustomerController@list')->name('list_cutomers_booked_cars_api');
            });
        });
    });
});
