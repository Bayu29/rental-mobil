<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MerchantsCategoryController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingAppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Auth::routes(['register' => false]);

Route::get('/dashboard', function () {
    return redirect()->route('dashboard');
});
Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
    Route::post('/car_chart', 'car_chart')->name('dashboard.car_chart');
});

Route::prefix('panel')->middleware('auth')->group(function () {
    // roles
    Route::resource('/roles', RolesController::class);
    // user
    Route::resource('/user', UserController::class);
    // setting app
    Route::controller(SettingAppController::class)->group(function () {
        Route::get('/settingApp/{id}', 'index')->name('settingApp.index');
        Route::put('/settingApp/update/{id}', 'update')->name('settingApp.update');
    });
    //Car
    Route::controller(CarController::class)->group(function() {
        Route::get('/car', 'index')->name('car.index');
        Route::get('/car/create', 'add')->name('car.create');
        Route::get('/car/{id}', 'edit')->name('car.edit');
        Route::post('/car/store', 'store')->name('car.store');
        Route::post('/car/update/{id}', 'update')->name('car.update');
        Route::delete('car/delete', 'delete')->name('car.delete');
    });
    Route::controller(DriverController::class)->group(function() {
        Route::get('/driver', 'index')->name('driver.index');
        Route::get('/driver/create', 'add')->name('driver.create');
        Route::get('/driver/{id}', 'edit')->name('driver.edit');
        Route::post('/driver/store', 'store')->name('driver.store');
        Route::post('/driver/update/{id}', 'update')->name('driver.update');
        Route::delete('driver/delete', 'delete')->name('driver.delete');
    });
    Route::controller(TransactionController::class)->group(function() {
        Route::get('/transaction', 'index')->name('transaction.index');
        Route::get('/transaction/create', 'create')->name('transaction.create');
        Route::get('/transaction/update/{id}', 'edit')->name('transaction.edit');
        Route::get('/transaction/report', 'report')->name('transaction.report');
        Route::post('/transaction/store', 'store')->name('transaction.store');
        Route::post('/transaction/update/{id}', 'update')->name('transaction.update');
        Route::post('/transaction/calculation', 'calculation')->name('transaction.calculation');
        Route::post('/transaction/export_excel', 'export_excel')->name('transaction.export_excel');
    });
    // activity log
    Route::controller(ActivityLogController::class)->group(function () {
        Route::get('/activity_log', 'index')->name('activity_log.index');
    });
});
