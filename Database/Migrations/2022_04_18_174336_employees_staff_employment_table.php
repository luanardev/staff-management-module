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
        Schema::create('app_employees_staff_employment', function (Blueprint $table) {
            $table->uuid('staff_id')->primary();
            $table->uuid('branch_id');
            $table->uuid('campus_id');
            $table->uuid('department_id');
            $table->uuid('section_id');
            $table->uuid('position_id');
            $table->uuid('job_rank_id')->nullable();
            $table->uuid('job_category_id');
            $table->uuid('job_type_id');
            $table->uuid('job_status_id');
            $table->uuid('progress_type_id');
            $table->string('grade');
            $table->integer('notch')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('confirmation_status', array('Confirmed', 'Unconfirmed'))->default('Unconfirmed');
            $table->date('confirmation_date')->nullable();
            $table->text('confirmation_comment')->nullable();
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
        Schema::dropIfExists('app_employees_staff_employment');
    }
};
