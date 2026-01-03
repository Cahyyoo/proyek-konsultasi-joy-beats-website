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
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PemesananPermainanController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\checkout\CheckoutController;
use App\Http\Controllers\Invoice\InvoiceController;

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

Route::get('/', [UserController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [LoginController::class, 'register'])->name('register')->middleware('guest');
Route::post('/login', [LoginController::class, 'proses'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Route Pesan Tempat
Route::get('/pesan-tempat', [PemesananPermainanController::class, 'pesan_tempat']);
Route::get('/booking-tempat/{id}', [PemesananPermainanController::class, 'booking_tempat']);
Route::get('/bayar-tempat/{id}', [PemesananPermainanController::class, 'bayar_tempat']);
Route::get('/booking-tempat/invoice/{id}', [InvoiceController::class, 'invoice_tempat'])
    ->name('booking.invoice');
Route::get('/booking-tempat/invoice_pdf/{id}', [InvoiceController::class, 'invoice_tempat_pdf'])
    ->name('booking.invoice.pdf');


// Route Pesan makanan
Route::get('/pesan-makanan/{id}', [PemesananMakananController::class, 'pesan_makan']);
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/{id}', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/pembayaran-makanan/{id}', [CheckoutController::class, 'pembayaranMakanan'])
    ->name('pembayaran.makanan');
Route::get('/invoice/{transaksi}', [InvoiceController::class, 'show'])
    ->name('invoice.show');
Route::get('/invoice/{barcode}/download', [InvoiceController::class, 'download'])
    ->name('invoice.download');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::middleware('auth')->group(function () {
    Route::get('/home', [LoginController::class, 'home']);
    Route::get('/dashboard',[LoginController::class, 'dashboard_admin']);
    Route::prefix('admin')->middleware(['checkRole:admin'])->group(function () {
        Route::resource('data-permainan', PermainanController::class);
        Route::resource('data-barcode', BarcodeController::class);
        Route::resource('data-makanan', MakananController::class);
        Route::resource('data-minuman', MinumanController::class);
    });

    Route::prefix('kasir')->middleware(['checkRole:kasir'])->group(function () {
        Route::resource('data-pemesanan-makanan-minuman', PemesananMakananController::class);
        Route::get('/pay/{id}', [PaymentController::class, 'pay'])->name("kasir.pay.kode");
    });
});

