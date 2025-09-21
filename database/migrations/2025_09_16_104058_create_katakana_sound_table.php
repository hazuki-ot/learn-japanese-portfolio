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
        Schema::create('katakana_sound', function (Blueprint $table) {
            $table->unsignedBigInteger('katakana_id');
            $table->unsignedBigInteger('sound_id');

            $table->foreign('katakana_id')->references('id')->on('katakanas')->onDelete('cascade');
            $table->foreign('sound_id')->references('id')->on('sounds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katakana_sound');
    }
};
