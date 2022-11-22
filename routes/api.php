<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    UserController,
    CategoryController,
    TagController,
    SnapshotController,
    PackageController,
    CommentController,
    CalendarCategoryController,
    CalendarController
};
use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\Admin\SnapshotController as AdminSnapshotController;
use App\Http\Controllers\Api\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\Admin\AnalyticsController as AdminAnalyticsController;
use App\Http\Controllers\Api\Admin\PromocodeController as AdminPromocodeController;
use App\Http\Controllers\Api\Admin\SettingController as AdminSettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Open APIs  */
Route::get('/collaborators', [UserController::class, 'collaborators']);

Route::get('/locations', [UserController::class, 'getLocations']);

Route::get('/professions', [UserController::class, 'getProfessions']);

Route::get('/site-settings', [UserController::class, 'getSettings']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/all_categories', [CategoryController::class, 'allCategories']);

Route::get('/tags', [TagController::class, 'index']);

Route::post('/save_newsletter', [UserController::class, 'saveNewsletter']);

Route::get('/snapshots', [SnapshotController::class, 'index']);

Route::get('/snapshot/edit/{snapshot}', [SnapshotController::class, 'getSnapshotById'])->name('snapshot.edit');

Route::get('/search', [SnapshotController::class, 'search']);

Route::get('/search_detail', [SnapshotController::class, 'searchDetails']);

Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/social-register', [AuthController::class, 'socialRegister']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

Route::post('/send-otp', [AuthController::class, 'sendOtp']);

Route::get('/get_calendar_categories', [CalendarCategoryController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function ($router) {
    Route::get('/me', function(Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/profile', [UserController::class, 'index']);

    Route::get('/profile-details', [UserController::class, 'getProfilePageDetails']);

    Route::get('/profile/{uuid}', [UserController::class, 'show']);

    Route::get('/account-details', [UserController::class, 'getAccountDetails']);

    Route::get('/moodboards', [SnapshotController::class, 'moodboards']);

    Route::get('/snapshot', [SnapshotController::class, 'show']);

    Route::post('/snapshots', [SnapshotController::class, 'store']);

    Route::post('/upload_snaps', [SnapshotController::class, 'uploadSnaps']);

    Route::post('/delete_snaps', [SnapshotController::class, 'deleteSnaps']);

    Route::post('/like_snapshot', [SnapshotController::class, 'like']);

    Route::post('/snapshot/like', [SnapshotController::class, 'likeSnapshot']);
    
    Route::post('/snapshot/save_moodboard', [SnapshotController::class, 'saveMoodboard']);

    Route::post('/save_moodboard', [SnapshotController::class, 'moodboard']);

    Route::post('/save_comment', [CommentController::class, 'saveComment']);

    Route::get('/comments', [CommentController::class, 'index']);

    Route::get('/child_categories', [CategoryController::class, 'childCategories']);

    Route::get('/user_follow', [UserController::class, 'userFollow']);

    Route::post('/follow', [UserController::class, 'follow']);

    Route::post('/shortlist', [UserController::class, 'shortlist']);

    Route::get('/followee', [UserController::class, 'followee']);

    Route::get('/follower', [UserController::class, 'follower']);

    Route::get('/snapshot/{slug}', [SnapshotController::class, 'getSnapshotBySlug'])->name('snapshot.get.slug');

    Route::get('/user/snapshots', [SnapshotController::class, 'getUserSnapshots']);

    Route::get('/user/categories', [SnapshotController::class, 'getUserSnapshotsByCategory']);

    Route::get('/user/moodboards', [SnapshotController::class, 'getUserMoodboards']);

    Route::get('/user/packages/{id}', [PackageController::class, 'userPackages']);

    Route::post('/add_to_cart', [UserController::class, 'addToCart']);

    Route::get('/get_cart', [UserController::class, 'getCart']);

    Route::post('/delete_cart_item', [UserController::class, 'deleteCartItem']);

    Route::post('/clear_cart', [UserController::class, 'clearCart']);

    Route::post('/update_cart', [UserController::class, 'updateCart']);

    Route::post('/delete_discount', [UserController::class, 'deleteCartDiscount']);

    Route::post('/save_contact_details', [UserController::class, 'saveContactDetails']);
    
    Route::post('/save_billing_address', [UserController::class, 'saveBillingAddressDetails']);
    
    Route::post('/save_card_details', [UserController::class, 'saveCardDetails']);
    
    Route::get('/get_vendors/{order_id}', [UserController::class, 'getVendors']);

    Route::get('/calendar', [CalendarController::class, 'index']);

    Route::post('/calendar', [CalendarController::class, 'saveCalendar']);

    Route::get('/attendees', [CalendarController::class, 'attendees']);

    Route::post('/invite-user', [UserController::class, 'inviteUser']);

    // Route::get('/reviews', [SnapshotController::class, 'reviews']);

    Route::get('/orders/completed', [UserController::class, 'completedOrders']);

    Route::group(['prefix' => '/settings'], function () {

        Route::post('/package', [PackageController::class, 'store'])->name('package.store');

        Route::post('/profile', [UserController::class, 'saveProfile'])->name('profile.store');

        Route::post('/upload', [UserController::class, 'uploadImage'])->name('profile.upload');

        Route::get('/package/{type}', [PackageController::class, 'show'])->name('package.show');

        Route::get('/packages', [PackageController::class, 'index'])->name('package.index');

        Route::post('/account/preferences', [UserController::class, 'saveAccountPreferences'])->name('account.store.preferences');

        Route::post('/account/notifications', [UserController::class, 'saveAccountNotifications'])->name('account.store.notifications');

        Route::post('/account/password', [UserController::class, 'changePassword'])->name('account.change_password');

        Route::post('/account/delete', [UserController::class, 'deleteAccount'])->name('account.delete');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


$router->group(['middleware' => 'auth:sanctum'], function ($router) {

});

/* Admin API routes */

Route::post('/admin/login', [\App\Http\Controllers\Api\Admin\AuthController::class, 'login'])->name('adminlogin');

Route::post('/admin/forgot-password', [\App\Http\Controllers\Api\Admin\AuthController::class, 'forgotPassword'])->name('admin.forgotpassword');

Route::post('/admin/reset-password', [\App\Http\Controllers\Api\Admin\AuthController::class, 'resetPassword'])->name('admin.resetpassword');

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'admin'], function() {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.get');

        Route::get('/analytics', [AdminAnalyticsController::class, 'index'])->name('admin.analytics.index');
        
        Route::get('/chart_analytics', [AdminAnalyticsController::class, 'chartAnalytics'])->name('admin.analytics.chart');

        Route::get('/customer_growth_analytics', [AdminAnalyticsController::class, 'customerGrowthAnalytics'])->name('admin.analytics.chart');

        Route::get('/sales_chart_analytics', [AdminAnalyticsController::class, 'salesChartAnalytics'])->name('admin.sales.chart');

        Route::get('/users_chart_analytics', [AdminAnalyticsController::class, 'userChartAnalytics'])->name('admin.sales.chart');
        
        Route::get('/users', [AdminUserController::class, 'users'])->name('admin.users');

        Route::get('/user/{uuid}', [AdminUserController::class, 'userProfile'])->name('admin.user.profile');

        Route::post('/user', [AdminUserController::class, 'saveUser'])->name('admin.saveuser');

        Route::post('/user/update', [AdminUserController::class, 'updateUser'])->name('admin.updateuser');

        Route::get('/snapshots', [AdminSnapshotController::class, 'snapshots'])->name('admin.snapshots');

        Route::get('/snapshot/{slug}', [AdminSnapshotController::class, 'getSnapshot'])->name('admin.snapshot.detail');

        Route::post('/snapshot/approve', [AdminSnapshotController::class, 'approveSnapshot'])->name('admin.snapshot.approve');

        Route::post('/snapshot/reject', [AdminSnapshotController::class, 'rejectSnapshot'])->name('admin.snapshot.reject');

        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');

        Route::post('/categories', [AdminCategoryController::class, 'saveCategory'])->name('admin.categories.save');

        Route::get('/categories/{slug}', [AdminCategoryController::class, 'getCategory'])->name('admin.category.detail');

        Route::post('/categories/delete', [AdminCategoryController::class, 'deleteCategory'])->name('admin.categories.delete');

        Route::post('/settings', [AdminSettingController::class, 'saveSettings'])->name('admin.settings.save');

        Route::get('/timezone', [AdminSettingController::class, 'getTimezoneList'])->name('admin.settings.timezone');

        Route::get('/admin-users', [AdminUserController::class, 'adminUsers'])->name('admin.adminusers');

        Route::get('/admin-users/{id}', [AdminUserController::class, 'getAdminUser'])->name('admin.getadminuser');

        Route::post('/admin-users', [AdminUserController::class, 'saveAdminUser'])->name('admin.adminusers.save');

        Route::post('/admin-users/edit', [AdminUserController::class, 'editAdminUser'])->name('admin.adminusers.edit');

        Route::post('/admin-users/delete', [AdminUserController::class, 'deleteAdminUser'])->name('admin.adminusers.delete');

        Route::post('/admin-users/request-profile-image', [AdminUserController::class, 'profileImageChangeRequest'])->name('admin.adminusers.changeprofileimagerequest');

        Route::get('/admin-roles', [AdminUserController::class, 'getAdminRoles'])->name('admin.adminroles');

        Route::get('/promocode', [AdminPromocodeController::class, 'index'])->name('admin.promocode');

        Route::post('/promocode', [AdminPromocodeController::class, 'savePromocode'])->name('admin.promocode.save');

        Route::post('/promocode/update', [AdminPromocodeController::class, 'changePromocodeStatus'])->name('admin.promocode.changestatus');

    });
});



