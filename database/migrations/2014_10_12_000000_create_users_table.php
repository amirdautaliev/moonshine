<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique()->nullable();
            $table->string('password')->nullable();
            $table->foreignId('role_id')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('official_number')->nullable();
            $table->string('official_address')->nullable();
            $table->string('actual_address')->nullable();
            $table->string('ceo_fullname')->nullable();
            $table->string('ceo_official_number')->nullable();
            $table->string('email_address')->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('postcode')->nullable();


            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
