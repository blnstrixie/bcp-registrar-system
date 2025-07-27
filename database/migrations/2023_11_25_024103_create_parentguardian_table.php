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
        Schema::create('parentguardian', function (Blueprint $table) {
            $table->id();
            $table->string('student_no');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('guardian_name');
            $table->string('guardian_job')->nullable();
            $table->string('guardian_contact_no');
            $table->string('guardian_email')->nullable();
            $table->string('guardian_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parentguardian');
    }
};
