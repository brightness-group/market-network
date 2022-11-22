<?php


use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    GoogleController,
    FacebookController,
    PackageController,
    SnapshotController,
    UserController,
    CategoryController,
    CmsController
};
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SnapshotController as AdminSnapshotController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\AnalyticsController as AdminAnalyticsController;

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

Route::get('/', [SnapshotController::class, 'home'])->name('home');

# Facebook login
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

# Google login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/search', [SnapshotController::class, 'search'])->name('search');

Route::get('registration', Register::class)->name('registration');

Route::get('cms', [CmsController::class, 'index'])->name('cms');

Route::group(['middleware' => 'auth'], function () {
    // Route::view('/dashboard', 'dashboard')->name('dashboard');
    // added temporary route
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    Route::view('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/{uuid}', [UserController::class, 'userProfile'])->name('user-profile');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/follow', [UserController::class, 'follow'])->name('follow');
    Route::get('/cart', [UserController::class, 'cart'])->name('cart');
    Route::get('/checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::get('/cart-checkout', [UserController::class, 'cartCheckout'])->name('cart.checkout');
    Route::get('/calendar', [UserController::class, 'calendar'])->name('calendar');
    Route::get('/purchases', [UserController::class, 'purchases'])->name('purchases');
    Route::get('/sales', [UserController::class, 'sales'])->name('sales');
    Route::get('/payment', [UserController::class, 'payment']);
    Route::get('/handle-payment/success', [UserController::class, 'paymentSuccess']);
    Route::get('/handle-payment/cancel', [UserController::class, 'paymentCancel']);
    Route::get('/handle-payment/declined', [UserController::class, 'paymentDeclined']);

    Route::group(['prefix' => 'snaps'], function () {
        Route::view('/', 'snaps')->name('snaps');
        Route::view('/create', 'snaps')->name('snaps.create');
        Route::get('/edit/{snapshot}', [SnapshotController::class, 'editSnapshot'])->name('snaps.edit');
        Route::get('/{slug}', [SnapshotController::class, 'getSnapshot'])->name('snaps.get');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('profile', [UserController::class, 'profileSettings'])->name('profile.settings');
        Route::get('package', [PackageController::class, 'packageSettings'])->name('package.settings');
        Route::get('account', [UserController::class, 'accountSettings'])->name('account.settings');
    });
});

/* Admin Routes */
Route::get('/admin', [AdminUserController::class, 'login'])->name('adminLogin');
Route::post('/admin/logout', [AdminUserController::class, 'logout'])->name('admin.logout');
Route::get('/admin/forgot-password', [AdminUserController::class, 'forgotPassword'])->name('admin.forgot.password');
Route::get('/admin/reset-password', [AdminUserController::class, 'resetPassword'])->name('admin.reset.password');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::get('/analytics', [AdminAnalyticsController::class, 'index'])->name('admin.analytics');
        Route::get('/users', [AdminUserController::class, 'users'])->name('admin.users');
        Route::get('/user/{uuid}', [AdminUserController::class, 'userProfile'])->name('admin.user-profile');
        Route::get('/snapshots', [AdminSnapshotController::class, 'snapshots'])->name('admin.snapshots');
        Route::get('/snapshot/{slug}', [AdminSnapshotController::class, 'snapshot'])->name('admin.snapshot');
        Route::get('/snapshot-approval/{slug}', [AdminSnapshotController::class, 'snapshotApproval'])->name('admin.snapshot.approval');
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
        Route::get('/categories/{slug}', [AdminCategoryController::class, 'category'])->name('admin.category');
        Route::get('/settings', [AdminSettingController::class, 'settings'])->name('admin.settings');
        Route::get('/reviews', [AdminUserController::class, 'reviews'])->name('admin.reviews');


        Route::get('/profile', [AdminUserController::class, 'profile'])->name('admin.profile');
    });
});
