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
        Schema::table('courses', function (Blueprint $table) {
            // Teaching mode: static (video only), online (live via Zoom), offline (in-person), hybrid (both)
            $table->enum('teaching_mode', ['static', 'online', 'offline', 'hybrid'])->default('static')->after('status');

            // For online/hybrid courses - default meeting platform info
            $table->string('meeting_platform')->nullable()->after('teaching_mode'); // zoom, google_meet, etc.
            $table->string('default_meeting_link')->nullable()->after('meeting_platform');

            // For offline/hybrid courses - location info
            $table->string('location_name')->nullable()->after('default_meeting_link');
            $table->text('location_address')->nullable()->after('location_name');
            $table->string('location_city')->nullable()->after('location_address');

            // Maximum participants for live sessions
            $table->integer('max_participants')->nullable()->after('location_city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'teaching_mode',
                'meeting_platform',
                'default_meeting_link',
                'location_name',
                'location_address',
                'location_city',
                'max_participants'
            ]);
        });
    }
};
