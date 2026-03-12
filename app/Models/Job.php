<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
    protected $fillable = [
        "company_id",
        "category_id",
        "location_id",
        "title",
        "description",
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->title);
    }
}
