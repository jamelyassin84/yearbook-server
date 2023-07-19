<?php

namespace App\Models;

use App\Traits\UuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory, UuidModelTrait;

    protected $fillable = [
        'name',
        'school_year_id',
        'department_id',
        'course_id'
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


    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
