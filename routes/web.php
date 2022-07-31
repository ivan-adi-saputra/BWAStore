<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\ProductGalleryAdminController;
use App\Http\Controllers\Admin\TransactionAdminController;
use App\Http\Controllers\Admin\UserAdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('categories', [CategoryController::class, 'index'])->name('categories');

Route::get('details/{id}', [DetailController::class, 'index'])->name('details');

Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::get('success', [CartController::class, 'success'])->name('success');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('dashboard/products', [DashboardProductController::class, 'index'])->name('dashboard-product');
Route::get('dashboard/products/create', [DashboardProductController::class, 'create'])->name('dashboard-product-create');
Route::get('dashboard/products/{id}', [DashboardProductController::class, 'details'])->name('dashboard-product-details');

Route::get('dashboard/transaction', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
Route::get('dashboard/transaction/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');

Route::get('dashboard/setting', [DashboardSettingController::class, 'setting'])->name('dashboard-settings');
Route::get('dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-account');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register-store');
Route::get('register/success', [RegisterController::class, 'success'])->name('register-success');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')
      // ->namespace('Admin')
      ->group(function() {
        Route::get('/', [DashboardAdminController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', CategoryAdminController::class);
        Route::resource('user', UserAdminController::class);
        Route::resource('product', ProductAdminController::class);
        Route::resource('product-gallery', ProductGalleryAdminController::class);
        Route::resource('transaction', TransactionAdminController::class);
      });
