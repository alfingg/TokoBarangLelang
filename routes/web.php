<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor

/* ============================================================
| 🏠 PUBLIC AREA – Pengunjung dapat melihat produk tanpa login
|============================================================ */
Route::get('/', [ProductController::class, 'index'])->name('home');

// Rute daftar produk umum (sudah kita tambahkan sebelumnya)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// --------------------------------------------------------------------------------------------------

/* ============================================================
| 👤 DASHBOARD & PROFIL (Butuh login)
|============================================================ */

// KOREKSI UTAMA: Mengganti rute /dashboard lama dengan logika pengalihan (redirect)
Route::get('/dashboard', function () {
    $user = Auth::user();
 


    if ($user && $user->role === 'admin') { 
       return redirect()->route('admin.dashboard');
    }
   

   return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --------------------------------------------------------------------------------------------------

/* ============================================================
| 🛒 BUYER AREA – Hanya untuk user biasa (role != 'admin')
|============================================================ */
Route::middleware(['auth', 'isBuyer'])->group(function () {
// ... (Bagian Keranjang, Checkout, Pesanan user, dan Quick order tetap sama)
// ...


   Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
   Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
   Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');


   Route::get('/checkout', [OrderController::class, 'checkoutForm'])->name('checkout.form'); // form checkout
   Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store'); // simpan order


   Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
   Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

   Route::post('/order/quick/{product}', [OrderController::class, 'quickOrder'])->name('orders.quick');
   Route::post('/order/direct/{product}', [OrderController::class, 'orderDirect'])->name('orders.direct');
});

// --------------------------------------------------------------------------------------------------

/* ============================================================
| 🧭 ADMIN AREA – Hanya untuk user dengan role = 'admin'
|============================================================ */
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


       Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
 
// ...

// Produk (CRUD)
        Route::controller(ProductAdminController::class)
            ->prefix('products')
            ->name('products.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{product}/edit', 'edit')->name('edit');
                Route::put('/{product}', 'update')->name('update');
                Route::delete('/{product}', 'destroy')->name('destroy');
        });

        // Kategori (CRUD)
        Route::controller(CategoryAdminController::class)
            ->prefix('categories')
            ->name('categories.')
            ->group(function () {
             Route::get('/', 'index')->name('index');
             Route::get('/create', 'create')->name('create');
             Route::post('/', 'store')->name('store');
             Route::get('/{category}/edit', 'edit')->name('edit');
             Route::put('/{category}', 'update')->name('update');
             Route::delete('/{category}', 'destroy')->name('destroy');
          });

// Order management (admin)
      Route::controller(OrderAdminController::class)
            ->prefix('orders')
            ->name('orders.')
            ->group(function () {
                Route::get('/', 'index')->name('index'); // daftar pesanan (admin)
                Route::get('/{order}', 'show')->name('show'); // detail pesanan (admin)
                Route::put('/{order}/status', 'updateStatus')->name('update-status'); // ubah status pesan
                Route::delete('/{order}', 'destroy')->name('destroy');// TAMBAH: Rute Hapus Pesanan
       });
    });

// --------------------------------------------------------------------------------------------------

/* ============================================================
| 🔐 AUTH (Login, Register, Password reset, dll)
|============================================================ */
require __DIR__ . '/auth.php';

/* ============================================================
| 🚫 FALLBACK (404 – Not Found)
|============================================================ */
Route::fallback(function () {
    return redirect()->route('home')->with('error', 'Halaman tidak ditemukan.');
});
