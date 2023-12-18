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
        Schema::create('documents_forms', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->text('text_kz')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_en')->nullable();
            $table->string('link_kz')->nullable();
            $table->string('link_ru')->nullable();
            $table->string('file_kz')->nullable();
            $table->string('file_ru')->nullable();
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
        Schema::dropIfExists('documents_forms');
    }
};
