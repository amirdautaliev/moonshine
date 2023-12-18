<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrganizationFieldsInApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('organization_name')->nullable();
            $table->string('official_number')->nullable();
            $table->string('official_address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('email_address')->nullable();
            $table->string('phone_number')->nullable();

            //поля для интерната
            $table->string('boarding_school_region')->nullable();
            $table->string('boarding_school_city')->nullable();
            $table->string('boarding_school_area_and_street')->nullable();
            $table->integer('boarding_school_place_count')->nullable();
            $table->string('boarding_school_exploitation_year')->nullable();
            $table->string('boarding_school_exploitation_type')->nullable();
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
