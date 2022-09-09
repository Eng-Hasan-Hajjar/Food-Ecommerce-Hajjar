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


Route::get('/', function () {
    return view('front.home');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//====================== admin dashboard
Route::get('admin/login', 'Auth\LoginController@showAdminLoginFrom')->name('admin.show');
Route::post('admin/login-system', 'Auth\LoginController@adminLogin')->name('admin.login');


Route::group(['middleware' => ['auth:admin', 'auto_check_permission']], function () {
    Route::group(['prefix' => 'admin', "namespace" => "Admin"], function () {
        Route::get('/', 'mainController@index')->name('home');
        Route::resource('district', 'District\districtController');
        Route::resource('city', 'City\cityController');
        // permission
        Route::resource('role', 'Role\roleController', ['except' => ['show']]);
        Route::resource('user', 'User\userController');
        // resturant
        Route::group(['prefix' => 'resturant', "namespace" => "Resturant"], function () {
            Route::get('/', 'resturantController@index')->name('resturant.index');
            Route::put('status/{id}', 'resturantController@status')->name('resturant.status');
            Route::delete('delete/{id}', 'resturantController@destroy')->name('resturant.destroy');

        });
        // client
        Route::group(['prefix' => 'client', "namespace" => "Client"], function () {
            Route::get('/', 'clientController@index')->name('client.index');
            Route::put('status/{id}', 'clientController@status')->name('client.status');
            Route::delete('delete/{id}', 'clientController@destroy')->name('client.destroy');
        });
        //Contact
        Route::group(['prefix' => 'contact', "namespace" => "Contact"], function () {
            Route::get('/', 'contactController@index')->name('contact.index');
            Route::delete('delete/{id}', 'contactController@destroy')->name('contact.destroy');

        });
        //Offer
        Route::group(['prefix' => 'offer', "namespace" => "Offer"], function () {
            Route::get('/', 'offerController@index')->name('offer.index');
            Route::delete('delete/{id}', 'offerController@destroy')->name('offer.destroy');
        });
        //products
        Route::group(['prefix' => 'product', "namespace" => "Product"], function () {
            Route::get('/', 'productController@index')->name('product.index');
            Route::delete('delete/{id}', 'productController@destroy');
        });
        //orders
        Route::group(['prefix' => 'order', "namespace" => "Order"], function () {
            Route::get('/', 'orderController@index')->name('order.index');
            Route::get('show/{id}', 'orderController@show')->name('order.show');
            Route::get('search', 'orderController@filter');
        });
        // setting
        Route::get('setting', 'setting\settingController@index')->name('setting.index');
        Route::put('setting/{id}', 'setting\settingController@update')->name('setting.update');

        // category
        Route::resource('category', 'Category\categoryController', ['except' => ['show']]);


    });
});

// ===============  front route

/* auth routes     login register    for  resturant and user */
// register resturant
Route::group(['prefix' => 'resturant', 'namespace' => 'Auth'], function () {
    Route::get('register', 'RegisterController@showRegister')->name('resturant.register');
    Route::post('create', 'RegisterController@createResturant')->name('R.register');
    // login resturant
    Route::get('login', 'LoginController@showlogin')->name('resturant.login');
    Route::post('login-system', 'LoginController@loginResturant')->name('R.login');
});

//    Route::get('register', 'Auth\RegisterController@showLogin')->name('client.login');
//    Route::post('create-client', 'Auth\RegisterController@createClient')->name('C.register');


Route::group(['namespace' => 'front'], function () {
    //======== general
    Route::get('/', 'mainController@index');
    Route::post('send-message', 'mainController@sendMessage');
    Route::post('resturant_search', 'mainController@resturantSearch');
    Route::get('load-district', 'mainController@loadDistrict');
    Route::get('resturants/{id}', 'Client\clientController@resturant');
    Route::get('resturants/info/{id}', 'Client\clientController@info');
    Route::get('products/{id}', 'Client\clientController@product');
    Route::get('contact-us', 'mainController@contact')->middleWare(['auth:web,resturant']);
    Route::post('/details', 'mainController@details');

    // ========================== Clients
    Route::group(['namespace' => 'Client'], function () {
        Route::get('offers', 'clientController@offer');
        Route::group(['middleware' => ['check']], function () {
            Route::get('search-product', 'clientController@searchProduct');
            Route::post('/add-cart/{id}', 'CartController@getAddToCart');
            Route::post('/cart/update', 'CartController@updateQty');
            Route::delete('/cart/delete/{id}', 'CartController@deleteProduct');
            Route::get('cart', 'CartController@index');
            Route::get('job', 'employeeController@index');
            Route::get('apply/{id}', 'employeeController@apply');
            Route::post('store-apply', 'employeeController@storeApply');
            Route::post('job-search', 'employeeController@jobSearch');

        });
        Route::group(['middleware' => ['auth:web']], function () {
            Route::post('review', 'clientController@review')->name('review');
            Route::post('/cart/submit', 'CartController@submitOrder');
            Route::post('/new-order', 'CartController@newOrder');
            Route::get('profile', 'clientController@edit');
            Route::post('update-profile', 'clientController@update');
            Route::group(['prefix' => 'order'], function () {
                Route::get('new', 'orderController@newOrder')->name('newOrder');
//                Route::get('old', 'orderController@oldOrder')->name('oldOrder');
//                Route::post('accept-order', 'orderController@deliveredOrder')->name('acceptOrder');
//                Route::post('reject-order', 'orderController@rejectOrder')->name('rejectOrder');
                Route::post('delivered-order', 'orderController@deliveredOrder')->name('delivered');

            });
        });
    });
    // ========================== Resturant
    Route::group(['namespace' => 'Resturant', 'prefix' => 'resturant'], function () {
        Route::group(['middleware' => ['auth:resturant']], function () {
            Route::get('/', 'resturantController@index');
            Route::get('commission', 'resturantController@commission')->name('commission');
            Route::get('edit', 'resturantController@edit');
            Route::post('update', 'resturantController@update');
            Route::get('employee', 'employeeController@index');
            Route::post('delete-employee/{id}', 'employeeController@destroy');

//                Route::get('create-product','resturantController@addProduct')->name('add.product');
//                Route::post('create-product','resturantController@createProduct')->name('create.product');
//                Route::get('update-product/{id}','resturantController@updateProduct');
//                Route::put('update-product/{id}','resturantController@storeProduct');
            Route::resource('product', 'productController', ['except' => ['show', 'index']]);
            Route::resource('offer', 'offerController', ['except' => ['show']]);
            Route::group(['prefix' => 'order'], function () {
                Route::get('/', 'orderController@pendingOrder')->name('new');
                Route::get('current', 'orderController@currentOrder')->name('current');
                Route::get('old', 'orderController@oldOrder')->name('old');
                Route::post('accept-order', 'orderController@acceptOrder')->name('accept');
                Route::post('reject-order', 'orderController@rejectOrder')->name('reject');
                Route::post('delivered-order', 'orderController@deliveredOrder')->name('deliveredR');

            });


        });
    });
});
