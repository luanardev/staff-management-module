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
        Schema::create('app_employees_staff_members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('employee_number')->nullable();
            $table->string('national_id')->nullable();
            $table->string('title');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename')->nullable();
            $table->string('maidenname')->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', array('Male', 'Female'));
            $table->string('marital_status');
            $table->string('official_email')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('mobile_contact');
            $table->string('home_contact')->nullable();
            $table->string('nationality')->nullable();
            $table->string('home_country')->nullable();
            $table->string('home_village')->nullable();
            $table->string('home_authority')->nullable();
            $table->string('home_district')->nullable();
            $table->string('avatar')->nullable();
            $table->string('signature')->nullable();
            $table->enum('status', array('Active', 'Inactive'))->default('Active');
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
        Schema::dropIfExists('app_employees_staff_members');
    }
};
