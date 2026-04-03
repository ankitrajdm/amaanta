<?php

use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ContactFormController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');

// Redirect static HTML files to dynamic routes
Route::redirect('/index.html', '/');
Route::redirect('/index.static.html', '/');
Route::redirect('/about.html', '/about');
Route::redirect('/contact.html', '/contact');
Route::redirect('/services.html', '/services');
Route::redirect('/blog.html', '/blog');
Route::redirect('/gallery.html', '/memorybook');
Route::redirect('/memorybook.html', '/memorybook');

Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');

Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/services/{slug}', function ($slug) {
    return redirect()->route('memorybook.detail', ['slug' => $slug]);
})->name('services.detail');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PageController::class, 'blogDetail'])->name('blog.detail');

Route::get('/gallery', function () {
    return redirect()->route('memorybook');
})->name('gallery');
Route::get('/memorybook', [PageController::class, 'memorybook'])->name('memorybook');
Route::get('/memorybook/{slug}', [PageController::class, 'serviceDetail'])->name('memorybook.detail');

Route::get('/terms-and-conditions', [App\Http\Controllers\PageController::class, 'terms'])->name('terms');
Route::get('/terms-of-services', [App\Http\Controllers\PageController::class, 'termsOfServices'])->name('terms.of.services');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Booking routes
Route::get('/booking', [App\Http\Controllers\BookingController::class, 'create'])->name('booking');
Route::post('/booking', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Contact Forms Management (requires auth but not specific role)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::resource('contact-forms', App\Http\Controllers\Admin\ContactFormController::class);
    Route::get('contact-forms-export', [App\Http\Controllers\Admin\ContactFormController::class, 'export'])->name('contact-forms.export');

    // Bookings Management
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
    Route::get('bookings-export', [App\Http\Controllers\Admin\BookingController::class, 'export'])->name('bookings.export');
    Route::get('bookings-calendar-events', [App\Http\Controllers\Admin\BookingController::class, 'calendarEvents'])->name('bookings.calendar-events');
});

