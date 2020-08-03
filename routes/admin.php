<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('admin')->group(function () {
    Route::group(['middleware' => ['loginAdmin']], function () {
        Route::get('/login', function () {
            return view('admin.login');
        });
        Route::get('/register', function () {
            return view('admin.register');
        });
        Route::get('/recover-password', function () {
            return view('admin.recover-password');
        });
        Route::post('/login', ['as' => 'login', 'uses' =>'UserController@login']);
        Route::post('/register', 'UserController@register');
        Route::post('/recover-password', 'UserController@recoverPassword');
    });


    // check ajax
    Route::post('/checkemailregister', 'UserController@checkEmailRegister');
    Route::post('checkemailrecover', 'UserController@checkEmailRecover');

    Route::group(['middleware' => ['adminLogin']], function () {
        Route::get('/', 'UserController@home');
        // users
        Route::group(['prefix' =>'users'], function () {
            Route::get('/', 'UserController@store');
            Route::post('/', 'UserController@create');
            Route::post('/update', 'UserController@update');
            Route::get('/add', 'UserController@viewadd');
            Route::get('/remove', 'UserController@remove');
            Route::post('/delete', 'UserController@destroy');
            Route::post('/undodelete', 'UserController@undo');
            Route::get('/logout', 'UserController@logout');
        });
        // category
        Route::group(['prefix' =>'categories'], function () {
            Route::get('/', function(){
                return view('admin.admin.categories.index');
            });
            Route::post('/', 'CategoryController@create');
            Route::get('/detail/{id}', 'CategoryController@show');
            Route::post('/update', 'CategoryController@update');
            Route::get('/add', function(){
                return view('admin.admin.categories.add');
            });
            Route::post('/delete', 'CategoryController@destroy');
        });
        // coupons
        Route::group(['prefix' =>'coupons'], function () {
            Route::get('/', 'CouponController@store');
            Route::post('/', 'CouponController@create');
            Route::get('/detail/{id}', 'CouponController@show');
            Route::get('/add', function(){
                return view('admin.admin.coupons.add');
            });
        });
        // importproducts
        Route::group(['prefix' => 'importproducts'], function () {
            Route::get('/', 'ImportProductController@store');
            Route::get('/detail/{id}', 'ImportProductController@show');
            Route::get('/remove', 'ImportProductController@remove');
            Route::get('/add', 'ImportProductController@add');
            Route::post('/', 'ImportProductController@create');
        });

        // soldproducts

        Route::get('/san-pham-dang-ban', 'ProductController@sold');
        Route::get('/san-pham-khong-ban', 'ProductController@nosold');

        // products
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductController@store');
            Route::get('/detail/{id}', 'ProductController@show');
            Route::get('/chi-tiet/{id}', 'ProductController@detail');
            Route::get('/add', 'ProductController@add');
            Route::get('/remove', 'ProductController@remove');
            Route::post('/', 'ProductController@create');
            Route::post('/update', 'ProductController@update');
            Route::post('/updateprice', 'ProductController@updatePrice');
            Route::post('/delete', 'ProductController@destroy');
            Route::post('/undodelete', 'ProductController@undo');
        });

        // customers
        Route::group(['prefix' => 'customers'], function () {
            Route::get('/', 'CustomerController@store');
            Route::get('/detail/{id}', 'CustomerController@show');
            Route::get('/add', function() {
                return view('admin.admin.customers.add');
            });
            Route::get('/remove', 'CustomerController@remove');
            Route::post('/', 'CustomerController@create');
            Route::post('/update', 'CustomerController@update');
            Route::post('/delete', 'CustomerController@destroy');
            Route::post('/undodelete', 'CustomerController@undo');
        });

        //publishers
        Route::group(['prefix' => 'publishers'], function () {
            Route::get('/', 'PublisherController@store');
            Route::get('/detail/{id}', 'PublisherController@show');
            Route::get('/add', function(){
                return view('admin.admin.publishers.add');
            });
            Route::get('/remove', 'PublisherController@remove');
            Route::post('/', 'PublisherController@create');
            Route::post('/update', 'PublisherController@update');
            Route::post('/delete', 'PublisherController@destroy');
            Route::post('/undodelete', 'PublisherController@undo');
            Route::post('/checkemailcreate', 'PublisherController@checkEmailCreate');
        });

        // order
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'OrderController@store');
            Route::get('/detail/{id}', 'OrderController@show');
        });

        // comment
        Route::group(['prefix' => 'comments'], function () {
            Route::get('/', 'CommentController@store');
            Route::get('/{id}', 'CommentController@show');
            Route::get('/delete/{id}', 'CommentController@destroy');
        });

        // feedback
        Route::group(['prefix' => 'feedbacks'], function () {
            Route::get('/', 'FeedbackController@store');
            Route::get('/{id}', 'FeedbackController@show');
        });
    });
 });



