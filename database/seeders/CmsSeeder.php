<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'website_name' => 'Amaanta Events',
            'logo' => 'assets/img/logonew.png',
            'favicon' => 'assets/img/logo111.png',
            'social_links' => '{"instagram":"#","facebook":"#"}',
            'copyright_text' => '© Amaanta Events',
            'whatsapp_link' => 'https://wa.me/910000000000',
            'contact_no' => '+91 99999 99999',
            'contact_email' => 'hello@amaanta.com',
            'address' => 'Mumbai, India',
        ] as $key => $value) {
            WebsiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $home = Page::updateOrCreate(['slug' => 'home'], ['title' => 'Home', 'is_active' => true]);
        $about = Page::updateOrCreate(['slug' => 'about'], ['title' => 'About Us', 'is_active' => true]);
        $contact = Page::updateOrCreate(['slug' => 'contact'], ['title' => 'Contact Us', 'is_active' => true]);

        $homeSections = [
            ['section_key' => 'banner', 'heading' => 'Banner Section', 'content' => 'Main hero content.'],
            ['section_key' => 'what_we_do', 'heading' => 'What We Do', 'content' => 'Event concepts and planning.'],
            ['section_key' => 'testimonials', 'heading' => 'Testimonials', 'content' => 'Client stories.'],
            ['section_key' => 'services', 'heading' => 'Explore Services', 'content' => 'Wedding, corporate, private events.'],
            ['section_key' => 'about_us', 'heading' => 'About Us', 'content' => 'Our brand story and people.'],
            ['section_key' => 'events', 'heading' => 'Events', 'content' => 'Highlighted celebrations.'],
            ['section_key' => 'blog', 'heading' => 'Blog', 'content' => 'Latest posts.'],
        ];

        foreach ($homeSections as $index => $section) {
            $home->sections()->updateOrCreate(
                ['section_key' => $section['section_key']],
                $section + ['position' => $index + 1, 'is_active' => true]
            );
        }

        foreach ([
            ['section_key' => 'about_intro', 'heading' => 'About Us', 'content' => 'Who we are and what we do.'],
            ['section_key' => 'our_services', 'heading' => 'Our Services', 'content' => 'Decor, planning, execution.'],
            ['section_key' => 'faq', 'heading' => 'F.A.Qs', 'content' => 'Frequently asked questions.'],
        ] as $idx => $section) {
            $about->sections()->updateOrCreate(['section_key' => $section['section_key']], $section + ['position' => $idx + 1, 'is_active' => true]);
        }

        foreach ([
            ['section_key' => 'contact_information', 'heading' => 'Contact Information', 'content' => 'Phone, email and address details.'],
            ['section_key' => 'book_event_form', 'heading' => 'Book your event', 'content' => 'Send an enquiry through the form.'],
            ['section_key' => 'map', 'heading' => 'Map', 'content' => 'Embedded location map section.'],
        ] as $idx => $section) {
            $contact->sections()->updateOrCreate(['section_key' => $section['section_key']], $section + ['position' => $idx + 1, 'is_active' => true]);
        }

        $headerMenu = Menu::updateOrCreate(['location' => 'header'], ['name' => 'Header Menu']);
        $footerMenu = Menu::updateOrCreate(['location' => 'footer'], ['name' => 'Footer Menu']);

        foreach ([['Home', '/'], ['About', '/about'], ['Contact', '/contact']] as $i => $item) {
            $headerMenu->items()->updateOrCreate(['label' => $item[0]], ['url' => $item[1], 'position' => $i + 1, 'is_active' => true]);
            $footerMenu->items()->updateOrCreate(['label' => $item[0]], ['url' => $item[1], 'position' => $i + 1, 'is_active' => true]);
        }

        Testimonial::firstOrCreate(['author_name' => 'Ananya Singh'], ['author_title' => 'Bride', 'quote' => 'Amaanta handled every detail perfectly.', 'is_active' => true]);

        Post::firstOrCreate(['slug' => 'welcome-to-amaanta-blog'], [
            'title' => 'Welcome to Amaanta Blog',
            'category' => 'News',
            'excerpt' => 'A short intro from the team.',
            'content' => 'We now manage all website sections from the admin panel.',
            'is_published' => true,
            'published_at' => now(),
        ]);
    }
}
