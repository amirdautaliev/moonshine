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
        Schema::create('faq_schools', function (Blueprint $table) {
            $table->id();
            $table->text('question_kz')->nullable();
            $table->text('answer_kz')->nullable();
            $table->text('question_ru')->nullable();
            $table->text('answer_ru')->nullable();
            $table->text('question_en')->nullable();
            $table->text('answer_en')->nullable();
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
        Schema::dropIfExists('faq_schools');
    }
};
