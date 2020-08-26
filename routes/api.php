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
Route::apiResource('suppliers', 'Api\SupplierController');
Route::apiResource('customers', 'Api\CustomerController');
Route::apiResource('categories', 'Api\CategoryController');
Route::apiResource('products', 'Api\ProductController');
Route::apiResource('expenses', 'Api\ExpenseController');
Route::apiResource('salaries', 'Api\SalaryController');
Route::get('salaries/month/{month}', 'Api\SalaryController@monthWiseSalaries');
Route::get('poses/products/category/{category_id}', 'Api\PosesController@getCategoryWiseProduct');
