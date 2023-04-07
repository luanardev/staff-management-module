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
        Schema::create('app_employees_staff_supervision', function (Blueprint $table) {
            $table->uuid('supervisor_id');
            $table->uuid('subordinate_id');
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('app_employees_staff_members')->onDelete('cascade');
            $table->foreign('subordinate_id')->references('id')->on('app_employees_staff_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_employees_staff_supervision');
    }
};
