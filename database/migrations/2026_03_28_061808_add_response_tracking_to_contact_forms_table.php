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
        Schema::table('contact_forms', function (Blueprint $table) {
            $table->enum('response_status', ['pending', 'responded', 'follow_up_needed'])->default('pending')->after('status');
            $table->timestamp('responded_at')->nullable()->after('response_status');
            $table->text('admin_notes')->nullable()->after('responded_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            $table->dropColumn(['response_status', 'responded_at', 'admin_notes']);
        });
    }
};
