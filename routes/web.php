<?php

use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Admin\RoomAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AuthController as ControllersAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Guest\BookingGuestController;
use App\Http\Controllers\invoice\InvoiceController;
use App\Http\Controllers\Landlord\BookingController as LandlordBookingController;

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

// Đăng ký, đăng nhập
Route::get('register', [AuthController::class, 'showFormRegister'])->name('auth.register');
Route::post('register', [AuthController::class, 'handleRegister'])->name('auth.register');
// Route::match(['GET','POST'],'login',[AuthController::class,'handleLogin'])->name('auth.login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('auth.login');
Route::post('login', [AuthController::class, 'handleLogin'])->name('auth.login');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('admin/profile', [AuthController::class, 'showProfileAdmin'])->name('admin.profile');
Route::get('admin/profile/{user}/edit', [ControllersAuthController::class, 'edit'])->name('admin.profile.edit');
Route::put('admin/profile/{user}/update', [AuthController::class, 'update'])->name('admin.profile.update');

Route::get('guest/profile', [AuthController::class, 'showProfileGuest'])->name('guest.profile');

Route::post('/password/send-confirmation-code', [PasswordController::class, 'sendConfirmationCode'])->name('password.sendConfirmationCode');
Route::post('/password/confirm-change', [PasswordController::class, 'confirmPasswordChange'])->name('password.confirmChange');

//quản lý người dùng

Route::get('admin/list-landlord', [UserController::class, 'showListLandlord'])->name('user.listLandlord');
Route::get('admin/list-renter', [UserController::class, 'showListRenter'])->name('user.listRenter');
// Service

Route::get('admin/list-landlord', [UserController::class, 'showListLandlord'])->name('admin.user.listLandlord');
Route::get('admin/list-renter', [UserController::class, 'showListRenter'])->name('admin.user.listRenter');


// LANDLORD(chu tro)

// Service
Route::get('landlord_admin/service', [ServiceController::class, 'index'])->name('landlord_admin.service.list');
Route::get('landlord_admin/service/create', [ServiceController::class, 'create'])->name('landlord_admin.service.create');
Route::post('landlord_admin/service/create', [ServiceController::class, 'store'])->name('landlord_admin.service.store');
Route::get('landlord_admin/service/{id}/edit', [ServiceController::class, 'edit'])->name('landlord_admin.service.edit');
Route::put('landlord_admin/service/{id}', [ServiceController::class, 'update'])->name('landlord_admin.service.update');
Route::delete('landlord_admin/service/{id}', [ServiceController::class, 'destroy'])->name('landlord_admin.service.destroy');

//Room
Route::get('landlord_admin/room', [RoomController::class, 'index'])->name('landlord_admin.room.list');
Route::get('landlord_admin/room/create', [RoomController::class, 'create'])->name('landlord_admin.room.create');
Route::post('landlord_admin/room/create', [RoomController::class, 'store'])->name('landlord_admin.room.store');
Route::get('landlord_admin/room/{id}/edit', [RoomController::class, 'edit'])->name('landlord_admin.room.edit');
Route::put('landlord_admin/room/{id}', [RoomController::class, 'update'])->name('landlord_admin.room.update');
Route::delete('landlord_admin/room/{id}', [RoomController::class, 'destroy'])->name('landlord_admin.room.destroy');
Route::get('landlord_admin/service/{id}', [ServiceController::class, 'show'])->name('landlord_admin.service.show');
Route::get('landlord_admin/room/filter', [RoomController::class, 'filter'])->name('landlord_admin.room.filter');

//Bài viết
Route::get('landlord_admin/article', [ArticleController::class, 'index'])->name('landlord_admin.article.list');
Route::get('landlord_admin/article/create', [ArticleController::class, 'create'])->name('landlord_admin.article.create');
Route::post('landlord_admin/article/create', [ArticleController::class, 'store'])->name('landlord_admin.article.store');
Route::get('landlord_admin/article/{id}/edit', [ArticleController::class, 'edit'])->name('landlord_admin.article.edit');
Route::get('landlord_admin/article/detail/{id}', [ArticleController::class, 'detail'])->name('landlord_admin.article.detail');

