<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\UserPenaltyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\LandingController;
use App\Models\Setting;

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
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/users/active', [LandingController::class, 'users'])->name('landing.users.active');
Route::get('/logo', function () {
    (Setting::where('key', 'logo')->exists()) ? $logo = Setting::where('key', 'logo')->first()->content : $logo = null;
    return URL::to('/'.$logo);
})->name('logo');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['role:Super Admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('events', EventController::class);
    Route::resource('events.users', UserEventController::class);
    Route::resource('managements', ManagementController::class);
    Route::resource('settings/general', SettingController::class)->only(['index', 'store']);

    Route::post('/events/{event}/done', [EventController::class, 'done'])->name('events.done');
    Route::get('/events/{event}/penalties', [UserPenaltyController::class, 'index'])->name('events.penalties.index');
    Route::post('/penalties/{userPenalty}', [UserPenaltyController::class, 'paid'])->name('penalties.paid');
    Route::get('/settings/penalty/fee', [SettingController::class, 'penalty_fee'])->name('settings.penalty.fee');
    Route::post('/settings/penalty/fee/store', [SettingController::class, 'penalty_fee_store'])->name('settings.penalty.fee.store');
    Route::get('/settings/picture', [SettingController::class, 'picture'])->name('settings.picture');

    //export excel
    Route::get('export/users/active', [UserController::class, 'export_active'])->name('export.users.active');
    Route::get('export/users/unactive', [UserController::class, 'export_unactive'])->name('export.users.unactive');
    Route::get('export/users/penalty', [UserPenaltyController::class, 'export'])->name('export.users.penalty');
});
