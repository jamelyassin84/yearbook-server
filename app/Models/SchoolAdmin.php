<?php

namespace App\Models;

use App\Traits\UuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolAdmin extends Model
{
    use HasFactory, UuidModelTrait;

    protected $fillable = [
        'school_year_id',
        'information_id',
        'title',
        'position'
    ];

    public function information(): BelongsTo
    {
        return $this->belongsTo(Information::class);
    }

    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
