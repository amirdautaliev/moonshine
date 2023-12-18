<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_site_map_for_schools', function (Blueprint $table) {
            $table->id();
            $table->string('text_kz')->nullable();
            $table->string('text_ru')->nullable();
            $table->string('text_en')->nullable();
            $table->smallInteger('number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investor_site_map_for_schools');
    }
};
