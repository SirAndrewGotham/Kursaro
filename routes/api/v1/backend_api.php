<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'App\Http\Controllers\Api\V1\Backend', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionApiController');

    // Roles
    Route::apiResource('roles', 'RoleApiController');

    // Users
    Route::apiResource('users', 'UserApiController');

    // Language
    Route::apiResource('languages', 'LanguageApiController');

    // Page
    Route::post('pages/media', 'PageApiController@storeMedia')->name('pages.storeMedia');
    Route::apiResource('pages', 'PageApiController');

    // Home
    Route::post('homes/media', 'HomeApiController@storeMedia')->name('homes.storeMedia');
    Route::apiResource('homes', 'HomeApiController');

    // Category
    Route::post('categories/media', 'CategoryApiController@storeMedia')->name('categories.storeMedia');
    Route::apiResource('categories', 'CategoryApiController');

    // Course
    Route::post('courses/media', 'CourseApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CourseApiController');

    // Banner Spot
    Route::post('banner-spots/media', 'BannerSpotApiController@storeMedia')->name('banner-spots.storeMedia');
    Route::apiResource('banner-spots', 'BannerSpotApiController');

    // Banner Type
    Route::post('banner-types/media', 'BannerTypeApiController@storeMedia')->name('banner-types.storeMedia');
    Route::apiResource('banner-types', 'BannerTypeApiController');

    // Banner
    Route::post('banners/media', 'BannerApiController@storeMedia')->name('banners.storeMedia');
    Route::apiResource('banners', 'BannerApiController');

    // Feedback
    Route::apiResource('feedbacks', 'FeedbackApiController');

    // Prospect
    Route::post('prospects/media', 'ProspectApiController@storeMedia')->name('prospects.storeMedia');
    Route::apiResource('prospects', 'ProspectApiController');

    // Contact Type
    Route::post('contact-types/media', 'ContactTypeApiController@storeMedia')->name('contact-types.storeMedia');
    Route::apiResource('contact-types', 'ContactTypeApiController');

    // Contact
    Route::apiResource('contacts', 'ContactApiController');
});
