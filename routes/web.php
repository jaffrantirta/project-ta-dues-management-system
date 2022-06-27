<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\UserPenaltyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ManagementController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['role:Super Admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('events', EventController::class);
    Route::resource('events.users', UserEventController::class);
    Route::resource('managements', ManagementController::class);

    Route::post('/events/{event}/done', [EventController::class, 'done'])->name('events.done');
    Route::get('/events/{event}/penalties', [UserPenaltyController::class, 'index'])->name('events.penalties.index');
    Route::post('/penalties/{userPenalty}', [UserPenaltyController::class, 'paid'])->name('penalties.paid');
    Route::get('/settings/penalty/fee', [SettingController::class, 'penalty_fee'])->name('settings.penalty.fee');
    Route::post('/settings/penalty/fee/store', [SettingController::class, 'penalty_fee_store'])->name('settings.penalty.fee.store');

    //export excel
    Route::get('export/users/active', [UserController::class, 'export']);
});
