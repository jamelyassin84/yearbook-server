<?php

namespace App\Models;

use App\Traits\UuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use  HasFactory, UuidModelTrait;

    protected $fillable = [
        'name',
    ];

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    public function schoolAdmins()
    {
        return $this->hasMany(SchoolAdmin::class);
    }

    public function schoolEvents()
    {
        return $this->hasMany(Event::class);
    }
}
