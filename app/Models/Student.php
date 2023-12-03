<?php

namespace App\Models;

use App\Traits\UuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory, UuidModelTrait;

    protected $fillable = [
        'school_year_id',
        'department_id',
        'course_id',
        'section_id',
        'information_id',
    ];

    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }


    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function information(): BelongsTo
    {
        return $this->belongsTo(Information::class);
    }
}
