<?php

namespace App\Models;

use App\Traits\UuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory, UuidModelTrait;

    protected $fillable = [
        'name',
        'path',
        'extension',
        'mime_type',
        'size',
        'url',
    ];
}
