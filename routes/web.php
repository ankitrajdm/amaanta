<?php

use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact/enquiry', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:admin,editor'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pages', [ContentController::class, 'pages'])->name('pages.index');
    Route::get('/pages/{page}', [ContentController::class, 'editPage'])->name('pages.edit');
    Route::put('/pages/{page}', [ContentController::class, 'updatePage'])->name('pages.update');
    Route::put('/sections/{section}', [ContentController::class, 'updateSection'])->name('sections.update');

    Route::get('/menus', [ContentController::class, 'menus'])->name('menus.index');
    Route::post('/menus/{menu}/items', [ContentController::class, 'storeMenuItem'])->name('menus.items.store');

    Route::get('/posts', [ContentController::class, 'posts'])->name('posts.index');
    Route::post('/posts', [ContentController::class, 'storePost'])->name('posts.store');

    Route::get('/gallery', [ContentController::class, 'gallery'])->name('gallery.index');
    Route::post('/gallery', [ContentController::class, 'storeGallery'])->name('gallery.store');

    Route::get('/testimonials', [ContentController::class, 'testimonials'])->name('testimonials.index');
    Route::post('/testimonials', [ContentController::class, 'storeTestimonial'])->name('testimonials.store');

    Route::get('/enquiries', [ContentController::class, 'enquiries'])->name('enquiries.index');

    Route::middleware('role:admin')->group(function (): void {
        Route::get('/settings', [ContentController::class, 'settings'])->name('settings.index');
        Route::post('/settings', [ContentController::class, 'updateSettings'])->name('settings.update');
    });
});
