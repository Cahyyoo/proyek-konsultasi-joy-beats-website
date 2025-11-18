<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Route as RoutingRoute;
use App\Http\Controllers\PemesananMakananController;
use App\Http\Controllers\PermainanController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\MinumanController;

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
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'proses'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/home', [LoginController::class, 'home']);
    Route::prefix('admin')->middleware(['checkRole:admin'])->group(function () {
        Route::get('dashboard',[LoginController::class, 'dashboard_admin']);
        Route::resource('data-pemesanan-makanan-minuman', PemesananMakananController::class);
        Route::resource('data-permainan', PermainanController::class);
        Route::resource('data-barcode', BarcodeController::class);
        Route::resource('data-makanan', MakananController::class);
        Route::resource('data-minuman', MinumanController::class);
    });
});

