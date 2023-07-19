<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidModelTrait
{
    protected static function bootUuidModelTrait()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    protected function performInsert(\Illuminate\Database\Eloquent\Builder $query)
    {
        if ($this->getKeyType() === 'string' && !isset($this->attributes[$this->primaryKey])) {
            $this->setId();
        }

        parent::performInsert($query);
    }

    protected function setId()
    {
        $this->attributes[$this->primaryKey] = (string) Str::uuid();
    }
}
