<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
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
            'posts' => Post::where('is_published', true)->latest('published_at')->limit(3)->get(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'page' => Page::with('sections')->where('slug', 'about')->first(),
            'settings' => $this->settings(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'page' => Page::with('sections')->where('slug', 'contact')->first(),
            'settings' => $this->settings(),
            'headerMenu' => Menu::where('location', 'header')->with('items')->first(),
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
