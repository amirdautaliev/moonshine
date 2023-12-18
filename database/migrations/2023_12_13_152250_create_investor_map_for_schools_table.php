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
        Schema::create('investor_map_for_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_region_id')->required();
            $table->smallInteger('need')->nullable();
            $table->smallInteger('entered_objects')->nullable();
            $table->smallInteger('planned')->nullable();
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
        Schema::dropIfExists('investor_map_for_schools');
    }
};
