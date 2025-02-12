<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SocialAuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SocialMediaController;
use App\Http\Controllers\Api\SystemSettingController;
use App\Http\Controllers\Api\DynamicPageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



//Social Login
Route::post('/social-login', [SocialAuthController::class, 'socialLogin']);

// Product List
Route::get('/product-list', [ProductController::class, 'productList']);
Route::get('/explore-all', [ProductController::class, 'exploreAll']);
Route::get('/product-search', [ProductController::class, 'productSearch']);

//SocialMedia
Route::get('/social-media', [SocialMediaController::class, 'socialMedia']);

//SystemSetting
Route::get('/system-setting', [SystemSettingController::class, 'systemSetting']);

//
Route::get('/dynamic-page', [DynamicPageController::class, 'dynamicPage']);

//Register API
Route::controller(RegisterController::class)->prefix('users/register')->group(function () {
    // User Register
    Route::post('/', 'userRegister');

    // Verify OTP
    Route::post('/otp-verify', 'otpVerify');

    // Resend OTP
    Route::post('/otp-resend', 'otpResend');
});

//Login API
Route::controller(LoginController::class)->prefix('users/login')->group(function () {

    // User Login
    Route::post('/', 'userLogin');

    // Verify Email
    Route::post('/email-verify', 'emailVerify');

    // Resend OTP
    Route::post('/otp-resend', 'otpResend');

    // Verify OTP
    Route::post('/otp-verify', 'otpVerify');

    //Reset Password
    Route::post('/reset-password', 'resetPassword');
});

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/data', 'userData');
        Route::post('/data/update', 'userUpdate');
        Route::post('/logout', 'logoutUser');
        Route::delete('/delete', 'deleteUser');

        Route::post('/change-password', 'changePassword');
    });
});
