<?php

use App\Http\Controllers\LaunchSoftwareController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessageDiscountController;
use App\Http\Controllers\PurchaseMessageController;
use App\Http\Controllers\SoftwareController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//user
Route::post("/user_insertApi",[UserController::class,'user_insertApi']);
Route::post("/deleteApi",[UserController::class,'deleteApi']);
Route::post("/userupdateApi",[UserController::class,'userupdateApi']);
Route::post("/user_get_by_id",[UserController::class,'user_get_by_id']);
Route::post('/sendOtp',[UserController::class,'sendOtp']);
Route::post('/verify_username',[UserController::class,'verify_username']);
Route::get('/get_user_detail',[UserController::class,'get_user_detail']);
//software

Route::post("/softwareinsertApi",[SoftwareController::class,'softwareinsertApi']);
Route::post("/softwaredeleteApi",[SoftwareController::class,'softwaredeleteApi']);
Route::post("/softwareupdateApi",[SoftwareController::class,'softwareupdateApi']);
Route::post("/software_get_by_id",[SoftwareController::class,'software_get_by_id']);
Route::get("/get_latest_software",[SoftwareController::class,'get_latest_software']);
Route::get("/get_featured_software",[SoftwareController::class,'get_featured_software']);

//purchasemessage
Route::post("/purchasemessageinsertApi",[PurchaseMessageController::class,'purchasemessageinsertApi']);
Route::post("/purchasemessagedeleteApi",[PurchaseMessageController::class,'purchasemessagedeleteApi']);
Route::post("/purchasemessageupdateApi",[PurchaseMessageController::class,'purchasemessageupdateApi']);
Route::post("/purchasemessage_get_by_id",[PurchaseMessageController::class,'purchasemessage_get_by_id']);

//message
Route::post("/messageinsertApi",[MessageController::class,'messageinsertApi']);
Route::post("/messagedeleteApi",[MessageController::class,'messagedeleteApi']);
Route::post("/messageupdateApi",[MessageController::class,'messageupdateApi']);
Route::post("/message_get_by_id",[MessageController::class,'message_get_by_id']);

//messagediscount
Route::post("/messagediscountinsertApi",[MessageDiscountController::class,'messagediscountinsertApi']);
Route::post("/messagediscountupdateApi",[MessageDiscountController::class,'messagediscountupdateApi']);
Route::post("/messagediscountdeleteApi",[MessageDiscountController::class,'messagediscountdeleteApi']);
Route::post("/messagediscount_get_by_id",[MessageDiscountController::class,'messagediscount_get_by_id']);

//launchsoftware
Route::post("/launchsoftwareinsertApi",[LaunchSoftwareController::class,'launchsoftwareinsertApi']);
Route::post("/launchsoftwaredeleteApi",[LaunchSoftwareController::class,'launchsoftwaredeleteApi']);
Route::post("/launchsoftware_get_by_id",[LaunchSoftwareController::class,'launchsoftware_get_by_id']);