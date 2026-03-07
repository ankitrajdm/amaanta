<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
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
            'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3505.2884343805913!2d77.0857608!3d28.531048900000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1be8bf1c4515%3A0x2192069b8aec5394!2sAmaanta!5e0!3m2!1sen!2sin!4v1769654719666!5m2!1sen!2sin',
        ] as $key => $value) {
            WebsiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $home = Page::updateOrCreate(['slug' => 'home'], ['title' => 'Home', 'is_active' => true]);
        $about = Page::updateOrCreate(['slug' => 'about'], ['title' => 'About Us', 'is_active' => true]);
        $services = Page::updateOrCreate(['slug' => 'services'], ['title' => 'Services', 'is_active' => true]);
        $gallery = Page::updateOrCreate(['slug' => 'gallery'], ['title' => 'Memorybook & Gallery', 'is_active' => true]);
        $contact = Page::updateOrCreate(['slug' => 'contact'], ['title' => 'Contact Us', 'is_active' => true]);
        // blog page for listing posts – editable banner
        $blogPage = Page::updateOrCreate(['slug' => 'blog'], ['title' => 'Blog', 'is_active' => true]);

        $homeSections = [
            ['section_key' => 'banner', 'heading' => 'Where Nature Meets Elegance', 'content' => 'A world-class farm in Delhi offering serene <span>natural beauty</span> for unforgettable celebrations.',
                'meta' => json_encode(['subheading' => 'Amaanta'])],
            ['section_key' => 'what_we_do', 'heading' => 'What we do', 'content' => 'A wedding that is <span class="white">True</span> as you are!',
                'meta' => json_encode([ 'short' => 'We host and curate world-class weddings, celebrations, and corporate events in a serene natural setting, supported by expert planning and flawless execution.',
                                         'details' => 'At Amaanta, we provide a world-class venue for weddings, social celebrations, and corporate events, set across 2.5 acres of lush green landscapes. Surrounded by exotic flowers, majestic trees, tranquil fountains, and thoughtfully designed pathways, Amaanta offers a serene and picturesque setting for unforgettable moments. With a spacious 13,000 sq. ft. semi-covered area and a professionally managed team of experienced industry experts, we ensure seamless coordination and personalized service. For over 8 years, Amaanta has been a trusted landmark, delivering flawless events in a timeless natural haven.',
                                         'button_text' => 'Learn More',
                                         'button_url' => '/about' ] )],
            ['section_key' => 'testimonials', 'heading' => 'Testimonials', 'content' => 'Client stories.'],
            ['section_key' => 'services', 'heading' => 'The experience', 'content' => 'Explore <span>Services</span>',
                'meta' => json_encode(['description' => 'Professional Wedding & Event Planner surabit aliquet orci elit gene tristisue in lorem dream vitae alisuam tincidunt felis sed gravida aliquam nemue libero hendrerit magna sit amenta the mollis lacus huam maurisine alisuam erat volutfat.']),
            ],
            ['section_key' => 'about_us', 'heading' => 'About Us', 'content' => 'Amaanta, a world class farm in Delhi is a natural haven that provides a sense of tranquility.',
                'meta' => json_encode(['bullet1' => '8 Years of Experience','bullet2' => '250+ Wedding Planner'])],
            ['section_key' => 'events', 'heading' => 'Events', 'content' => 'Highlighted celebrations.'],
            ['section_key' => 'blog', 'heading' => 'Latest News', 'content' => 'Wedding <span class="white">Blog</span>',
                'meta' => json_encode(['description' => 'Wedding Tips, inspiration and bridal reports. Curabit aliquet orci elit gene tristique lorem dream vitae situam tincidun felis sed gravida alisuam nemue libero hendrerit maina into amenta the mollis lacus quam maurisine in the miss erat volutpat.'])],
        ];

        foreach ($homeSections as $index => $section) {
            $home->sections()->updateOrCreate(
                ['section_key' => $section['section_key']],
                $section + ['position' => $index + 1, 'is_active' => true]
            );
        }

        // default hero/introduction for blog page
        $blogPage->sections()->updateOrCreate(
            ['section_key' => 'hero'],
            [
                'heading' => 'Blog & Insights',
                'content' => 'Articles, tips, and stories from our world',
                'position' => 1,
                'is_active' => true,
            ]
        );

        foreach ([
            ['section_key' => 'about_intro', 'heading' => 'About Us', 'content' => 'Who we are and what we do.', 'meta' => json_encode(['subheading' => 'Amaanta'])],
            ['section_key' => 'main_content', 'heading' => 'Amaanta', 'content' => 'Amaanta, a world class farm in Delhi is a natural haven that provides a sense of tranquility. A variety of exotic flowers, redwood trees and intersecting gravel and flagstone paths besides the fountains make it a perfect destination and a timeless treasure for all your special events. Amaanta has a lush green 2.5 acre farm and a semi-covered area of approximately 13,000 sq. feet and has been a landmark in the vicinity for over 8 years. We are a professionally managed company with qualified & experienced professionals from the industry who are fully equipped to cater to your every need.',
                'meta' => json_encode(['subtitle' => 'About Us', 'highlight' => 'Farms', 'bullet1' => '8 Years of Experience', 'bullet2' => '250+ Wedding Planner', 'image' => '/assets/img/about.jfif'])],
            ['section_key' => 'services_section', 'heading' => 'Amaanta Services', 'content' => 'Our comprehensive services for your special events.',
                'meta' => json_encode([
                    'subtitle' => 'Our Services',
                    'highlight' => 'Services',
                    'service1_title' => 'Decoration',
                    'service1_content' => 'With our romantic elegant settings, we aim to make your wedding/event an unforgettable and truly memorable one. With our focus on fine details and extensive paraphernalia backed by extensive experience, our unrivaled service will ensure that you get hitched without a hitch.',
                    'service1_image' => '/assets/img/services/service_list1.jpg',
                    'service2_title' => 'Luxury suites',
                    'service2_content' => 'Nearly double the size of your average hotel room, our two luxurious suites have everything you need and more. Divine, elegant, perfectly designed and offer the epitome of decadence, indulgence, and luxury.',
                    'service2_image' => '/assets/img/services/service-2.png',
                ])],
            ['section_key' => 'faq', 'heading' => 'F.A.Qs', 'content' => 'Frequently asked questions.', 'meta' => json_encode(['subtitle' => 'Questions', 'faqs' => [
                ['question' => 'What is Amaanta?', 'answer' => 'Amaanta is a world-class farm in Delhi offering serene natural beauty for unforgettable celebrations.'],
                ['question' => 'What services do you offer?', 'answer' => 'We offer decoration, event planning, luxury suites, and more for weddings and events.'],
                ['question' => 'How many years of experience do you have?', 'answer' => 'We have 8 years of experience in the industry.'],
                ['question' => 'How many wedding planners do you have?', 'answer' => 'We have 250+ experienced wedding planners.'],
                ['question' => 'What is the size of your venue?', 'answer' => 'Our venue has a lush green 2.5 acre farm and a semi-covered area of approximately 13,000 sq. feet.']
            ]])],
        ] as $idx => $section) {
            $about->sections()->updateOrCreate(['section_key' => $section['section_key']], $section + ['position' => $idx + 1, 'is_active' => true]);
        }

        // Services page hero section
        $services->sections()->updateOrCreate(
            ['section_key' => 'hero'],
            [
                'heading' => 'Our Services',
                'content' => 'Explore our comprehensive range of professional services',
                'meta' => json_encode(['subtitle' => 'Services']),
                'position' => 1,
                'is_active' => true,
            ]
        );

        // Gallery page hero section
        $gallery->sections()->updateOrCreate(
            ['section_key' => 'hero'],
            [
                'heading' => 'Memorybook & Gallery',
                'content' => 'Captured moments from our events',
                'position' => 1,
                'is_active' => true,
            ]
        );

        foreach ([
            ['section_key' => 'hero', 'heading' => 'Contact Information', 'content' => 'Fill out the form below and we’ll respond within 24 hours.', 'meta' => json_encode(['subtitle' => 'Get in touch', 'background' => '/assets/img/ab-01.png'])],
            ['section_key' => 'contact_information', 'heading' => 'Contact Information', 'content' => 'Phone, email and address details.'],
            ['section_key' => 'book_event_form', 'heading' => 'Book your event', 'content' => 'Ask me a question, I\'d love to hear more from you.'],
            ['section_key' => 'faq_intro', 'heading' => 'F.A.Qs', 'content' => 'Have questions? We have answers.'],
        ] as $idx => $section) {
            $contact->sections()->updateOrCreate(['section_key' => $section['section_key']], $section + ['position' => $idx + 1, 'is_active' => true]);
        }

        // Create default services for the carousel
        $serviceData = [
            ['title' => 'Wedding Planner', 'slug' => 'wedding-planner', 'description' => 'Complete wedding planning and coordination services for your special day.', 'image' => '/assets/img/services/1-1.jpg'],
            ['title' => 'Cocktail Party', 'slug' => 'cocktail-party', 'description' => 'Professional cocktail and drinks service for corporate and social events.', 'image' => '/assets/img/services/2-1.jpg'],
            ['title' => 'Mehendi Ceremony', 'slug' => 'mehendi-ceremony', 'description' => 'Traditional Mehendi ceremony planning with authentic music and decor.', 'image' => '/assets/img/services/3-1.jpg'],
            ['title' => 'Decoration', 'slug' => 'decoration', 'description' => 'Elegant and customized decoration services for all occasions.', 'image' => '/assets/img/services/1-1.jpg'],
            ['title' => 'Catering', 'slug' => 'catering', 'description' => 'Gourmet catering with diverse cuisines for corporate and personal events.', 'image' => '/assets/img/services/2-1.jpg'],
            ['title' => 'Photography', 'slug' => 'photography', 'description' => 'Professional photography capturing your precious moments.', 'image' => '/assets/img/services/3-1.jpg'],
        ];

        foreach ($serviceData as $service) {
            Service::firstOrCreate(
                ['slug' => $service['slug']],
                $service + ['is_active' => true]
            );
        }

        $headerMenu = Menu::updateOrCreate(['location' => 'header'], ['name' => 'Header Menu']);
        $footerMenu = Menu::updateOrCreate(['location' => 'footer'], ['name' => 'Footer Menu']);

        foreach ([['Home', '/'], ['About', '/about'], ['Contact', '/contact']] as $i => $item) {
            $headerMenu->items()->updateOrCreate(['label' => $item[0]], ['url' => $item[1], 'position' => $i + 1, 'is_active' => true]);
            $footerMenu->items()->updateOrCreate(['label' => $item[0]], ['url' => $item[1], 'position' => $i + 1, 'is_active' => true]);
        }

        Testimonial::firstOrCreate(['author_name' => 'Ananya Singh'], ['author_title' => 'Bride', 'quote' => 'Amaanta handled every detail perfectly. From the initial planning to the final farewell, their team ensured everything was flawless. The venue is absolutely stunning!', 'is_active' => true]);
        Testimonial::firstOrCreate(['author_name' => 'Rahul Sharma'], ['author_title' => 'Groom', 'quote' => 'Choosing Amaanta for our wedding was the best decision. The natural beauty, professional service, and attention to detail made our special day unforgettable.', 'is_active' => true]);
        Testimonial::firstOrCreate(['author_name' => 'Priya Patel'], ['author_title' => 'Event Organizer', 'quote' => 'As an event planner, I\'ve worked with many venues, but Amaanta stands out. Their team is professional, responsive, and the venue itself is a dream come true.', 'is_active' => true]);
        Testimonial::firstOrCreate(['author_name' => 'Vikram Kumar'], ['author_title' => 'Corporate Client', 'quote' => 'We hosted our company retreat at Amaanta and it was exceptional. The peaceful environment, excellent facilities, and impeccable service made it a success.', 'is_active' => true]);
        Testimonial::firstOrCreate(['author_name' => 'Sneha Gupta'], ['author_title' => 'Bride', 'quote' => 'The moment we stepped into Amaanta, we knew it was perfect for us. The lush greenery, beautiful flowers, and serene atmosphere created the magical setting we dreamed of.', 'is_active' => true]);
        Testimonial::firstOrCreate(['author_name' => 'Arjun Mehta'], ['author_title' => 'Family Member', 'quote' => 'Amaanta made our family reunion truly special. The spacious grounds, delicious catering, and warm hospitality created memories that will last a lifetime.', 'is_active' => true]);

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
