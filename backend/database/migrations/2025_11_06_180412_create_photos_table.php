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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('uploader_id');
            $table->string('uploader_name');
            $table->string('filename');
            $table->string('type');
            $table->unsignedInteger('size');
            $table->timestamps();
            $table->foreign('album_id')
            ->references('id')
            ->on('albums')
            ->onDelete('cascade');
            $table->foreign('uploader_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
