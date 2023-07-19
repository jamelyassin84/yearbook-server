<?php

use App\Models\Course;
use App\Models\Department;
use App\Models\Information;
use App\Models\SchoolYear;
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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('uuid()'))->primary();
            $table->uuid('information_id');
            $table->uuid('course_id');
            $table->uuid('school_year_id');
            $table->uuid('department_id');
            $table->uuid('section_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
