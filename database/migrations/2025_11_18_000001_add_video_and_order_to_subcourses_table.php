<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('subcourses', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->string('video_url')->nullable()->after('content');
            $table->integer('order')->default(0)->after('video_url');
        });
    }

    public function down()
    {
        Schema::table('subcourses', function (Blueprint $table) {
            $table->dropColumn(['description', 'video_url', 'order']);
        });
    }
};
