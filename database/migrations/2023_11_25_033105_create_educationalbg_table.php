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
        Schema::create('educationalbg', function (Blueprint $table) {
            $table->id();
            $table->string('student_no');
            $table->string('primary_school');
            $table->string('primary_year_graduated');
            $table->string('secondary_school');
            $table->string('secondary_year_graduated');
            $table->string('last_school_attended');
            $table->string('last_school_year_graduated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educationalbg');
    }
};
