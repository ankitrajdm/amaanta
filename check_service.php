<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$service = \App\Models\Service::where('slug', 'wedding-planner')->first();
if ($service) {
    echo "Service exists: " . $service->title . "\n";
    $sliders = \App\Models\ServiceSlider::where('service_id', $service->id)->count();
    echo "Sliders: $sliders\n";
    $images = \App\Models\GalleryImage::where('service_id', $service->id)->count();
    echo "Gallery Images: $images\n";
    $testimonials = \App\Models\Testimonial::where('is_active', true)->count();
    echo "Testimonials: $testimonials\n";
} else {
    echo "Service not found\n";
}
?>