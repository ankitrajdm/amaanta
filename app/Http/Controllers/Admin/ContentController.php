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
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            'heading' => ['required', 'string', 'max:200'],
            'content' => ['nullable', 'string'],
            'position' => ['required', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
        ]);

        $data = [
            'heading' => $validated['heading'],
            'content' => $validated['content'] ?? null,
            'position' => $validated['position'],
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ];

        // handle an uploaded image and store into meta
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('uploads', 'public');
            $url = \Illuminate\Support\Facades\Storage::url($path);
            $meta = (array) ($section->meta ?? []);
            $meta['image'] = $url;
            $data['meta'] = $meta;
        }

        // merge meta from request if provided (optional JSON input)
        if ($request->filled('meta')) {
            try {
                $incoming = json_decode($request->input('meta'), true);
                if (is_array($incoming)) {
                    $data['meta'] = array_merge((array) ($data['meta'] ?? []), $incoming);
                }
            } catch (\Throwable $e) {
                // ignore invalid JSON
            }
        }

        $section->update($data);

        return back()->with('status', 'Section updated.');
    }

    public function settings(): View
    {
        return view('admin.settings.index', ['settings' => WebsiteSetting::orderBy('key')->get()]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        // handle file uploads (logo) using Storage (public disk)
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            if ($file->isValid()) {
                $path = $file->store('uploads', 'public'); // e.g. uploads/abc.jpg
                $logoPath = Storage::url($path); // /storage/uploads/abc.jpg
                WebsiteSetting::updateOrCreate(['key' => 'logo'], ['value' => $logoPath]);
            }
        }

        foreach ($request->except('_token', 'logo') as $key => $value) {
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
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'event_name' => ['nullable', 'string', 'max:120'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'image_path' => ['nullable', 'string', 'max:255'],
        ]);

        // prefer uploaded file and use Storage
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
            $data['image_path'] = Storage::url($path);
        }

        // require image_path now
        if (empty($data['image_path'])) {
            return back()->withErrors(['image' => 'Please upload an image or provide an image path.']);
        }

        GalleryImage::create([
            'title' => $data['title'],
            'image_path' => $data['image_path'],
            'event_name' => $data['event_name'] ?? null,
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);

        return back()->with('status', 'Gallery image entry created.');
    }

    public function enquiries(): View
    {
        return view('admin.enquiries.index', ['enquiries' => ContactEnquiry::latest()->paginate(20)]);
    }
}
