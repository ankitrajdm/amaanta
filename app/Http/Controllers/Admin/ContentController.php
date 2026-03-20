<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactEnquiry;
use App\Models\GalleryImage;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Post;
use App\Models\Tag;
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
        return view('admin.pages.index', ['pages' => Page::where('slug', '!=', 'gallery')->withCount('sections')->get()]);
    }

    public function editPage(Page $page): View
    {
        return view('admin.pages.edit', ['page' => $page->load('sections')]);
    }

    public function updatePage(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'slug' => ['required', 'string', 'max:120', 'regex:/^[a-z0-9\-]+$/', 'not_in:gallery'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Enforce desired mapping at save time
        if ($validated['slug'] === 'services') {
            $validated['title'] = 'Memorybook';
        } elseif ($validated['slug'] === 'memorybook') {
            $validated['title'] = 'Services';
        }

        $page->update($validated);

        return back()->with('status', 'Page updated.');
    }

    public function storeSection(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'section_key' => ['required', 'string', 'max:100'],
            'heading' => ['required', 'string', 'max:200'],
            'content' => ['nullable', 'string'],
            'position' => ['required', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'meta' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_button_text' => ['nullable', 'string', 'max:100'],
            'meta_button_url' => ['nullable', 'string', 'max:255'],
            'meta_subheading' => ['nullable', 'string', 'max:100'],
            'meta_subtitle' => ['nullable', 'string', 'max:100'],
            'meta_highlight' => ['nullable', 'string', 'max:100'],
            'meta_bullet1' => ['nullable', 'string'],
            'meta_bullet2' => ['nullable', 'string'],
            'meta_service1_title' => ['nullable', 'string', 'max:100'],
            'meta_service1_content' => ['nullable', 'string'],
            'meta_service1_image' => ['nullable', 'string', 'max:255'],
            'meta_service2_title' => ['nullable', 'string', 'max:100'],
            'meta_service2_content' => ['nullable', 'string'],
            'meta_service2_image' => ['nullable', 'string', 'max:255'],
            'meta_image' => ['nullable', 'string', 'max:255'],
            'meta_faqs' => ['nullable', 'string'],
        ]);

        // allow HTML tags in heading/content and ensure entities are decoded
        $data = [
            'page_id' => $page->id,
            'section_key' => $validated['section_key'],
            'heading' => isset($validated['heading']) ? html_entity_decode($validated['heading'], ENT_QUOTES | ENT_HTML5) : null,
            'content' => isset($validated['content']) ? html_entity_decode($validated['content'], ENT_QUOTES | ENT_HTML5) : null,
            'position' => $validated['position'],
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('uploads', 'public');
            $url = \Illuminate\Support\Facades\Storage::url($path);
            $data['meta'] = ['image' => $url];
        }

        $metaData = (array) ($data['meta'] ?? []);
        if ($request->filled('meta')) {
            try {
                $incoming = json_decode($request->input('meta'), true);
                if (is_array($incoming)) {
                    $metaData = array_merge($metaData, $incoming);
                }
            } catch (\Throwable $e) {
            }
        }
        if ($request->filled('meta_description')) {
            $metaData['description'] = $request->input('meta_description');
        }
        if ($request->filled('meta_button_text')) {
            $metaData['button_text'] = $request->input('meta_button_text');
        }
        if ($request->filled('meta_button_url')) {
            $metaData['button_url'] = $request->input('meta_button_url');
        }
        if ($request->filled('meta_subheading')) {
            $metaData['subheading'] = $request->input('meta_subheading');
        }
        if ($request->filled('meta_subtitle')) {
            $metaData['subtitle'] = $request->input('meta_subtitle');
        }
        if ($request->filled('meta_highlight')) {
            $metaData['highlight'] = $request->input('meta_highlight');
        }
        if ($request->filled('meta_bullet1')) {
            $metaData['bullet1'] = $request->input('meta_bullet1');
        }
        if ($request->filled('meta_bullet2')) {
            $metaData['bullet2'] = $request->input('meta_bullet2');
        }
        if ($request->filled('meta_image')) {
            $metaData['image'] = $request->input('meta_image');
        }
        if ($request->filled('meta_service1_title')) {
            $metaData['service1_title'] = $request->input('meta_service1_title');
        }
        if ($request->filled('meta_service1_content')) {
            $metaData['service1_content'] = $request->input('meta_service1_content');
        }
        if ($request->filled('meta_service1_image')) {
            $metaData['service1_image'] = $request->input('meta_service1_image');
        }
        if ($request->filled('meta_service2_title')) {
            $metaData['service2_title'] = $request->input('meta_service2_title');
        }
        if ($request->filled('meta_service2_content')) {
            $metaData['service2_content'] = $request->input('meta_service2_content');
        }
        if ($request->filled('meta_service2_image')) {
            $metaData['service2_image'] = $request->input('meta_service2_image');
        }
        if ($request->filled('meta_faqs')) {
            try {
                $faqs = json_decode($request->input('meta_faqs'), true);
                if (is_array($faqs)) {
                    $metaData['faqs'] = $faqs;
                }
            } catch (\Throwable $e) {
            }
        }
        if (!empty($metaData)) {
            $data['meta'] = $metaData;
        }

        PageSection::create($data);

        return back()->with('status', 'Section added.');
    }

    public function updateSection(Request $request, PageSection $section): RedirectResponse
    {
        $validated = $request->validate([
            'heading' => ['required', 'string', 'max:200'],
            'content' => ['nullable', 'string'],
            'position' => ['required', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'section_key' => ['nullable', 'string', 'max:100'],
            'meta' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_button_text' => ['nullable', 'string', 'max:100'],
            'meta_button_url' => ['nullable', 'string', 'max:255'],
            'meta_subheading' => ['nullable', 'string', 'max:100'],
            'meta_subtitle' => ['nullable', 'string', 'max:100'],
            'meta_highlight' => ['nullable', 'string', 'max:100'],
            'meta_bullet1' => ['nullable', 'string'],
            'meta_bullet2' => ['nullable', 'string'],
            'meta_image' => ['nullable', 'string', 'max:255'],
            'meta_service1_title' => ['nullable', 'string', 'max:100'],
            'meta_service1_content' => ['nullable', 'string'],
            'meta_service1_image' => ['nullable', 'string', 'max:255'],
            'meta_service2_title' => ['nullable', 'string', 'max:100'],
            'meta_service2_content' => ['nullable', 'string'],
            'meta_service2_image' => ['nullable', 'string', 'max:255'],
            'meta_faqs' => ['nullable', 'string'],
        ]);

        $data = [
            'heading' => isset($validated['heading']) ? html_entity_decode($validated['heading'], ENT_QUOTES | ENT_HTML5) : null,
            'content' => isset($validated['content']) ? html_entity_decode($validated['content'], ENT_QUOTES | ENT_HTML5) : null,
            'position' => $validated['position'],
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ];

        if (!empty($validated['section_key'])) {
            $data['section_key'] = $validated['section_key'];
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('uploads', 'public');
            $url = \Illuminate\Support\Facades\Storage::url($path);
            $meta = (array) ($section->meta ?? []);
            $meta['image'] = $url;
            $data['meta'] = $meta;
        }

        $metaData = (array) ($data['meta'] ?? []);
        if ($request->filled('meta')) {
            try {
                $incoming = json_decode($request->input('meta'), true);
                if (is_array($incoming)) {
                    $metaData = array_merge($metaData, $incoming);
                }
            } catch (\Throwable $e) {
            }
        }
                if ($request->filled('meta_bullet1')) {
                    $metaData['bullet1'] = $request->input('meta_bullet1');
                }
                if ($request->filled('meta_bullet2')) {
                    $metaData['bullet2'] = $request->input('meta_bullet2');
                }
        // add additional meta fields if provided
        if ($request->filled('meta_description')) {
            $metaData['description'] = $request->input('meta_description');
        }
        if ($request->filled('meta_button_text')) {
            $metaData['button_text'] = $request->input('meta_button_text');
        }
        if ($request->filled('meta_button_url')) {
            $metaData['button_url'] = $request->input('meta_button_url');
        }
        if ($request->filled('meta_subheading')) {
            $metaData['subheading'] = $request->input('meta_subheading');
        }
        if ($request->filled('meta_subtitle')) {
            $metaData['subtitle'] = $request->input('meta_subtitle');
        }
        if ($request->filled('meta_highlight')) {
            $metaData['highlight'] = $request->input('meta_highlight');
        }
        if ($request->filled('meta_image')) {
            $metaData['image'] = $request->input('meta_image');
        }
        if ($request->filled('meta_service1_title')) {
            $metaData['service1_title'] = $request->input('meta_service1_title');
        }
        if ($request->filled('meta_service1_content')) {
            $metaData['service1_content'] = $request->input('meta_service1_content');
        }
        if ($request->filled('meta_service1_image')) {
            $metaData['service1_image'] = $request->input('meta_service1_image');
        }
        if ($request->filled('meta_service2_title')) {
            $metaData['service2_title'] = $request->input('meta_service2_title');
        }
        if ($request->filled('meta_service2_content')) {
            $metaData['service2_content'] = $request->input('meta_service2_content');
        }
        if ($request->filled('meta_service2_image')) {
            $metaData['service2_image'] = $request->input('meta_service2_image');
        }
        if ($request->filled('meta_faqs')) {
            try {
                $faqs = json_decode($request->input('meta_faqs'), true);
                if (is_array($faqs)) {
                    $metaData['faqs'] = $faqs;
                }
            } catch (\Throwable $e) {
            }
        }
        if (!empty($metaData)) {
            $data['meta'] = $metaData;
        }

        $section->update($data);

        // Keep about services_section in sync, and move services section to memorybook+services to support page swapping.
        $sectionKey = $data['section_key'] ?? $section->section_key;

        if ($sectionKey === 'services_section') {
            $syncData = [
                'heading' => $section->heading,
                'content' => $section->content,
                'meta' => $section->meta,
                'position' => $section->position,
                'is_active' => $section->is_active,
            ];

            $aboutPage = Page::where('slug', 'about')->first();
            $servicesPage = Page::where('slug', 'services')->first();

            if ($aboutPage) {
                PageSection::updateOrCreate(
                    ['page_id' => $aboutPage->id, 'section_key' => 'services_section'],
                    $syncData
                );
            }

            if ($servicesPage) {
                PageSection::updateOrCreate(
                    ['page_id' => $servicesPage->id, 'section_key' => 'services_section'],
                    $syncData
                );
            }
        }

        if ($sectionKey === 'services') {
            $syncData = [
                'heading' => $section->heading,
                'content' => $section->content,
                'meta' => $section->meta,
                'position' => $section->position,
                'is_active' => $section->is_active,
            ];

            $servicesPage = Page::where('slug', 'services')->first();
            $memorybookPage = Page::where('slug', 'memorybook')->first();

            if ($servicesPage) {
                PageSection::updateOrCreate(
                    ['page_id' => $servicesPage->id, 'section_key' => 'services'],
                    $syncData
                );
            }

            if ($memorybookPage) {
                PageSection::updateOrCreate(
                    ['page_id' => $memorybookPage->id, 'section_key' => 'services'],
                    $syncData
                );
            }
        }

        return back()->with('status', 'Section updated.');
    }

    public function destroySection(PageSection $section): RedirectResponse
    {
        $section->delete();
        return back()->with('status', 'Section deleted.');
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
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:180'],
            'category' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'selected_image_url' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'tags' => ['nullable', 'string'],
        ]);
        
        $validated['is_published'] = (bool) ($validated['is_published'] ?? false);
        $validated['published_at'] = now();
        
        // Handle featured image - priority: selected existing > new upload
        if (!empty($validated['selected_image_url'])) {
            $validated['featured_image'] = $validated['selected_image_url'];
        } elseif ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
            $file = $request->file('featured_image');
            $path = $file->store('blogs', 'public');
            $validated['featured_image'] = Storage::url($path);
        } else {
            unset($validated['featured_image']);
        }
        
        unset($validated['selected_image_url']);

        // Extract tags before creating post
        $tagsData = [];
        if (!empty($validated['tags'])) {
            try {
                $tagsData = json_decode($validated['tags'], true) ?? [];
            } catch (\Throwable $e) {
                $tagsData = [];
            }
        }
        unset($validated['tags']);

        $post = Post::create($validated);
        
        // Attach tags to post
        if (!empty($tagsData)) {
            foreach ($tagsData as $tagName) {
                // Find or create tag
                $tag = \App\Models\Tag::firstOrCreate(
                    ['name' => $tagName],
                    ['slug' => \Illuminate\Support\Str::slug($tagName), 'is_active' => true]
                );
                $post->tags()->attach($tag->id);
            }
        }

        return back()->with('status', 'Post created successfully!');
    }

    public function gallery(): View
    {
        return view('admin.gallery.index', ['images' => GalleryImage::latest()->get()]);
    }

    public function storeGallery(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'event_id' => ['nullable', 'exists:events,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'array'],
            'image.*' => ['file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'image_path' => ['nullable', 'string', 'max:255'],
        ]);

        // Auto-create event if not selected but service is provided
        $eventId = $data['event_id'] ?? null;
        if (!$eventId && $data['service_id']) {
            $slug = \Str::slug($data['title']) . '-' . time();
            $now = now();
            $event = \App\Models\Event::create([
                'title' => $data['title'],
                'slug' => $slug,
                'service_id' => $data['service_id'],
                'event_date' => $now,
                'date' => $now,
                'description' => 'Auto-created event for gallery upload.',
                'is_active' => true,
                'location' => 'Auto',
                'image' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $eventId = $event->id;
        }

        // Handle multiple images
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('uploads', 'public');
                    $imagePath = Storage::url($path);

                    GalleryImage::create([
                        'title' => $data['title'],
                        'image_path' => $imagePath,
                        'event_id' => $eventId,
                        'service_id' => $data['service_id'] ?? null,
                        'is_active' => (bool) ($data['is_active'] ?? false),
                    ]);
                }
            }
        } else {
            // require image_path now
            if (empty($data['image_path'])) {
                return back()->withErrors(['image' => 'Please upload an image or provide an image path.']);
            }

            GalleryImage::create([
                'title' => $data['title'],
                'image_path' => $data['image_path'],
                'event_id' => $eventId,
                'service_id' => $data['service_id'] ?? null,
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);
        }

        return back()->with('status', 'Gallery images created.');
    }

    public function enquiries(): View
    {
        return view('admin.enquiries.index', ['enquiries' => ContactEnquiry::latest()->paginate(20)]);
    }

    // Services Management
    public function services(): View
    {
        return view('admin.services.index', ['services' => \App\Models\Service::latest()->paginate(20)]);
    }

    public function storeService(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string'],
            'details' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('uploads', 'public');
            $validated['image'] = Storage::url($path);
        }

        \App\Models\Service::create($validated);
        return back()->with('status', 'Service created.');
    }

    // Events Management
    public function events(): View
    {
        return view('admin.events.index', ['events' => \App\Models\Event::latest()->paginate(20)]);
    }

    public function storeEvent(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('uploads', 'public');
            $validated['image'] = Storage::url($path);
        }

        \App\Models\Event::create($validated);
        return back()->with('status', 'Event created.');
    }

    // FAQs Management
    public function faqs(): View
    {
        return view('admin.faqs.index', ['faqs' => \App\Models\FAQ::latest()->paginate(20)]);
    }

    public function storeFAQ(Request $request): RedirectResponse
    {
        \App\Models\FAQ::create($request->validate([
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ]));
        return back()->with('status', 'FAQ created.');
    }

    // Categories Management
    public function categories(): View
    {
        return view('admin.categories.index', ['categories' => \App\Models\Category::latest()->paginate(20)]);
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:categories'],
            'slug' => ['nullable', 'string', 'max:180', 'unique:categories'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        
        // Generate slug from name if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        }
        
        $validated['is_active'] = (bool) ($validated['is_active'] ?? true);
        
        $category = \App\Models\Category::create($validated);
        
        // If AJAX request, return JSON
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'id' => $category->id,
                'name' => $category->name,
                'message' => 'Category created successfully!'
            ]);
        }
        
        return back()->with('status', 'Category created.');
    }

    // Tags Management
    public function tags(): View
    {
        return view('admin.tags.index', ['tags' => \App\Models\Tag::latest()->paginate(20)]);
    }

    public function storeTag(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:tags'],
            'slug' => ['nullable', 'string', 'max:180', 'unique:tags'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        
        // Generate slug from name if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        }
        
        $validated['is_active'] = (bool) ($validated['is_active'] ?? true);
        
        $tag = \App\Models\Tag::create($validated);
        
        // If AJAX request, return JSON
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'id' => $tag->id,
                'name' => $tag->name,
                'message' => 'Tag created successfully!'
            ]);
        }
        
        return back()->with('status', 'Tag created.');
    }

    // Contact Forms Management
    public function contactForms(): View
    {
        return view('admin.contact-forms.index', ['forms' => \App\Models\ContactForm::latest()->paginate(20)]);
    }

    public function storeContactForm(Request $request): RedirectResponse
    {
        \App\Models\ContactForm::create($request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'status' => ['nullable', 'string'],
        ]));
        return back()->with('status', 'Contact form saved.');
    }

    // ==================== CREATE FORMS ====================

    public function createPost(): View
    {
        return view('admin.posts.create');
    }

    public function createPage(): View
    {
        return view('admin.pages.create');
    }

    public function storePage(Request $request): RedirectResponse
    {
        Page::create($request->validate([
            'title' => ['required', 'string', 'max:120'],
            'slug' => ['required', 'string', 'max:180', 'unique:pages', 'not_in:gallery'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]));

        return redirect()->route('admin.pages.index')->with('status', 'Page created.');
    }

    public function createService(): View
    {
        return view('admin.services.create');
    }

    public function editService(\App\Models\Service $service): View
    {
        return view('admin.services.create', ['service' => $service]);
    }

    public function updateService(Request $request, \App\Models\Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string'],
            'details' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('uploads', 'public');
            $validated['image'] = Storage::url($path);
        }

        $service->update($validated);
        return back()->with('status', 'Service updated.');
    }

    public function destroyService(\App\Models\Service $service): RedirectResponse
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('status', 'Service deleted.');
    }

    public function createEvent(): View
    {
        return view('admin.events.create');
    }

    public function editEvent(\App\Models\Event $event): View
    {
        return view('admin.events.create', ['event' => $event]);
    }

    public function updateEvent(Request $request, \App\Models\Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('uploads', 'public');
            $validated['image'] = Storage::url($path);
        }

        $event->update($validated);
        return back()->with('status', 'Event updated.');
    }

    public function destroyEvent(\App\Models\Event $event): RedirectResponse
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('status', 'Event deleted.');
    }

    public function createFAQ(): View
    {
        return view('admin.faqs.create');
    }

    public function editFAQ(\App\Models\FAQ $faq): View
    {
        return view('admin.faqs.create', ['faq' => $faq]);
    }

    public function updateFAQ(Request $request, \App\Models\FAQ $faq): RedirectResponse
    {
        $faq->update($request->validate([
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ]));
        return back()->with('status', 'FAQ updated.');
    }

    public function destroyFAQ(\App\Models\FAQ $faq): RedirectResponse
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('status', 'FAQ deleted.');
    }

    public function createCategory(): View
    {
        return view('admin.categories.create');
    }

    public function editCategory(\App\Models\Category $category): View
    {
        return view('admin.categories.create', ['category' => $category]);
    }

    public function updateCategory(Request $request, \App\Models\Category $category): RedirectResponse
    {
        $category->update($request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:categories,name,' . $category->id],
            'slug' => ['required', 'string', 'max:180', 'unique:categories,slug,' . $category->id],
            'description' => ['nullable', 'string'],
        ]));
        return back()->with('status', 'Category updated.');
    }

    public function destroyCategory(\App\Models\Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('status', 'Category deleted.');
    }

    public function createTag(): View
    {
        return view('admin.tags.create');
    }

    public function editTag(\App\Models\Tag $tag): View
    {
        return view('admin.tags.create', ['tag' => $tag]);
    }

    public function updateTag(Request $request, \App\Models\Tag $tag): RedirectResponse
    {
        $tag->update($request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:tags,name,' . $tag->id],
            'slug' => ['required', 'string', 'max:180', 'unique:tags,slug,' . $tag->id],
        ]));
        return back()->with('status', 'Tag updated.');
    }

    public function destroyTag(\App\Models\Tag $tag): RedirectResponse
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('status', 'Tag deleted.');
    }

    public function createMenu(): View
    {
        return view('admin.menus.create');
    }

    public function storeMenu(Request $request): RedirectResponse
    {
        Menu::create($request->validate([
            'name' => ['required', 'string', 'max:120'],
            'location' => ['required', 'string', 'max:100'],
        ]));
        return back()->with('status', 'Menu created.');
    }

    public function editMenu(Menu $menu): View
    {
        return view('admin.menus.create', ['menu' => $menu->load('items')]);
    }

    public function updateMenu(Request $request, Menu $menu): RedirectResponse
    {
        $menu->update($request->validate([
            'name' => ['required', 'string', 'max:120'],
            'location' => ['required', 'string', 'max:100'],
        ]));
        return back()->with('status', 'Menu updated.');
    }

    public function destroyMenu(Menu $menu): RedirectResponse
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('status', 'Menu deleted.');
    }

    public function createTestimonial(): View
    {
        return view('admin.testimonials.create');
    }

    public function editTestimonial(Testimonial $testimonial): View
    {
        return view('admin.testimonials.create', ['testimonial' => $testimonial]);
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update($request->validate([
            'author_name' => ['required', 'string', 'max:120'],
            'author_title' => ['nullable', 'string', 'max:120'],
            'quote' => ['required', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]));
        return back()->with('status', 'Testimonial updated.');
    }

    public function destroyTestimonial(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial deleted.');
    }

    public function editPost(Post $post): View
    {
        return view('admin.posts.create', ['post' => $post->load('tags')]);
    }

    public function updatePost(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:180'],
            'category' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'selected_image_url' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'tags' => ['nullable', 'string'],
        ]);
        
        $validated['is_published'] = (bool) ($validated['is_published'] ?? false);
        
        // Handle featured image - priority: selected existing > new upload > keep existing
        if (!empty($validated['selected_image_url'])) {
            $validated['featured_image'] = $validated['selected_image_url'];
        } elseif ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
            $file = $request->file('featured_image');
            $path = $file->store('blogs', 'public');
            $validated['featured_image'] = Storage::url($path);
        } else {
            // If no new file, keep existing image
            unset($validated['featured_image']);
        }
        
        unset($validated['selected_image_url']);
        
        // Extract tags before updating post
        $tagsData = [];
        if (!empty($validated['tags'])) {
            try {
                $tagsData = json_decode($validated['tags'], true) ?? [];
            } catch (\Throwable $e) {
                $tagsData = [];
            }
        }
        unset($validated['tags']);
        
        $post->update($validated);
        
        // Sync tags to post
        if (!empty($tagsData) || isset($validated['tags'])) {
            $post->tags()->detach(); // Remove all existing tags
            
            if (!empty($tagsData)) {
                foreach ($tagsData as $tagName) {
                    // Find or create tag
                    $tag = \App\Models\Tag::firstOrCreate(
                        ['name' => $tagName],
                        ['slug' => \Illuminate\Support\Str::slug($tagName), 'is_active' => true]
                    );
                    $post->tags()->attach($tag->id);
                }
            }
        }
        
        return back()->with('status', 'Post updated successfully!');
    }

    public function destroyPost(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post deleted.');
    }

    public function editGallery(GalleryImage $image): View
    {
        return view('admin.gallery.create', ['image' => $image]);
    }

    public function updateGallery(Request $request, GalleryImage $image): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'event_id' => ['nullable', 'exists:events,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'image_path' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
            $data['image_path'] = Storage::url($path);
        }

        $image->update([
            'title' => $data['title'],
            'image_path' => $data['image_path'] ?? $image->image_path,
            'event_id' => $data['event_id'] ?? null,
            'service_id' => $data['service_id'] ?? null,
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);

        return back()->with('status', 'Gallery image updated.');
    }

    public function destroyGallery(GalleryImage $image): RedirectResponse
    {
        $image->delete();
        return redirect()->route('admin.gallery.index')->with('status', 'Gallery image deleted.');
    }

    public function destroyMenuItem(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->delete();
        return back()->with('status', 'Menu item deleted.');
    }

    public function editContactForm(\App\Models\ContactForm $form): View
    {
        return view('admin.contact-forms.create', ['form' => $form]);
    }

    public function createGallery(): View
    {
        return view('admin.gallery.create');
    }

    public function createContactForm(): View
    {
        return view('admin.contact-forms.create');
    }

    public function updateContactForm(Request $request, \App\Models\ContactForm $form): RedirectResponse
    {
        $form->update($request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'status' => ['nullable', 'string'],
        ]));
        return back()->with('status', 'Contact form updated.');
    }

    public function destroyContactForm(\App\Models\ContactForm $form): RedirectResponse
    {
        $form->delete();
        return redirect()->route('admin.contact-forms.index')->with('status', 'Contact form deleted.');
    }

    // Service Sliders Management
    public function sliders(): View
    {
        return view('admin.slider.index', ['sliders' => \App\Models\ServiceSlider::with('service', 'images')->latest()->paginate(20)]);
    }

    public function createSlider(): View
    {
        return view('admin.slider.create', ['services' => \App\Models\Service::where('is_active', true)->get()]);
    }

    public function storeSlider(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'title' => ['required', 'string', 'max:255'],
            'images' => ['required', 'array'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
        ]);

        $slider = \App\Models\ServiceSlider::create([
            'service_id' => $validated['service_id'],
            'title' => $validated['title'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('uploads', 'public');
                    $imagePath = Storage::url($path);
                    \App\Models\ServiceSliderImage::create([
                        'service_slider_id' => $slider->id,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.sliders.index')->with('status', 'Slider created successfully.');
    }

    public function editSlider(\App\Models\ServiceSlider $slider): View
    {
        return view('admin.slider.edit', [
            'slider' => $slider->load('images'),
            'services' => \App\Models\Service::where('is_active', true)->get()
        ]);
    }

    public function updateSlider(Request $request, \App\Models\ServiceSlider $slider): RedirectResponse
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'title' => ['required', 'string', 'max:255'],
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
        ]);

        $slider->update([
            'service_id' => $validated['service_id'],
            'title' => $validated['title'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('uploads', 'public');
                    $imagePath = Storage::url($path);
                    \App\Models\ServiceSliderImage::create([
                        'service_slider_id' => $slider->id,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.sliders.index')->with('status', 'Slider updated successfully.');
    }

    public function destroySlider(\App\Models\ServiceSlider $slider): RedirectResponse
    {
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('status', 'Slider deleted successfully.');
    }
}
