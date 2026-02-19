<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use App\Models\GalleryImage;
use App\Models\Page;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'users' => User::count(),
                'pages' => Page::count(),
                'posts' => Post::count(),
                'testimonials' => Testimonial::count(),
                'gallery' => GalleryImage::count(),
                'enquiries' => ContactEnquiry::count(),
            ],
        ]);
    }
}
