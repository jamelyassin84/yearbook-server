<?php

namespace App\Models;

use App\Traits\UuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Information extends Model
{
    use HasFactory, UuidModelTrait;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'barangay',
        'municipality',
        'province',
        'picture',
        'description',

        'course_id',
        'school_year_id',
        'department_id',
    ];
}
