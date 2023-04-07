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
        Schema::create('app_employees_staff_spouse', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('staff_id');
            $table->string('national_id')->nullable();
            $table->string('title');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('date_of_birth');
            $table->enum('gender', array('Male', 'Female'));
            $table->string('contact_email')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('home_country')->nullable();
            $table->string('home_village')->nullable();
            $table->string('home_authority')->nullable();
            $table->string('home_district')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('app_employees_staff_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_employees_staff_spouse');
    }
};
