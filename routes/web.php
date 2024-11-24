<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/language/{locale}', LanguageController::class)->name('locale');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/backend.php';

Auth::routes();

Route::get('/', HomeController::class)->name('home');

Route::get('/docs/{slug}', PageController::class)->name('page.show');
