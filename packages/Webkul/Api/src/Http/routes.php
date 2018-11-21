<?php


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('user', 'Webkul\Api\Http\Controllers\Admin\LoginController@user');
});

