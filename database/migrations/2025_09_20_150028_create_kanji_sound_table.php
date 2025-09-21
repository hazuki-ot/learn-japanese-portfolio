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
        Schema::create('kanji_sound', function (Blueprint $table) {
            $table->unsignedBigInteger('kanji_id');
            $table->unsignedBigInteger('sound_id');

            $table->foreign('kanji_id')->references('id')->on('kanjis')->onDelete('cascade');
            $table->foreign('sound_id')->references('id')->on('sounds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kanji_sound');
    }
};
