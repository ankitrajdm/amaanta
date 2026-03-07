<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_slider_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_slider_id');
            $table->string('image_path');
            $table->timestamps();
            $table->foreign('service_slider_id')->references('id')->on('service_sliders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_slider_images');
    }
};
