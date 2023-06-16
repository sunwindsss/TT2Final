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
        Schema::create('actors_in_shows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('show_id');
            $table->unsignedBigInteger('actor_id');
            $table->foreign('show_id')->references('id')->on('tv_shows')->onDelete('cascade');
            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');
            // Add any additional columns if needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actors_in_shows');
    }
};
