<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'internal_note',
        'end',
    ];

    protected $casts = [
        'end' => 'datetime',
    ];

    public function applications(): HasMany {
        return $this->hasMany(Application::class);
    }
}
