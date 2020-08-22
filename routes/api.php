<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'namespace' => 'Api\Auth', 'prefix' => 'auth'], function ($router) {
    Route::post('signup', 'AuthController@signup');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::apiResource('employs', 'Api\EmployController');
