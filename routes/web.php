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
  
Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/test', 'HomeController@test');

Route::get('/auth/facebook', 'Auth\RegisterController@redirectToFacebook');
Route::get('/auth/facebook/callback', 'Auth\RegisterController@handleFacebookCallback');
Route::get('/auth/google', 'Auth\RegisterController@redirectToGoogle');
Route::get('/auth/google/callback', 'Auth\RegisterController@handleGoogleCallback');
Route::post('/auth/login', 'SiteController@loginApi');
Route::post('/auth/register', 'SiteController@registerApi');

Route::get('/product/{id}/info', 'ProductController@info');
Route::get('/company/{id}/info', 'CompanyController@info');

Route::get('privacy-policy', 'HomeController@privacypolicy');
Route::get('terms-of-service', 'HomeController@termsofservice');

Route::post('ajaxpro', 'HomeController@ajaxpro');

Route::group(['middleware' => 'auth'], function(){
    Route::post('/postImage', 'HomeController@postImage');
    Route::post('/postImages', 'HomeController@postImages');

    Route::post('send-comment', 'ProductController@sendcomment');
    Route::post('/like-product', 'ProductController@like');
    Route::post('/unlike-product', 'ProductController@unlike');
});

// Check role in route middleware
Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'poster'], function () {
    Route::get('company/create', 'CompanyController@create');
    Route::post('company/store', 'CompanyController@store');
    Route::get('company/{id}/edit', 'CompanyController@edit');
    Route::post('company/update', 'CompanyController@update');

    Route::get('product/create', 'ProductController@create');
    Route::post('product/store', 'ProductController@store');
    Route::get('product/{id}/edit', 'ProductController@edit');
    Route::post('product/{id}/update', 'ProductController@update');
});

// Check role in route middleware
Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('admin', 'Admin\AdminController@index');
    Route::get('admin/give-role-permissions', 'Admin\AdminController@getGiveRolePermissions');
    Route::post('admin/give-role-permissions', 'Admin\AdminController@postGiveRolePermissions');
    Route::resource('admin/roles', 'Admin\RolesController');
    Route::resource('admin/permissions', 'Admin\PermissionsController');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
    Route::resource('admin/product', 'ProductController');
    Route::resource('admin/category', 'CategoryController');
    Route::resource('admin/company', 'CompanyController');
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'master'], function () {
    Route::post('product/vip', 'ProductController@vip');
    Route::post('product/vip2', 'ProductController@vip2');
    Route::post('product/unvip', 'ProductController@unvip');

    Route::post('company/active', 'CompanyController@active');
    Route::post('company/unactive', 'CompanyController@unactive');

    Route::resource('admin/company', 'CompanyController');
    Route::resource('admin/category', 'CategoryController');
});

Route::get('/product/{id}', 'ProductController@getSlug');
Route::get('/product/{id}/{slug}', 'ProductController@getSlug');
Route::get('/company/{id}', 'CompanyController@getSlug');
Route::get('/company/{id}/{slug}', 'CompanyController@getSlug');
