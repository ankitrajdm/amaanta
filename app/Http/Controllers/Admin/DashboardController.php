<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ContactEnquiry;
use App\Models\GalleryImage;
use App\Models\Page;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $bookings = Booking::select('id', 'customer_name', 'event_date', 'status', 'phone', 'total_cost')->get();
        
        return view('admin.dashboard', [
            'settings' => [
                'website_name' => WebsiteSetting::getValue('website_name', 'Amaanta'),
            ],
            'stats' => [
                'users' => User::count(),
                'pages' => Page::count(),
                'posts' => Post::count(),
                'testimonials' => Testimonial::count(),
                'gallery' => GalleryImage::count(),
                'enquiries' => ContactEnquiry::count(),
                'bookings' => Booking::count(),
            ],
            'pages' => Page::with('sections')->get()->take(5),
            'posts' => Post::latest()->take(5)->get(),
            'gallery' => GalleryImage::latest()->take(6)->get(),
            'testimonials' => Testimonial::latest()->take(3)->get(),
            'bookings' => $bookings,
        ]);
    }
}
