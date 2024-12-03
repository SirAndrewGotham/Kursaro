<?php

use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BannerSpotController;
use App\Http\Controllers\Backend\BannerTypeController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ContactTypeController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\CourseFeatureController;
use App\Http\Controllers\Backend\FeedbackController;
use App\Http\Controllers\Backend\GlobalSearchController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProspectController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/home', function () {
//    if (session('status'])) {
//        return redirect()->route('admin.home'])->with('status', session('status']));
//    }
//
//    return redirect()->route('admin.home']);
//});

//Route::group(['prefix' => 'admin', [as' => 'admin.', [namespace' => 'App\Http\Controllers\Backend', [middleware' => ['auth', [2fa']], function () {
//Route::group(['prefix' => 'admin', [as' => 'admin.', [middleware' => ['auth']], function () {
Route::group(['middleware' => ['auth', 'web']], function () {
    Route::get('/', function () {
        return view('backend.default.home');
    })->middleware(['auth', 'verified'])->name('home');
//    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::post('permissions/parse-csv-import', [PermissionController::class, 'parseCsvImport'])->name('permissions.parseCsvImport');
    Route::post('permissions/process-csv-import', [PermissionController::class, 'processCsvImport'])->name('permissions.processCsvImport');
    Route::resource('permissions', PermissionController::class);

    // Roles
    Route::delete('roles/destroy', [RoleController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', [RoleController::class, 'parseCsvImport'])->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', [RoleController::class, 'processCsvImport'])->name('roles.processCsvImport');
    Route::resource('roles', RoleController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::post('users/parse-csv-import', [UsersController::class, 'parseCsvImport'])->name('users.parseCsvImport');
    Route::post('users/process-csv-import', [UsersController::class, 'processCsvImport'])->name('users.processCsvImport');
    Route::resource('users', UsersController::class);

    // Language
    Route::delete('languages/destroy', [LanguageController::class, 'massDestroy'])->name('languages.massDestroy');
    Route::post('languages/parse-csv-import', [LanguageController::class, 'parseCsvImport'])->name('languages.parseCsvImport');
    Route::post('languages/process-csv-import', [LanguageController::class, 'processCsvImport'])->name('languages.processCsvImport');
    Route::resource('languages', LanguageController::class);

    // Page
    Route::delete('pages/destroy', [PageController::class, 'massDestroy'])->name('pages.massDestroy');
    Route::post('pages/media', [PageController::class, 'storeMedia'])->name('pages.storeMedia');
    Route::post('pages/ckmedia', [PageController::class, 'storeCKEditorImages'])->name('pages.storeCKEditorImages');
    Route::post('pages/parse-csv-import', [PageController::class, 'parseCsvImport'])->name('pages.parseCsvImport');
    Route::post('pages/process-csv-import', [PageController::class, 'processCsvImport'])->name('pages.processCsvImport');
    Route::get('pages/{page}/translate', [PageController::class, 'translate'])->name('pages.translate');
    Route::post('pages/{page}/translate', [PageController::class, 'storeTranslation'])->name('pages.translate');
    Route::resource('pages', PageController::class);

    // Home
    Route::delete('homes/destroy', [HomeController::class, 'massDestroy'])->name('homes.massDestroy');
    Route::post('homes/media', [HomeController::class, 'storeMedia'])->name('homes.storeMedia');
    Route::post('homes/ckmedia', [HomeController::class, 'storeCKEditorImages'])->name('homes.storeCKEditorImages');
    Route::post('homes/parse-csv-import', [HomeController::class, 'parseCsvImport'])->name('homes.parseCsvImport');
    Route::post('homes/process-csv-import', [HomeController::class, 'processCsvImport'])->name('homes.processCsvImport');
    Route::get('homes/{home}/translate', [HomeController::class, 'translate'])->name('homes.translate');
//    Route::post('homes/translate', [HomeController::class, 'store_translation'])->name('homes.translate');
    Route::resource('homes', HomeController::class);

    // Category
    Route::delete('categories/destroy', [CategoryController::class, 'massDestroy'])->name('categories.massDestroy');
    Route::post('categories/media', [CategoryController::class, 'storeMedia'])->name('categories.storeMedia');
    Route::post('categories/ckmedia', [CategoryController::class, 'storeCKEditorImages'])->name('categories.storeCKEditorImages');
    Route::post('categories/parse-csv-import', [CategoryController::class, 'parseCsvImport'])->name('categories.parseCsvImport');
    Route::post('categories/process-csv-import', [CategoryController::class, 'processCsvImport'])->name('categories.processCsvImport');
    Route::resource('categories', CategoryController::class);

    // Course
    Route::delete('courses/destroy', [CourseController::class, 'massDestroy'])->name('courses.massDestroy');
    Route::post('courses/media', [CourseController::class, 'storeMedia'])->name('courses.storeMedia');
    Route::post('courses/ckmedia', [CourseController::class, 'storeCKEditorImages'])->name('courses.storeCKEditorImages');
    Route::post('courses/parse-csv-import', [CourseController::class, 'parseCsvImport'])->name('courses.parseCsvImport');
    Route::post('courses/process-csv-import', [CourseController::class, 'processCsvImport'])->name('courses.processCsvImport');
    Route::resource('courses', CourseController::class);

    // Banner Spot
    Route::delete('banner-spots/destroy', [BannerSpotController::class, 'massDestroy'])->name('banner-spots.massDestroy');
    Route::post('banner-spots/media', [BannerSpotController::class, 'storeMedia'])->name('banner-spots.storeMedia');
    Route::post('banner-spots/ckmedia', [BannerSpotController::class, 'storeCKEditorImages'])->name('banner-spots.storeCKEditorImages');
    Route::post('banner-spots/parse-csv-import', [BannerSpotController::class, 'parseCsvImport'])->name('banner-spots.parseCsvImport');
    Route::post('banner-spots/process-csv-import', [BannerSpotController::class, 'processCsvImport'])->name('banner-spots.processCsvImport');
    Route::resource('banner-spots', BannerSpotController::class);

    // Banner Type
    Route::delete('banner-types/destroy', [BannerTypeController::class, 'massDestroy'])->name('banner-types.massDestroy');
    Route::post('banner-types/media', [BannerTypeController::class, 'storeMedia'])->name('banner-types.storeMedia');
    Route::post('banner-types/ckmedia', [BannerTypeController::class, 'storeCKEditorImages'])->name('banner-types.storeCKEditorImages');
    Route::post('banner-types/parse-csv-import', [BannerTypeController::class, 'parseCsvImport'])->name('banner-types.parseCsvImport');
    Route::post('banner-types/process-csv-import', [BannerTypeController::class, 'processCsvImport'])->name('banner-types.processCsvImport');
    Route::resource('banner-types', BannerTypeController::class);

    // Banner
    Route::delete('banners/destroy', [BannerController::class, 'massDestroy'])->name('banners.massDestroy');
    Route::post('banners/media', [BannerController::class, 'storeMedia'])->name('banners.storeMedia');
    Route::post('banners/ckmedia', [BannerController::class, 'storeCKEditorImages'])->name('banners.storeCKEditorImages');
    Route::post('banners/parse-csv-import', [BannerController::class, 'parseCsvImport'])->name('banners.parseCsvImport');
    Route::post('banners/process-csv-import', [BannerController::class, 'processCsvImport'])->name('banners.processCsvImport');
    Route::resource('banners', BannerController::class);

    // Feedback
    Route::delete('feedbacks/destroy', [FeedbackController::class, 'massDestroy'])->name('feedbacks.massDestroy');
    Route::post('feedbacks/parse-csv-import', [FeedbackController::class, 'parseCsvImport'])->name('feedbacks.parseCsvImport');
    Route::post('feedbacks/process-csv-import', [FeedbackController::class, 'processCsvImport'])->name('feedbacks.processCsvImport');
    Route::resource('feedbacks', FeedbackController::class);

    // Prospect
    Route::delete('prospects/destroy', [ProspectController::class, 'massDestroy'])->name('prospects.massDestroy');
    Route::post('prospects/media', [ProspectController::class, 'storeMedia'])->name('prospects.storeMedia');
    Route::post('prospects/ckmedia', [ProspectController::class, 'storeCKEditorImages'])->name('prospects.storeCKEditorImages');
    Route::post('prospects/parse-csv-import', [ProspectController::class, 'parseCsvImport'])->name('prospects.parseCsvImport');
    Route::post('prospects/process-csv-import', [ProspectController::class, 'processCsvImport'])->name('prospects.processCsvImport');
    Route::resource('prospects', ProspectController::class);

    // Contact Type
    Route::delete('contact-types/destroy', [ContactTypeController::class, 'massDestroy'])->name('contact-types.massDestroy');
    Route::post('contact-types/media', [ContactTypeController::class, 'storeMedia'])->name('contact-types.storeMedia');
    Route::post('contact-types/ckmedia', [ContactTypeController::class, 'storeCKEditorImages'])->name('contact-types.storeCKEditorImages');
    Route::post('contact-types/parse-csv-import', [ContactTypeController::class, 'parseCsvImport'])->name('contact-types.parseCsvImport');
    Route::post('contact-types/process-csv-import', [ContactTypeController::class, 'processCsvImport'])->name('contact-types.processCsvImport');
    Route::resource('contact-types', ContactTypeController::class);

    // Contact
    Route::delete('contacts/destroy', [ContactController::class, 'massDestroy'])->name('contacts.massDestroy');
    Route::post('contacts/parse-csv-import', [ContactController::class, 'parseCsvImport'])->name('contacts.parseCsvImport');
    Route::post('contacts/process-csv-import', [ContactController::class, 'processCsvImport'])->name('contacts.processCsvImport');
    Route::resource('contacts', ContactController::class);

    // Course Feature
    Route::delete('course-features/destroy', [CourseFeatureController::class, 'massDestroy'])->name('course-features.massDestroy');
    Route::post('course-features/parse-csv-import', [CourseFeatureController::class, 'parseCsvImport'])->name('course-features.parseCsvImport');
    Route::post('course-features/process-csv-import', [CourseFeatureController::class, 'processCsvImport'])->name('course-features.processCsvImport');
    Route::resource('course-features', CourseFeatureController::class);

    Route::get('global-search', [GlobalSearchController::class, 'search'])->name('globalSearch');
});
