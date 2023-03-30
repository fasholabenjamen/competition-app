<?php

namespace App\Domains\Identity\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait SetUUID
{
    protected static function boot (): void
    {
        // Boot other traits on the Model
        parent::boot();

        /**
         * Listen for the creating event on the user model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
         */
        static::creating(function (Model $model) {
            if ($model->getKey() === null) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }

    // Tells the database not to auto-increment this field
    public function getIncrementing (): bool
    {
        return false;
    }

    // Helps the application specify the field type in the database
    public function getKeyType (): string
    {
        return 'string';
    }
}