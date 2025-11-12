<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->longText('sound')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->longText('sound')->nullable(false)->change();
        });
    }

};
