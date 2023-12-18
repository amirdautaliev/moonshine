<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');

            $table->string('signatory_name')->nullable();
            $table->string('signatory_official_number')->nullable();
            $table->string('signatory_pdf')->nullable();

            $table->integer('tuition_fee')->nullable();
            $table->boolean('elementary_education')->default(false);
            $table->boolean('basic_secondary_education')->default(false);
            $table->boolean('basic_general_education')->default(false);
            $table->string('national_educational_db_registration')->nullable();
            $table->string('state_procurements_registration')->nullable();
            $table->string('boarding_school')->nullable();
            $table->string('student_contingent')->nullable();

            $table->text('students_data_table')->nullable();
            $table->text('predictive_contingent_data_table')->nullable();

            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('area_and_street')->nullable();
            $table->string('school_name')->nullable();
            $table->integer('place_count')->nullable();
            $table->string('exploitation_year')->nullable();

            $table->integer('private_organization_place_count')->nullable();
            $table->string('private_organization_exploitation_type')->nullable();
            $table->string('private_organization_exploitation_year')->nullable();
            $table->string('private_organization_government_order')->nullable();

            $table->string('education_licence')->nullable();
            $table->string('legal_entity_certificate')->nullable();
            $table->string('bank_certificate')->nullable();
            $table->string('preliminary_agreement')->nullable();
            $table->string('immutability_agreement')->nullable();
            $table->string('real_estate_certificate')->nullable();

            $table->foreignId('status_id')->nullable();

            $table->string('executor_id')->nullable();
            $table->string('main_executor_id')->nullable();

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
        Schema::dropIfExists('applications');
    }
}
