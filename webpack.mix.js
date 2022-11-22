const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.sass('public/assets/css/style.scss', 'public/assets/css').options({
    processCssUrls: false
})
mix.sass('public/assets/admin/css/style.scss', 'public/assets/admin/css').options({
        processCssUrls: false
    })
    .setResourceRoot('../')

.js('resources/js/snaps.js', 'public/js').vue()
    .js('resources/js/package-settings.js', 'public/js').vue()
    .js('resources/js/profile-settings.js', 'public/js').vue()
    .js('resources/js/account-settings.js', 'public/js').vue()
    .js('resources/js/profile.js', 'public/js').vue()
    .js('resources/js/user-profile.js', 'public/js').vue()
    .js('resources/js/home.js', 'public/js').vue()
    .js('resources/js/categories.js', 'public/js').vue()
    .js('resources/js/search.js', 'public/js').vue()
    .js('resources/js/follow.js', 'public/js').vue()
    .js('resources/js/cart.js', 'public/js').vue()
    .js('resources/js/calendar.js', 'public/js').vue()
    .js('resources/js/purchases.js', 'public/js').vue()
    .js('resources/js/sales.js', 'public/js').vue()
    .js('resources/js/cart-checkout.js', 'public/js').vue()
    .js('resources/js/checkout.js', 'public/js').vue()
    .js('resources/js/payment.js', 'public/js').vue()
    .js('resources/js/snaps-detail.js', 'public/js').vue()
    .js('resources/js/cms.js', 'public/js').vue()
    .js('resources/js/admin/login.js', 'public/js/admin').vue()
    .js('resources/js/admin/forgot-password.js', 'public/js/admin').vue()
    .js('resources/js/admin/reset-password.js', 'public/js/admin').vue()
    .js('resources/js/admin/dashboard.js', 'public/js/admin').vue()
    .js('resources/js/admin/analytics.js', 'public/js/admin').vue()
    .js('resources/js/admin/line-chart.js', 'public/js/admin').vue()
    .js('resources/js/admin/map-chart.js', 'public/js/admin').vue()
    .js('resources/js/admin/stacked-column-chart.js', 'public/js/admin').vue()
    .js('resources/js/admin/users.js', 'public/js/admin').vue()
    .js('resources/js/admin/user-detail.js', 'public/js/admin').vue()
    .js('resources/js/admin/snapshots.js', 'public/js/admin').vue()
    .js('resources/js/admin/snapshot-detail.js', 'public/js/admin').vue()
    .js('resources/js/admin/snapshot-approval.js', 'public/js/admin').vue()
    .js('resources/js/admin/categories.js', 'public/js/admin').vue()
    .js('resources/js/admin/reviews.js', 'public/js/admin').vue()
    .js('resources/js/admin/category-detail.js', 'public/js/admin').vue()
    .js('resources/js/admin/settings.js', 'public/js/admin').vue();