Route::put('landlord_admin/article/{id}', [ArticleController::class, 'update'])->name('landlord_admin.article.update');
Route::delete('landlord_admin/article/{id}', [ArticleController::class, 'destroy'])->name('landlord_admin.article.destroy');

Route::get('admin/article', [ArticleController::class, 'index'])->name('article.list');
Route::get('admin/article/create', [ArticleController::class, 'create'])->name('article.create');         // Lấy tất cả bài viết
Route::post('admin/article/create', [ArticleController::class, 'store'])->name('article.store');           // Tạo bài viết mới
Route::get('admin/article/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');   // Lấy bài viết theo ID
Route::put('admin/article/{id}', [ArticleController::class, 'update'])->name('article.update');      // Cập nhật bài viết
Route::delete('admin/article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');  // Xóa bài viết

// --------------------------------------------------------------------------------------------------------------------

//admin chính
Route::get('admin/room', [RoomAdminController::class, 'index'])->name('admin.room.list');
Route::get('admin/room/create', [RoomAdminController::class, 'create'])->name('admin.room.create');
Route::post('admin/room/create', [RoomAdminController::class, 'store'])->name('admin.room.store');
Route::get('admin/room/{id}/edit', [RoomAdminController::class, 'edit'])->name('admin.room.edit');
Route::put('admin/room/{id}', [RoomAdminController::class, 'update'])->name('admin.room.update');
Route::delete('admin/room/{id}', [RoomAdminController::class, 'destroy'])->name('admin.room.destroy');
Route::get('admin/room/filter', [RoomAdminController::class, 'filter'])->name('admin.room.filter');


Route::get('admin/category', [CategoryAdminController::class, 'index'])->name('admin.category.list');
Route::get('admin/category/create', [CategoryAdminController::class, 'create'])->name('admin.category.create');
Route::post('admin/category/create', [CategoryAdminController::class, 'store'])->name('admin.category.store');
Route::get('admin/category/{id}/edit', [CategoryAdminController::class, 'edit'])->name('admin.category.edit');
Route::put('admin/category/{id}', [CategoryAdminController::class, 'update'])->name('admin.category.update');
Route::delete('admin/category/{id}', [CategoryAdminController::class, 'destroy'])->name('admin.category.destroy');


//** guest  */

Route::post('/password/send-confirmation-code',
    [PasswordController::class, 'sendConfirmationCode'])->name('password.sendConfirmationCode');
Route::post('/password/confirm-change',
    [PasswordController::class, 'confirmPasswordChange'])->name('password.confirmChange');

// 
    Route::get('guest/home', [HomeController::class, 'home'])->name('guest.home');
    Route::get('guest/detail/{article}', [HomeController::class, 'detail'])->name('guest.detail');
    Route::get('guest/filter', [HomeController::class, 'filter'])->name('guest.filter');

Route::middleware(['role'])->group(callback: function () {
   
    Route::get('/guest/booking/{id}', [BookingGuestController::class, 'booking'])->name('guest.info.booking');
    Route::post('guest/booking', [BookingGuestController::class, 'store'])->name('guest.booking');

});

