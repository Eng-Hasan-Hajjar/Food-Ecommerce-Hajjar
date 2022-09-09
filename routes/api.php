<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => "v1" , "namespace" => "Api"] , function() {
          // about app
    Route::group(["prefix" => "general" , "namespace" => "General"] , function() {
        // about app
        Route::get("about","mainController@about");
        Route::post("contact","mainController@contact");


    });

    // contact
                           // resturant
    Route::group(["prefix" => "resturant" , "namespace" => "Resturant"] , function() {
        Route::post("register","authController@register");
        Route::post("login","authController@login");
        // ==  authentication
        Route::group(["middleware" => "auth:api_resturant"],function(){
                           // authentication
            Route::post("resetPassword","authController@resetPassword");
            Route::post("password","authController@password");
            Route::get("profile","authController@profile");
            Route::post("update-profile","authController@updateProfile");
            Route::post("register-token","authController@registerToken");
            Route::post("delete-token","authController@deleteToken");
            Route::get("notification","mainController@notification");

            // products
            Route::get("products","mainController@products");
            Route::post("create-product","mainController@createProduct");
            Route::post("update-product","mainController@updateProduct");
            Route::get("offers","mainController@offers");
                         // offers
            Route::get("list-offers","mainController@offers");
            Route::post("create-offer","mainController@createOffer");
            Route::post("update-offer","mainController@updateOffer");
                         //orders
            Route::get("pending-order","mainController@pendingOrder");
            Route::get("current-order","mainController@currentOrder");
            Route::get("old-order","mainController@oldOrder");
            Route::post("accept-order","mainController@acceptOrder");
            Route::post("delivered-order","mainController@deliveredOrder");
            Route::post("reject-order","mainController@rejectOrder");
            //commission
            Route::get("commission","mainController@commission");


        });
    });
                          // clients
    Route::group(["prefix" => "client" , "namespace" => "Client"] , function() {
        Route::post("register","authController@register");
        Route::post("login","authController@login");
        Route::get("show-resturants","mainController@showResturants");
        Route::get("list-products","mainController@listProducts");
        Route::get("list-reviews","mainController@commentReview");
        Route::get("info-resturant","mainController@infoResturant");

                  // ==  authentication
        Route::group(["middleware" => "auth:api_client"],function(){
            // authentication
            Route::post("resetPassword","authController@resetPassword");
            Route::post("password","authController@password");
            Route::get("profile","authController@profile");
            Route::post("update-profile","authController@updateProfile");
            Route::post("create-review","mainController@createReview");
            Route::post("register-token","authController@registerToken");
            Route::post("delete-token","authController@deleteToken");
            Route::get("notification","mainController@notification");

            // orders
            Route::post("create-order","mainController@newOrder");
            Route::get("current-order","mainController@currentOrder");
            Route::get("old-order","mainController@oldOrder");
            Route::post("accept-order","mainController@acceptOrder");
            Route::post("reject-order","mainController@rejectOrder");
            //offers
            Route::get("list-offers","mainController@offers");

        });





    });

    });



