<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
// guest

Route::namespace('user')->group(function () {

    Route::group(['middleware' => ['loginWeb']], function () {
        Route::get('/login', function () {
            return view('user.login');
        });
        Route::get('/register', function () {
            return view('user.register');
        });
        Route::get('/recover-password', function () {
            return view('user.recover-password');
        });
        Route::post('/login', ['as' => 'login', 'uses' =>'CustomerController@login']);
        Route::post('/register', 'CustomerController@register');
        Route::post('/recover-password', 'CustomerController@recoverPassword');
    });

    // check ajax
    Route::post('/checkemailregister', 'CustomerController@checkEmailRegister');
    Route::post('/checkemailrecover', 'CustomerController@checkEmailRecover');
    Route::post('/check-coupon', 'CartController@checkCoupon');



    Route::group(['middleware' => ['userLogin']], function () {
        Route::get('/thong-tin-thanh-toan', 'CartController@checkout');
        Route::get('/thanh-toan', 'CartController@pay');
        Route::get('/gio-hang', 'CartController@show');
        Route::post('/add-gio-hang/{id}', 'CartController@add');
        Route::post('/update-gio-hang/{id}', 'CartController@update');
        Route::get('/remove-gio-hang/{id}', 'CartController@delete');
        Route::get('/logout', 'CustomerController@logout');
        Route::get('/nap-tien', function() {
            return view('user.admin.profile.payonline');
        });


        Route::get('thong-tin-tai-khoan', function(){
            return view('user.admin.profile.account');
        });
        Route::get('lich-su-don-hang', function(){
            return view('user.admin.profile.order');
        });
        Route::get('chi-tiet-don-hang/{id}', 'CustomerController@detailorder');
        Route::get('lich-su-giao-dich', 'CustomerController@transaction');
        Route::get('thay-doi-mat-khau', function(){
            return view('user.admin.profile.password');
        });
        Route::post('thay-doi-mat-khau', 'CustomerController@changepassword');
        Route::post('nap-tien', 'CustomerController@createPayment');
        Route::get('thanh-toan-nap-tien', 'CustomerController@savePayment');

        Route::post('them-binh-luan', 'CustomerController@addcomment');
        Route::post('/cap-nhat-tai-khoan/{id}', 'CustomerController@update');
    });

    //
    Route::get('/', 'ProductController@home');
    Route::get('/chi-tiet-san-pham/{slug}.{id}', 'ProductController@show');
    Route::group(['prefix' =>'tim-kiem'], function () {
        Route::get('/', 'ProductController@search');
        Route::get('/bestsellers', 'ProductController@bestsellers');
        Route::get('/sale', 'ProductController@sale');
    });

    Route::get('/phan-hoi', function(){
        return view('user.feedback');
    });
    Route::get('/huong-dan-mua-hang', function(){
        return view('user.huongdan');
    });
    Route::post('/phan-hoi', 'CustomerController@feedback');
});