Route::middleware(['auth', 'role:admin,editor'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pages Management
    Route::get('/pages', [ContentController::class, 'pages'])->name('pages.index');
    Route::get('/pages/create', [ContentController::class, 'createPage'])->name('pages.create');
    Route::post('/pages', [ContentController::class, 'storePage'])->name('pages.store');
    Route::get('/pages/{page}', [ContentController::class, 'editPage'])->name('pages.edit');
    Route::put('/pages/{page}', [ContentController::class, 'updatePage'])->name('pages.update');
    Route::post('/pages/{page}/sections', [ContentController::class, 'storeSection'])->name('sections.store');
    Route::put('/sections/{section}', [ContentController::class, 'updateSection'])->name('sections.update');
    Route::delete('/sections/{section}', [ContentController::class, 'destroySection'])->name('sections.destroy');

    // Menus Management
    Route::get('/menus', [ContentController::class, 'menus'])->name('menus.index');
    Route::get('/menus/create', [ContentController::class, 'createMenu'])->name('menus.create');
    Route::post('/menus', [ContentController::class, 'storeMenu'])->name('menus.store');
    Route::get('/menus/{menu}', [ContentController::class, 'editMenu'])->name('menus.edit');
    Route::put('/menus/{menu}', [ContentController::class, 'updateMenu'])->name('menus.update');
    Route::delete('/menus/{menu}', [ContentController::class, 'destroyMenu'])->name('menus.destroy');
    Route::post('/menus/{menu}/items', [ContentController::class, 'storeMenuItem'])->name('menus.items.store');
    Route::delete('/menus/items/{item}', [ContentController::class, 'destroyMenuItem'])->name('menus.items.destroy');

    // Posts Management
    Route::get('/posts', [ContentController::class, 'posts'])->name('posts.index');
    Route::get('/posts/create', [ContentController::class, 'createPost'])->name('posts.create');
    Route::post('/posts', [ContentController::class, 'storePost'])->name('posts.store');
    Route::get('/posts/{post}', [ContentController::class, 'editPost'])->name('posts.edit');
    Route::put('/posts/{post}', [ContentController::class, 'updatePost'])->name('posts.update');
    Route::delete('/posts/{post}', [ContentController::class, 'destroyPost'])->name('posts.destroy');

    // Categories Management
    Route::get('/categories', [ContentController::class, 'categories'])->name('categories.index');
    Route::get('/categories/create', [ContentController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories', [ContentController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{category}', [ContentController::class, 'editCategory'])->name('categories.edit');
    Route::put('/categories/{category}', [ContentController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [ContentController::class, 'destroyCategory'])->name('categories.destroy');

    // Tags Management
    Route::get('/tags', [ContentController::class, 'tags'])->name('tags.index');
    Route::get('/tags/create', [ContentController::class, 'createTag'])->name('tags.create');
    Route::post('/tags', [ContentController::class, 'storeTag'])->name('tags.store');
    Route::get('/tags/{tag}', [ContentController::class, 'editTag'])->name('tags.edit');
    Route::put('/tags/{tag}', [ContentController::class, 'updateTag'])->name('tags.update');
    Route::delete('/tags/{tag}', [ContentController::class, 'destroyTag'])->name('tags.destroy');

    // Services Management
    Route::get('/services', [ContentController::class, 'services'])->name('services.index');
    Route::get('/services/create', [ContentController::class, 'createService'])->name('services.create');
    Route::post('/services', [ContentController::class, 'storeService'])->name('services.store');
    Route::get('/services/{service}', [ContentController::class, 'editService'])->name('services.edit');
    Route::put('/services/{service}', [ContentController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{service}', [ContentController::class, 'destroyService'])->name('services.destroy');

    // Events Management
    Route::get('/events', [ContentController::class, 'events'])->name('events.index');
    Route::get('/events/create', [ContentController::class, 'createEvent'])->name('events.create');
    Route::post('/events', [ContentController::class, 'storeEvent'])->name('events.store');
    Route::get('/events/{event}', [ContentController::class, 'editEvent'])->name('events.edit');
    Route::put('/events/{event}', [ContentController::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{event}', [ContentController::class, 'destroyEvent'])->name('events.destroy');

    // FAQs Management
    Route::get('/faqs', [ContentController::class, 'faqs'])->name('faqs.index');
    Route::get('/faqs/create', [ContentController::class, 'createFAQ'])->name('faqs.create');
    Route::post('/faqs', [ContentController::class, 'storeFAQ'])->name('faqs.store');
    Route::get('/faqs/{faq}', [ContentController::class, 'editFAQ'])->name('faqs.edit');
    Route::put('/faqs/{faq}', [ContentController::class, 'updateFAQ'])->name('faqs.update');
    Route::delete('/faqs/{faq}', [ContentController::class, 'destroyFAQ'])->name('faqs.destroy');

    // Gallery Management
    Route::get('/gallery', [ContentController::class, 'gallery'])->name('gallery.index');
    Route::get('/gallery/create', [ContentController::class, 'createGallery'])->name('gallery.create');
    Route::post('/gallery', [ContentController::class, 'storeGallery'])->name('gallery.store');
    Route::get('/gallery/{image}', [ContentController::class, 'editGallery'])->name('gallery.edit');
    Route::put('/gallery/{image}', [ContentController::class, 'updateGallery'])->name('gallery.update');
    Route::delete('/gallery/{image}', [ContentController::class, 'destroyGallery'])->name('gallery.destroy');

    // Service Sliders Management
    Route::get('/sliders', [ContentController::class, 'sliders'])->name('sliders.index');
    Route::get('/sliders/create', [ContentController::class, 'createSlider'])->name('sliders.create');
    Route::post('/sliders', [ContentController::class, 'storeSlider'])->name('sliders.store');
    Route::get('/sliders/{slider}', [ContentController::class, 'editSlider'])->name('sliders.edit');
    Route::put('/sliders/{slider}', [ContentController::class, 'updateSlider'])->name('sliders.update');
    Route::delete('/sliders/{slider}', [ContentController::class, 'destroySlider'])->name('sliders.destroy');

    // Testimonials Management
    Route::get('/testimonials', [ContentController::class, 'testimonials'])->name('testimonials.index');
    Route::get('/testimonials/create', [ContentController::class, 'createTestimonial'])->name('testimonials.create');
    Route::post('/testimonials', [ContentController::class, 'storeTestimonial'])->name('testimonials.store');
    Route::get('/testimonials/{testimonial}', [ContentController::class, 'editTestimonial'])->name('testimonials.edit');
    Route::put('/testimonials/{testimonial}', [ContentController::class, 'updateTestimonial'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [ContentController::class, 'destroyTestimonial'])->name('testimonials.destroy');

    // Contact Enquiries
    Route::get('/enquiries', [ContentController::class, 'enquiries'])->name('enquiries.index');

    // Users Management (admin only)
    Route::middleware('role:admin')->group(function (): void {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Settings Management
        Route::get('/settings', [ContentController::class, 'settings'])->name('settings.index');
        Route::post('/settings', [ContentController::class, 'updateSettings'])->name('settings.update');
    });
});
