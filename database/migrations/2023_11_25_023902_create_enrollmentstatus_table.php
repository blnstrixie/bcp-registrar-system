<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollmentstatus', function (Blueprint $table) {
            $table->id();
            $table->string('student_no');
            $table->date('registration_date')->default(now());
            $table->integer('yearlevel_id');
            $table->integer('course_id');
            $table->integer('section_id');
            $table->integer('type_id');
            $table->integer('status_id');
            $table->string('backsubject_id')->nullable();
            $table->integer('prof_id');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollmentstatus');
    }
};
