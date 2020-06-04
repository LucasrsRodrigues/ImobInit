<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function(){

    /*  FORMULARIO DE LOGIN*/
    Route::get('/', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login')->name('login.do');

    /*  FORMULARIO DE PROTEGIDAS*/
    Route::group(['middleware' => ['auth']], function(){

        /* Dashboard Home */
        Route::get('home', 'AuthController@home')->name('home');

        Route::get('users/team', 'UserController@team')->name('users.team');
        Route::resource('users', 'UserController');
    });

    /*  FORMULARIO DE LOGOUT*/
    Route::get('logout','AuthController@logout')->name('logout');

});
