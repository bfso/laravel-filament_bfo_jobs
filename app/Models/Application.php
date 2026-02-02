<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'document',
        'position_id',
        'user_id'
    ];

    public function position() : BelongsTo {
        return $this->belongsTo(Position::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
