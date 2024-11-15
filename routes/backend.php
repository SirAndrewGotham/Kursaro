<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::post('permissions/parse-csv-import', 'PermissionsController@parseCsvImport')->name('permissions.parseCsvImport');
    Route::post('permissions/process-csv-import', 'PermissionsController@processCsvImport')->name('permissions.processCsvImport');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', 'RolesController@parseCsvImport')->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', 'RolesController@processCsvImport')->name('roles.processCsvImport');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Language
    Route::delete('languages/destroy', 'LanguageController@massDestroy')->name('languages.massDestroy');
    Route::post('languages/parse-csv-import', 'LanguageController@parseCsvImport')->name('languages.parseCsvImport');
    Route::post('languages/process-csv-import', 'LanguageController@processCsvImport')->name('languages.processCsvImport');
    Route::resource('languages', 'LanguageController');

    // Page
    Route::delete('pages/destroy', 'PageController@massDestroy')->name('pages.massDestroy');
    Route::post('pages/media', 'PageController@storeMedia')->name('pages.storeMedia');
    Route::post('pages/ckmedia', 'PageController@storeCKEditorImages')->name('pages.storeCKEditorImages');
    Route::post('pages/parse-csv-import', 'PageController@parseCsvImport')->name('pages.parseCsvImport');
    Route::post('pages/process-csv-import', 'PageController@processCsvImport')->name('pages.processCsvImport');
    Route::resource('pages', 'PageController');

    // Home
    Route::delete('homes/destroy', 'HomeController@massDestroy')->name('homes.massDestroy');
    Route::post('homes/media', 'HomeController@storeMedia')->name('homes.storeMedia');
    Route::post('homes/ckmedia', 'HomeController@storeCKEditorImages')->name('homes.storeCKEditorImages');
    Route::post('homes/parse-csv-import', 'HomeController@parseCsvImport')->name('homes.parseCsvImport');
    Route::post('homes/process-csv-import', 'HomeController@processCsvImport')->name('homes.processCsvImport');
    Route::resource('homes', 'HomeController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
    Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
    Route::post('categories/parse-csv-import', 'CategoryController@parseCsvImport')->name('categories.parseCsvImport');
    Route::post('categories/process-csv-import', 'CategoryController@processCsvImport')->name('categories.processCsvImport');
    Route::resource('categories', 'CategoryController');

    // Course
    Route::delete('courses/destroy', 'CourseController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CourseController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CourseController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::post('courses/parse-csv-import', 'CourseController@parseCsvImport')->name('courses.parseCsvImport');
    Route::post('courses/process-csv-import', 'CourseController@processCsvImport')->name('courses.processCsvImport');
    Route::resource('courses', 'CourseController');

    // Banner Spot
    Route::delete('banner-spots/destroy', 'BannerSpotController@massDestroy')->name('banner-spots.massDestroy');
    Route::post('banner-spots/media', 'BannerSpotController@storeMedia')->name('banner-spots.storeMedia');
    Route::post('banner-spots/ckmedia', 'BannerSpotController@storeCKEditorImages')->name('banner-spots.storeCKEditorImages');
    Route::post('banner-spots/parse-csv-import', 'BannerSpotController@parseCsvImport')->name('banner-spots.parseCsvImport');
    Route::post('banner-spots/process-csv-import', 'BannerSpotController@processCsvImport')->name('banner-spots.processCsvImport');
    Route::resource('banner-spots', 'BannerSpotController');

    // Banner Type
    Route::delete('banner-types/destroy', 'BannerTypeController@massDestroy')->name('banner-types.massDestroy');
    Route::post('banner-types/media', 'BannerTypeController@storeMedia')->name('banner-types.storeMedia');
    Route::post('banner-types/ckmedia', 'BannerTypeController@storeCKEditorImages')->name('banner-types.storeCKEditorImages');
    Route::post('banner-types/parse-csv-import', 'BannerTypeController@parseCsvImport')->name('banner-types.parseCsvImport');
    Route::post('banner-types/process-csv-import', 'BannerTypeController@processCsvImport')->name('banner-types.processCsvImport');
    Route::resource('banner-types', 'BannerTypeController');

    // Banner
    Route::delete('banners/destroy', 'BannerController@massDestroy')->name('banners.massDestroy');
    Route::post('banners/media', 'BannerController@storeMedia')->name('banners.storeMedia');
    Route::post('banners/ckmedia', 'BannerController@storeCKEditorImages')->name('banners.storeCKEditorImages');
    Route::post('banners/parse-csv-import', 'BannerController@parseCsvImport')->name('banners.parseCsvImport');
    Route::post('banners/process-csv-import', 'BannerController@processCsvImport')->name('banners.processCsvImport');
    Route::resource('banners', 'BannerController');

    // Feedback
    Route::delete('feedbacks/destroy', 'FeedbackController@massDestroy')->name('feedbacks.massDestroy');
    Route::post('feedbacks/parse-csv-import', 'FeedbackController@parseCsvImport')->name('feedbacks.parseCsvImport');
    Route::post('feedbacks/process-csv-import', 'FeedbackController@processCsvImport')->name('feedbacks.processCsvImport');
    Route::resource('feedbacks', 'FeedbackController');

    // Prospect
    Route::delete('prospects/destroy', 'ProspectController@massDestroy')->name('prospects.massDestroy');
    Route::post('prospects/media', 'ProspectController@storeMedia')->name('prospects.storeMedia');
    Route::post('prospects/ckmedia', 'ProspectController@storeCKEditorImages')->name('prospects.storeCKEditorImages');
    Route::post('prospects/parse-csv-import', 'ProspectController@parseCsvImport')->name('prospects.parseCsvImport');
    Route::post('prospects/process-csv-import', 'ProspectController@processCsvImport')->name('prospects.processCsvImport');
    Route::resource('prospects', 'ProspectController');

    // Contact Type
    Route::delete('contact-types/destroy', 'ContactTypeController@massDestroy')->name('contact-types.massDestroy');
    Route::post('contact-types/media', 'ContactTypeController@storeMedia')->name('contact-types.storeMedia');
    Route::post('contact-types/ckmedia', 'ContactTypeController@storeCKEditorImages')->name('contact-types.storeCKEditorImages');
    Route::post('contact-types/parse-csv-import', 'ContactTypeController@parseCsvImport')->name('contact-types.parseCsvImport');
    Route::post('contact-types/process-csv-import', 'ContactTypeController@processCsvImport')->name('contact-types.processCsvImport');
    Route::resource('contact-types', 'ContactTypeController');

    // Contact
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::post('contacts/parse-csv-import', 'ContactController@parseCsvImport')->name('contacts.parseCsvImport');
    Route::post('contacts/process-csv-import', 'ContactController@processCsvImport')->name('contacts.processCsvImport');
    Route::resource('contacts', 'ContactController');

    // Course Feature
    Route::delete('course-features/destroy', 'CourseFeatureController@massDestroy')->name('course-features.massDestroy');
    Route::post('course-features/parse-csv-import', 'CourseFeatureController@parseCsvImport')->name('course-features.parseCsvImport');
    Route::post('course-features/process-csv-import', 'CourseFeatureController@processCsvImport')->name('course-features.processCsvImport');
    Route::resource('course-features', 'CourseFeatureController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
