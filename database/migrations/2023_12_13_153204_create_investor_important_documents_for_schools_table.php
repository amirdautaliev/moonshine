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
        Schema::create('investor_important_documents_for_schools', function (Blueprint $table) {
            $table->id();
            $table->string('link_kz')->nullable();
            $table->string('link_ru')->nullable();
            $table->string('link_en')->nullable();
            $table->string('bank_file_kz')->nullable();
            $table->string('bank_file_ru')->nullable();
            $table->string('bank_file_en')->nullable();
            $table->string('npa_file')->nullable();
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
        Schema::dropIfExists('investor_important_documents_for_schools');
    }
};
