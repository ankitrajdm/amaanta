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
        Schema::dropIfExists('bookings');
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('phone');
            $table->date('event_date');
            $table->decimal('lawn_cost', 10, 2)->nullable();
            $table->decimal('decoration_cost', 10, 2)->nullable();
            $table->decimal('catering_cost', 10, 2)->nullable();
            $table->decimal('other_charges', 10, 2)->nullable();
            $table->decimal('total_cost', 10, 2);
            $table->decimal('advance_payment', 10, 2);
            $table->enum('payment_mode', ['Cash', 'UPI', 'Bank Transfer']);
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
