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
use App\Http\Controllers\CheckoutController;

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
Route::get('categories-details/{id}', [CategoryController::class, 'details'])->name('categories-details');

Route::get('details/{id}', [DetailController::class, 'index'])->name('details');


Route::get('success', [CartController::class, 'success'])->name('success');

Route::post('checkout/callback', [CheckoutController::class, 'callback'])->name('checkout-callback')->middleware('auth');



Route::get('register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->name('register-store');
Route::get('register/success', [RegisterController::class, 'success'])->name('register-success');

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function() {
      Route::get('cart', [CartController::class, 'index'])->name('cart');
      Route::post('cart/add/{id}', [CartController::class, 'Add'])->name('cart-add');
      Route::post('cart/{id}', [CartController::class, 'Delete'])->name('cart-delete');

      Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

      Route::get('dashboard/products', [DashboardProductController::class, 'index'])->name('dashboard-product');
      Route::get('dashboard/products/create', [DashboardProductController::class, 'create'])->name('dashboard-product-create');
      Route::post('dashboard/products/store', [DashboardProductController::class, 'store'])->name('dashboard-product-store');
      Route::get('dashboard/products/{id}', [DashboardProductController::class, 'details'])->name('dashboard-product-details');
      Route::post('dashboard/products/{id}/update', [DashboardProductController::class, 'update'])->name('dashboard-product-update');

      Route::post('dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])->name('dashboard-product-gallery-upload');
      Route::get('dashboard/products/gallery/{id}', [DashboardProductController::class, 'deleteGallery'])->name('dashboard-product-gallery-delete');

      Route::get('dashboard/transaction', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
      Route::get('dashboard/transaction/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');

      Route::get('dashboard/setting', [DashboardSettingController::class, 'setting'])->name('dashboard-settings');
      Route::post('dashboard/setting/{redirect}', [DashboardSettingController::class, 'storeSetting'])->name('dashboard-settings-store');
      Route::get('dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-account');
      Route::post('dashboard/account/store', [DashboardSettingController::class, 'storeAccount'])->name('dashboard-account-store');

      Route::post('checkout', [CheckoutController::class, 'proccess'])->name('checkout');

});

Route::prefix('admin')
      ->middleware('admin')
      // ->namespace('Admin')
      ->group(function() {
        Route::get('/', [DashboardAdminController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', CategoryAdminController::class);
        Route::resource('user', UserAdminController::class);
        Route::resource('product', ProductAdminController::class);
        Route::resource('product-gallery', ProductGalleryAdminController::class);
        Route::resource('transaction', TransactionAdminController::class);
      });
