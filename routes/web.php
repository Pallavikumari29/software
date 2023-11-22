<?php

use App\Http\Controllers\LaunchSoftwareController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Software_sale_Controller;
use App\Http\Controllers\Software_Sale_ReciptController;
use App\Http\Controllers\Software_Transaction_Controller;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app');
});




Route::get('/users', [UserController::class, 'getUsers']);
Route::post('/addnewuser', [UserController::class, 'addnewuser']);
Route::get('/delete_users', [UserController::class, 'delete_users']);
Route::get('/edit_users', [UserController::class, 'edit_users']);
Route::post('/updateusers/{id}', [UserController::class, 'updateusers']);
Route::get('/updateUserStatus', [UserController::class, 'updateUserStatus']);

Route::get('/softwares', [SoftwareController::class, 'getSoftware']);
Route::get('/delete_Software', [SoftwareController::class, 'delete_software']);
Route::post('/addnewsoftware', [SoftwareController::class, 'addnewsoftware']);
Route::get('/edit_softwares', [SoftwareController::class, 'edit_softwares']);
Route::post('updatesoftwares/{id}', [SoftwareController::class, 'updatesoftwares']);

Route::get('/launch_softwares', [LaunchSoftwareController::class,'getlaunchsoftwares']);
Route::post('/addnewlaunchsoftware', [LaunchSoftwareController::class,'addnewlaunchsoftware']);
Route::get('/delete_launchsoftware', [LaunchSoftwareController::class, 'delete_launchsoftware']);
Route::get('/updatelaunch_softwareStatus', [LaunchSoftwareController::class, 'updatelaunch_softwareStatus']);

Route::get('/message', [MessageController::class, 'getmessages']);
Route::get('/delete_messages', [MessageController::class, 'delete_messages']);
Route::post('/addnewmessage', [MessageController::class,'addnewmessage']);
Route::get('/updatemessagestatus', [MessageController::class,'updatemessagestatus']);

Route::get('/software_sale', [Software_sale_Controller::class, 'getsoftwaresale']);


Route::get('/messagelist', [MessageController::class, 'messagelist']);
Route::get('/messagesales', [MessageController::class, 'messagesales']);

Route::get('/wallet', [WalletController::class, 'getwallet']);

Route::get('/update_software_sale_status', [Software_sale_Controller::class, 'update_software_sale_status']);

Route::get('/withdraw', [WithdrawController::class, 'getmessages']);
