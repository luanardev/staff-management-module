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
        Schema::create('app_employees_supervisor_faculty', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('staff_id');
            $table->uuid('faculty_id');
            $table->uuid('campus_id');
            $table->enum('position', ['Dean', 'Deputy'])->default('Dean');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('app_employees_supervisor_faculty');
    }
};
