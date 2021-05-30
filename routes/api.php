<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnualLeaveController;

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
// Auth::routes();
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('hi', function () {
        return 'hi';
    });

    Route::prefix('user')->group(function () {
        Route::post('register', [UserController::class, 'store']);
        Route::get('show', [UserController::class, 'show']);
    });

    Route::prefix('annual-leave')->group(function () {

        //superadmin,staff hr
        // list-application
        Route::get('list', [AnnualLeaveController::class, 'showEmployeeLeave']);
        Route::get('list-application', [AnnualLeaveController::class, 'showListApplicationEmployee']);
        Route::get('list-detail', [AnnualLeaveController::class, 'showEmployeeLeaveDetail']);
        Route::post('store', [AnnualLeaveController::class, 'AddAnnualLiveEmployee']);
        Route::post('store-detail', [AnnualLeaveController::class, 'AddTotalAnnualLiveEmployee']);
        Route::post('acc-application', [AnnualLeaveController::class, 'accApplication']);
        // Route::get('show', [UserController::class, 'show']);

        //employee
        // storeleaveApplication
        Route::get('leave-remaining', [AnnualLeaveController::class, 'showRemainingAnnualLeave']);
        Route::post('leave-application', [AnnualLeaveController::class, 'storeLeaveApplication']);
    });
});
