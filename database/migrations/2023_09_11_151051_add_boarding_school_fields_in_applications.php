<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoardingSchoolFieldsInApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->text('boarding_school_students_data_table')->nullable();
            $table->text('boarding_school_predictive_contingent_data_table')->nullable();

            $table->string('boarding_school_target_value')->nullable();
            $table->string('boarding_school_encumbrance_date')->nullable();
            $table->string('boarding_school_cadastral_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            //
        });
    }
}
