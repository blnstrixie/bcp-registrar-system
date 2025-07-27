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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('student_no');
            $table->integer('subject_id')->nullable();
            $table->double('prelim_grade', 10, 2)->nullable();
            $table->double('midterm_grade', 10, 2)->nullable();
            $table->double('final_grade', 10, 2)->nullable();
            $table->double('gwa', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
