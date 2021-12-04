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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.dashboard');

Route::get('/', 'Frontend\frontendController@index')->name('home.frontend');
Route::get('product/details', 'Frontend\frontendController@singleProduct')->name('product.single');
Route::get('product/cart', 'Frontend\frontendController@cartProduct')->name('product.cart');
Route::get('about-us', 'Frontend\frontendController@aboutUs')->name('about.us');
Route::get('contact-us', 'Frontend\frontendController@contactUs')->name('contact.us');
Route::post('contact-us/message', 'Frontend\frontendController@contacStore')->name('contact.store');

Route::group(['middleware' => 'auth'], function () {
//UserController
    Route::prefix('users')->group(function () {
        Route::get('/view', 'Backend\UserController@userview')->name('users.view');
        Route::get('/add', 'Backend\UserController@add')->name('users.add');
        Route::post('/store', 'Backend\UserController@store')->name('users.store');
        Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
        Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
        Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');

    });

    Route::prefix('client')->group(function () {
        Route::get('/message', 'Backend\CommunicateController@viewmsg')->name('communicate.view');
        Route::get('/delete/{id}', 'Backend\CommunicateController@delete')->name('communicate.delete');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/view', 'Backend\ProfieController@profileview')->name('profile.view');
        Route::get('/edit', 'Backend\ProfieController@profileedit')->name('profile.edit');
        Route::post('/update', 'Backend\ProfieController@profileupdate')->name('profile.update');
    });

    Route::prefix('logo')->group(function () {
        Route::get('/view', 'Backend\LogoController@logoview')->name('logo.view');
        Route::post('/update', 'Backend\LogoController@update')->name('logo.update');
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/view', 'Backend\SlidersController@sliderview')->name('sliders.view');
        Route::get('/add', 'Backend\SlidersController@add')->name('sliders.add');
        Route::post('/store', 'Backend\SlidersController@store')->name('sliders.store');
        Route::get('/edit/{id}', 'Backend\SlidersController@edit')->name('sliders.edit');
        Route::post('/update/{id}', 'Backend\SlidersController@update')->name('sliders.update');
        Route::get('/delete/{id}', 'Backend\SlidersController@delete')->name('sliders.delete');
    });


    Route::prefix('category')->group(function (){
        Route::get('','Backend\CategoryController@index')->name('category.index');
        Route::get('view', 'Backend\CategoryController@categoryview')->name('category.view');
        Route::post('/store', 'Backend\CategoryController@store')->name('category.store');
        Route::get('/edit/{id}', 'Backend\CategoryController@edit')->name('category.edit');
        Route::post('/update/{id}', 'Backend\CategoryController@update')->name('category.update');
        Route::get('/delete/{id}', 'Backend\CategoryController@delete')->name('category.delete');
    });

    Route::prefix('brand')->group(function (){
        Route::get('','Backend\brandController@index')->name('brand.index');
        Route::get('view', 'Backend\brandController@brandview')->name('brand.view');
        Route::post('/store', 'Backend\brandController@store')->name('brand.store');
        Route::get('/edit/{id}', 'Backend\brandController@edit')->name('brand.edit');
        Route::post('/update/{id}', 'Backend\brandController@update')->name('brand.update');
        Route::get('/delete/{id}', 'Backend\brandController@delete')->name('brand.delete');
    });
    Route::prefix('color')->group(function (){
        Route::get('','Backend\ColorController@index')->name('color.index');
        Route::get('view', 'Backend\ColorController@colorview')->name('color.view');
        Route::post('/store', 'Backend\ColorController@store')->name('color.store');
        Route::get('/edit/{id}', 'Backend\ColorController@edit')->name('color.edit');
        Route::post('/update/{id}', 'Backend\ColorController@update')->name('color.update');
        Route::get('/delete/{id}', 'Backend\ColorController@delete')->name('color.delete');
    });

    Route::prefix('size')->group(function (){
        Route::get('','Backend\SizeController@index')->name('size.index');
        Route::get('view', 'Backend\SizeController@colorview')->name('size.view');
        Route::post('/store', 'Backend\SizeController@store')->name('size.store');
        Route::get('/edit/{id}', 'Backend\SizeController@edit')->name('size.edit');
        Route::post('/update/{id}', 'Backend\SizeController@update')->name('size.update');
        Route::get('/delete/{id}', 'Backend\SizeController@delete')->name('size.delete');
    });

    Route::prefix('products')->group(function () {
        Route::get('/view', 'Backend\ProductController@productview')->name('products.view');
        Route::get('/add', 'Backend\ProductController@add')->name('products.add');
        Route::post('/store', 'Backend\ProductController@store')->name('products.store');
        Route::get('/edit/{slug_name}', 'Backend\ProductController@edit')->name('products.edit');
        Route::get('/single/view/{slug_name}', 'Backend\ProductController@singleView')->name('products.single.view');
        Route::put('/update/{id}', 'Backend\ProductController@update')->name('products.update');
        Route::get('/delete/{id}', 'Backend\ProductController@delete')->name('products.delete');
        Route::get('/show-multiple-image/{id}', 'Backend\ProductController@showMultiple')->name('products.multiple.show');
        Route::get('/delete-multiple-image/{id}', 'Backend\ProductController@deleteMultiple')->name('products.multiple.delete');

    });


});