// ADMIN
Route::middleware(['auth', 'role.admin:0'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin-main.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/welcome', function () {
        return view('auths.welcome');
    });

    Route::get('admin/profile', [AuthController::class, 'showProfileAdmin'])->name('admin.profile');
    Route::get('admin/profile/{user}/edit', [ControllersAuthController::class, 'edit'])->name('admin.profile.edit');
    Route::put('admin/profile/{user}/update', [AuthController::class, 'update'])->name('admin.profile.update');

    // Quản lý người dùng
    Route::get('admin/list-landlord', [UserController::class, 'showListLandlord'])->name('user.listLandlord');
    Route::get('admin/list-renter', [UserController::class, 'showListRenter'])->name('user.listRenter');

    // Service
    Route::get('admin/list-landlord', [UserController::class, 'showListLandlord'])->name('admin.user.listLandlord');
    Route::get('admin/list-renter', [UserController::class, 'showListRenter'])->name('admin.user.listRenter');

    Route::get('admin/article', [ArticleAdminController::class, 'index'])->name('admin.article.list');


    Route::get('admin/article/{id}/detail',
        [ArticleAdminController::class, 'detail'])->name('admin.article.detail');   // Lấy bài viết theo ID

    Route::delete('admin/article/{id}',
        [ArticleAdminController::class, 'destroy'])->name('admin.article.destroy');  // Xóa bài viết
    Route::post('admin/article/{id}/confirm',
        [ArticleAdminController::class, 'confirm'])->name('admin.article.confirm');   // Lấy bài viết theo ID

    // --------------------------------------------------------------------------------------------------------------------

