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
        Schema::create('event_photos', function (Blueprint $table) {
            $table->id('event_photos_id');
            $table->unsignedBigInteger('event_id');
            $table->string('photo_path');
            $table->timestamps();

            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_photo');
    }
};

