<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructorID');
            $table->string('title');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('thumbnail')->nullable();
            $table->timestamps();

            $table->index('instructorID');
        });

        // Foreign key terpisah
        Schema::table('courses', function (Blueprint $table) {
            $table->foreign('instructorID')
                  ->references('id')
                  ->on('instructors')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
