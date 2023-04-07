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
        Schema::create('app_employees_staff_qualifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('class')->nullable();
            $table->string('specialization')->nullable();
            $table->string('institution');
            $table->string('country');
            $table->string('year', 4);
            $table->string('attachment')->nullable();
            $table->uuid('level_id');
            $table->uuid('staff_id');
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
        Schema::dropIfExists('app_employees_staff_qualifications');
    }
};
