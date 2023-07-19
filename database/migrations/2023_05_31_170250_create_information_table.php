<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('information', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('uuid()'))->primary();
            $table->uuid('course_id')->nullable();
            $table->uuid('department_id')->nullable();
            $table->uuid('section_id')->nullable();
            $table->uuid('school_year_id')->nullable();
            $table->text('picture');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('barangay');
            $table->string('municipality');
            $table->string('province');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