//Room
Route::get('landlord_admin/room', [RoomController::class, 'index'])->name('landlord_admin.room.list');
Route::get('landlord_admin/room/create', [RoomController::class, 'create'])->name('landlord_admin.room.create');
Route::post('landlord_admin/room/create', [RoomController::class, 'store'])->name('landlord_admin.room.store');
Route::get('landlord_admin/room/{id}/edit', [RoomController::class, 'edit'])->name('landlord_admin.room.edit');
Route::put('landlord_admin/room/{id}', [RoomController::class, 'update'])->name('landlord_admin.room.update');
Route::delete('landlord_admin/room/{id}', [RoomController::class, 'destroy'])->name('landlord_admin.room.destroy');
Route::get('landlord_admin/service/{id}', [ServiceController::class, 'show'])->name('landlord_admin.service.show');
    // Admin chính
    Route::get('admin/room', [RoomAdminController::class, 'index'])->name('admin.room.list');
    Route::get('admin/room/create', [RoomAdminController::class, 'create'])->name('admin.room.create');
    Route::post('admin/room/create', [RoomAdminController::class, 'store'])->name('admin.room.store');
    Route::get('admin/room/{id}/edit', [RoomAdminController::class, 'edit'])->name('admin.room.edit');
    Route::put('admin/room/{id}', [RoomAdminController::class, 'update'])->name('admin.room.update');
    Route::delete('admin/room/{id}', [RoomAdminController::class, 'destroy'])->name('admin.room.destroy');

    Route::get('admin/category', [CategoryAdminController::class, 'index'])->name('admin.category.list');
    Route::get('admin/category/create', [CategoryAdminController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category/create', [CategoryAdminController::class, 'store'])->name('admin.category.store');
    Route::get('admin/category/{id}/edit', [CategoryAdminController::class, 'edit'])->name('admin.category.edit');
    Route::put('admin/category/{id}', [CategoryAdminController::class, 'update'])->name('admin.category.update');
    Route::delete('admin/category/{id}', [CategoryAdminController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('admin/booking', [BookingAdminController::class, 'index'])->name('admin.booking.list');
});

// LANDLORD (chu tro)
Route::middleware(['auth', 'role.landlord:1'])->group(function () {
    Route::get('landlord_admin/dashboard', function () {
        return view('landlord_admin.dashboard');
    })->name('landlord_admin.dashboard');
    Route::get('/landlord_admin/welcome', function () {
        return view('landlord_admin.auths.welcome');
    });

//Bài viết
Route::get('landlord_admin/article', [ArticleController::class, 'index'])->name('landlord_admin.article.list');
Route::get('landlord_admin/article/create', [ArticleController::class, 'create'])->name('landlord_admin.article.create');
Route::post('landlord_admin/article/create', [ArticleController::class, 'store'])->name('landlord_admin.article.store');
Route::get('landlord_admin/article/{id}/edit', [ArticleController::class, 'edit'])->name('landlord_admin.article.edit');
Route::get('landlord_admin/article/detail/{id}', [ArticleController::class, 'detail'])->name('landlord_admin.article.detail');

Route::put('landlord_admin/article/{id}', [ArticleController::class, 'update'])->name('landlord_admin.article.update');
Route::delete('landlord_admin/article/{id}', [ArticleController::class, 'destroy'])->name('landlord_admin.article.destroy');
    // Service
    Route::get('landlord_admin/service', [ServiceController::class, 'index'])->name('landlord_admin.service.list');
    Route::get('landlord_admin/service/create',
        [ServiceController::class, 'create'])->name('landlord_admin.service.create');
    Route::post('landlord_admin/service/create',
        [ServiceController::class, 'store'])->name('landlord_admin.service.store');
    Route::get('landlord_admin/service/{id}', [ServiceController::class, 'show'])->name('landlord_admin.service.show');
    Route::get('landlord_admin/service/{id}/edit',
        [ServiceController::class, 'edit'])->name('landlord_admin.service.edit');
    Route::put('landlord_admin/service/{id}',
        [ServiceController::class, 'update'])->name('landlord_admin.service.update');
    Route::delete('landlord_admin/service/{id}',
        [ServiceController::class, 'destroy'])->name('landlord_admin.service.destroy');

    // Room
    Route::get('landlord_admin/room', [RoomController::class, 'index'])->name('landlord_admin.room.list');
    Route::get('landlord_admin/room/create', [RoomController::class, 'create'])->name('landlord_admin.room.create');
    Route::post('landlord_admin/room/create', [RoomController::class, 'store'])->name('landlord_admin.room.store');
    Route::get('landlord_admin/room/{id}/edit', [RoomController::class, 'edit'])->name('landlord_admin.room.edit');
    Route::put('landlord_admin/room/{id}', [RoomController::class, 'update'])->name('landlord_admin.room.update');
    Route::delete('landlord_admin/room/{id}', [RoomController::class, 'destroy'])->name('landlord_admin.room.destroy');

    // Bài viết
    Route::get('landlord_admin/article', [ArticleController::class, 'index'])->name('landlord_admin.article.list');
    Route::get('landlord_admin/article/create',
        [ArticleController::class, 'create'])->name('landlord_admin.article.create');
    Route::post('landlord_admin/article/create',
        [ArticleController::class, 'store'])->name('landlord_admin.article.store');
    Route::get('landlord_admin/article/{id}/edit',
        [ArticleController::class, 'edit'])->name('landlord_admin.article.edit');
    Route::put('landlord_admin/article/{id}',
        [ArticleController::class, 'update'])->name('landlord_admin.article.update');
    Route::delete('landlord_admin/article/{id}',
        [ArticleController::class, 'destroy'])->name('landlord_admin.article.destroy');



    //booking

    Route::get('landlord_admin/booking', [LandlordBookingController::class, 'index'])->name('landlord_admin.booking.list');
    Route::get('landlord_admin/{id}/detail', [LandlordBookingController::class, 'detail'])->name('landlord_admin.booking.detail');
    Route::post('landlord_admin/{id}/confirmed', [LandlordBookingController::class, 'confirmed'])->name('landlord_admin.booking.confirmed');
    Route::get('landlord_admin/{id}/cancel-reason', [LandlordBookingController::class, 'formCancel'])->name('landlord_admin.booking.formCancel');

    Route::get('landlord_admin/{id}/cancelled', [LandlordBookingController::class, 'cancelled'])->name('landlord_admin.booking.cancelled');
    Route::get('landlord_admin/formInvoice/{id}',[InvoiceController::class,'index'])->name('invoice.indexForm');
    Route::post('/invoices/{booking}', [InvoiceController::class, 'store'])->name('invoices.store');



});