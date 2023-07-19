<?php

namespace App\Models;

use App\Traits\UuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yearbook extends Model
{
    use HasFactory, UuidModelTrait;

    protected $fillable = [
        'school_year_id',
    ];
}
