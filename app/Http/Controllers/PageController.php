<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\FAQ;
use App\Models\GalleryImage;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\Tag;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $page = Page::with(['sections' => fn ($query) => $query->where('is_active', true)])->where('slug', 'home')->first();

        return view('pages.home', [
            'page' => $page,
            'settings' => $this->settings(),
            'testimonials' => Testimonial::where('is_active', true)->latest()->limit(6)->get(),
            // only published posts should be shown; the model uses a boolean flag rather than a status column
            'posts' => Post::where('is_published', true)->latest('created_at')->limit(3)->get(),
            'services' => Service::where('is_active', true)->limit(6)->get(),
            'events' => Event::where('is_active', true)->latest('event_date')->limit(4)->get(),
            'gallery' => GalleryImage::where('is_active', true)->latest()->get(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'page' => Page::with('sections')->where('slug', 'about')->first(),
            'settings' => $this->settings(),
            'services' => Service::where('is_active', true)->get(),
            'faqs' => FAQ::where('is_active', true)->get(),
            'testimonials' => Testimonial::where('is_active', true)->latest()->limit(6)->get(),
        ]);
    }

    public function services(): View
    {
        return view('pages.services', [
            'page' => Page::with('sections')->where('slug', 'services')->first(),
            'services' => Service::where('is_active', true)->paginate(12),
            'settings' => $this->settings(),
        ]);
    }

    public function serviceDetail(string $slug): View
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        // Get all gallery images for this service (regardless of event)
        $galleryImages = GalleryImage::where('service_id', $service->id)
            ->where('is_active', true)
            ->latest()
            ->get();

        // Get events for this service with their gallery images
        $events = Event::where('service_id', $service->id)->where('is_active', true)->with(['galleryImages' => function($query) {
            $query->where('is_active', true);
        }])->get();

        return view('pages.service-detail', [
            'service' => $service,
            'events' => $events,
            'galleryImages' => $galleryImages,
            'otherServices' => Service::where('is_active', true)->where('id', '!=', $service->id)->limit(3)->get(),
            'testimonials' => Testimonial::where('is_active', true)->latest()->limit(6)->get(),
            'settings' => $this->settings(),
        ]);
    }

    public function blog(): View
    {
        // allow an editable page for the blog so the hero/title text can be managed via CMS
        $page = Page::with(['sections' => fn ($query) => $query->where('is_active', true)])->where('slug', 'blog')->first();

        $query = Post::where('is_published', true);
        
        if (request('category')) {
            $category = Category::where('slug', request('category'))->firstOrFail();
            $query = $query->whereHas('categories', fn ($q) => $q->where('categories.id', $category->id));
        }
        
        if (request('tag')) {
            $tag = Tag::where('slug', request('tag'))->firstOrFail();
            $query = $query->whereHas('tags', fn ($q) => $q->where('tags.id', $tag->id));
        }
        
        if (request('search')) {
            $search = request('search');
            $query = $query->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
        }

        return view('pages.blog', [
            'page' => $page,
            'posts' => $query->latest('created_at')->paginate(10),
            'categories' => Category::where('is_active', true)->get(),
            'popularTags' => Tag::where('is_active', true)->limit(10)->get(),
            'settings' => $this->settings(),
        ]);
    }

    public function blogDetail(string $slug): View
    {
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
        
        return view('pages.blog-detail', [
            'post' => $post,
            'relatedPosts' => Post::where('is_published', true)
                                ->where('id', '!=', $post->id)
                                ->whereHas('categories', fn ($q) => $q->whereIn('categories.id', $post->categories->pluck('id')))
                                ->limit(4)
                                ->get(),
            'settings' => $this->settings(),
        ]);
    }

    public function gallery(): View
    {
        return view('pages.gallery', [
            'page' => Page::with('sections')->where('slug', 'gallery')->first(),
            'events' => Event::where('is_active', true)
                            ->with('galleryImages')
                            ->latest('event_date')
                            ->get(),
            'allImages' => GalleryImage::latest()->get(),
            'settings' => $this->settings(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'page' => Page::with('sections')->where('slug', 'contact')->first(),
            'settings' => $this->settings(),
            'headerMenu' => Menu::where('location', 'header')->with('items')->first(),
            'faqs' => FAQ::where('is_active', true)->get(),
        ]);
    }

    private function settings(): array
    {
        return [
            'website_name' => WebsiteSetting::getValue('website_name', 'Amaanta'),
            'logo' => WebsiteSetting::getValue('logo', 'assets/img/logonew.png'),
            'whatsapp_link' => WebsiteSetting::getValue('whatsapp_link', '#'),
            'copyright_text' => WebsiteSetting::getValue('copyright_text', '© Amaanta'),
            'contact_no' => WebsiteSetting::getValue('contact_no', 'N/A'),
            'contact_email' => WebsiteSetting::getValue('contact_email', 'N/A'),
            'address' => WebsiteSetting::getValue('address', 'N/A'),
        ];
    }
}
