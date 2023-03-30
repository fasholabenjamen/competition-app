<?php

namespace App\Domains\Competition\Models;

use App\Domains\Identity\Traits\SetUUID;
use Database\Factories\Domains\Competition\CompetitionRecordFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionRecord extends Model
{
    use HasFactory, SetUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
  
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string'
    ];

    protected static function newFactory()
    {
        return CompetitionRecordFactory::new();
    }
}
