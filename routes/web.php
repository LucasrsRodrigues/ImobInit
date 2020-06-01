<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function(){

    Route::get('/', 'AuthController@showLoginForm')->name('login');

});
