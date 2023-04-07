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
        Schema::create('app_employees_staff_progress', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('staff_id');
            $table->uuid('position_id');
            $table->uuid('job_rank_id')->nullable();
            $table->uuid('job_type_id');
            $table->uuid('job_status_id');
            $table->uuid('progress_type_id');
            $table->string('grade');
            $table->integer('notch')->nullable();
            $table->enum('status', array('Active', 'Inactive'))->default('Active');
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
        Schema::dropIfExists('app_employees_staff_progress');
    }
};
