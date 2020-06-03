<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function(){

    Route::get('/', 'AuthController@showLoginForm')->name('login');

    Route::get('home', 'AuthController@home')->name('home');

});
