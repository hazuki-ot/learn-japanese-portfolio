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
        Schema::table('katakana_sound', function (Blueprint $table) {
            $table->dropForeign(['katakana_id']);

            // onDelete('cascade') を付けて作り直す
            $table->foreign('katakana_id')
                  ->references('id')->on('katakanas')
                  ->onDelete('cascade');

            $table->dropForeign(['sound_id']);

            // onDelete('cascade') を付けて作り直す
            $table->foreign('sound_id')
                  ->references('id')->on('sounds')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('katakana_sound', function (Blueprint $table) {
            //
        });
    }
};
