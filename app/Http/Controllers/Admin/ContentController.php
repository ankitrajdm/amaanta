<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use App\Models\GalleryImage;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function pages(): View
    {
        return view('admin.pages.index', ['pages' => Page::withCount('sections')->get()]);
    }

    public function editPage(Page $page): View
    {
        return view('admin.pages.edit', ['page' => $page->load('sections')]);
    }

    public function updatePage(Request $request, Page $page): RedirectResponse
    {
        $page->update($request->validate([
            'title' => ['required', 'string', 'max:120'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]));

        return back()->with('status', 'Page updated.');
    }

    public function updateSection(Request $request, PageSection $section): RedirectResponse
    {
        $data = $request->validate([
            'heading' => ['required', 'string', 'max:200'],
            'content' => ['nullable', 'string'],
            'position' => ['required', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $section->update($data);

        return back()->with('status', 'Section updated.');
    }

    public function settings(): View
    {
        return view('admin.settings.index', ['settings' => WebsiteSetting::orderBy('key')->get()]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        foreach ($request->except('_token') as $key => $value) {
            WebsiteSetting::updateOrCreate(['key' => $key], ['value' => (string) $value]);
        }

        return back()->with('status', 'Website settings saved.');
    }

    public function menus(): View
    {
        return view('admin.menus.index', ['menus' => Menu::with('items')->get()]);
    }

    public function storeMenuItem(Request $request, Menu $menu): RedirectResponse
    {
        $menu->items()->create($request->validate([
            'label' => ['required', 'string', 'max:80'],
            'url' => ['required', 'string', 'max:255'],
            'position' => ['required', 'integer', 'min:1'],
        ]));

        return back()->with('status', 'Menu item added.');
    }

    public function testimonials(): View
    {
        return view('admin.testimonials.index', ['testimonials' => Testimonial::latest()->get()]);
    }

    public function storeTestimonial(Request $request): RedirectResponse
    {
        Testimonial::create($request->validate([
            'author_name' => ['required', 'string', 'max:120'],
            'author_title' => ['nullable', 'string', 'max:120'],
            'quote' => ['required', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]));

        return back()->with('status', 'Testimonial added.');
    }

    public function posts(): View
    {
        return view('admin.posts.index', ['posts' => Post::latest()->get()]);
    }

    public function storePost(Request $request): RedirectResponse
    {
        Post::create($request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:180'],
            'category' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ]) + ['published_at' => now()]);

        return back()->with('status', 'Post created.');
    }

    public function gallery(): View
    {
        return view('admin.gallery.index', ['images' => GalleryImage::latest()->get()]);
    }

    public function storeGallery(Request $request): RedirectResponse
    {
        GalleryImage::create($request->validate([
            'title' => ['required', 'string', 'max:120'],
            'image_path' => ['required', 'string', 'max:255'],
            'event_name' => ['nullable', 'string', 'max:120'],
            'is_active' => ['nullable', 'boolean'],
        ]));

        return back()->with('status', 'Gallery image entry created.');
    }

    public function enquiries(): View
    {
        return view('admin.enquiries.index', ['enquiries' => ContactEnquiry::latest()->paginate(20)]);
    }
}
