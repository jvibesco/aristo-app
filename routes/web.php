<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProsesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanOrderController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ActualProduksiController;
use App\Http\Controllers\LaporanProduksiController;
use App\Http\Controllers\LaporanFlowProsesController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    // route master customer
    Route::get('master/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('master/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('master/customer/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('master/customer/{customer}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('master/customer/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    // route master material
    Route::get('master/material', [MaterialController::class, 'index'])->name('material.index');
    Route::post('master/material', [MaterialController::class, 'store'])->name('material.store');
    Route::get('master/material/{material}/edit', [MaterialController::class, 'edit'])->name('material.edit');
    Route::put('master/material/{material}', [MaterialController::class, 'update'])->name('material.update');
    Route::delete('master/material/{material}', [MaterialController::class, 'destroy'])->name('material.destroy');

    // route master proses
    Route::get('master/proses', [ProsesController::class, 'index'])->name('proses.index');
    Route::post('master/proses', [ProsesController::class, 'store'])->name('proses.store');
    Route::put('master/proses/{proses}', [ProsesController::class, 'update'])->name('proses.update');
    Route::delete('master/proses/{proses}', [ProsesController::class, 'destroy'])->name('proses.destroy');


    // route order
    Route::get('order', [OrderController::class, 'index'])->name('joborder.index');
    Route::get('order/create', [OrderController::class, 'create'])->name('joborder.create');
    Route::get('order/{order}', [OrderController::class, 'show'])->name('joborder.show');
    Route::post('order', [OrderController::class, 'store'])->name('joborder.store');
    Route::get('order/{order}/edit', [OrderController::class, 'edit'])->name('joborder.edit');
    Route::put('order/{order}', [OrderController::class, 'update'])->name('joborder.update');
    Route::delete('order/{order}', [OrderController::class, 'destroy'])->name('joborder.destroy');
    Route::get('getGambar/{order}', [OrderController::class, 'getGambar'])->name('getGambar');

    // route flow proses
    Route::get('flowproses', [FlowController::class, 'index'])->name('flowproses.index');
    Route::post('flowproses', [FlowController::class, 'store'])->name('flowproses.store');
    Route::put('flowproses/{flowproses}', [FlowController::class, 'update'])->name('flowproses.update');
    Route::delete('flowproses/{flowproses}', [FlowController::class, 'destroy'])->name('flowproses.destroy');

    // route schedule flow proses
    Route::get('scheduleflowproses', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::post('scheduleflowproses', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::put('scheduleflowproses/{part}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::get('getData', [ScheduleController::class, 'getData'])->name('data');


    // route actual produksi
    Route::get('actualproduksi', [ActualProduksiController::class, 'index'])->name('actual.index');
    Route::post('actualproduksi', [ActualProduksiController::class, 'store'])->name('actual.store');
    Route::put('actualproduksi/{actual}', [ActualProduksiController::class, 'update'])->name('actual.update');
    Route::delete('actualproduksi/{actual}', [ActualProduksiController::class, 'destroy'])->name('actual.destroy');

    // route rencana flow proses
    Route::get('prosesjoborder', [LaporanFlowProsesController::class, 'index'])->name('laporanflowproses.index');

    // route laporan status order
    Route::get('laporanstatusorder', [LaporanOrderController::class, 'index'])->name('laporanorder.index');

    // route laporan produksi
    Route::get('laporanproduksi', [LaporanProduksiController::class, 'index'])->name('laporanproduksi.index');

    //route users
    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::post('users', [UserController::class, 'store'])->name('user.store');
    Route::put('users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // route logout
    Route::post('logout', LogoutController::class)->name('logout');

    // AJAX
    Route::get('jobOrderGet/{id}', [OrderController::class, 'getNoJo'])->name('getJobOrder');
    Route::get('prosesGet', [FlowController::class, 'getProses'])->name('getProses');
    Route::get('partGet/{id}', [ActualProduksiController::class, 'getPart'])->name('getPart');
    Route::get('getFlowProses', [ActualProduksiController::class, 'getFlowProses'])->name('getFlowProses');
});

// route register dan login
Route::middleware('guest')->group(function () {
    // Route::get('register', [RegistrationController::class, 'create'])->name('register');
    // Route::post('register', [RegistrationController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']); // valid menggunakana route name login karena sama.
});
