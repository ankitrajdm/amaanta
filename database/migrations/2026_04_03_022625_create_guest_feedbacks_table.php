<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guest_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name');
            $table->string('room_number');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->enum('heard_about_us', ['Friends & Family', 'Social Media', 'Ads', 'Other']);
            $table->enum('reservation_method', ['Travel Agency', 'Online', 'Application', 'Other']);
            $table->enum('visit_purpose', ['Vacation', 'Wedding', 'Business', 'Other']);
            $table->enum('service_quality', ['Excellent', 'Very Good', 'Good', 'Satisfactory', 'Poor']);
            $table->enum('cleanliness', ['Excellent', 'Very Good', 'Good', 'Satisfactory', 'Poor']);
            $table->enum('staff_rating', ['Excellent', 'Very Good', 'Good', 'Satisfactory', 'Poor']);
            $table->text('additional_feedback')->nullable();
            $table->boolean('agree_to_submit')->default(false);
            $table->string('status')->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_feedbacks');
    }
};
