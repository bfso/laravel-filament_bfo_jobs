<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        "company_id",
        "category_id",
        "location_id",
        "title",
        "description",
        "canton",
        "zip",
        "home_office",
        "language",
        "workplace",
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
}
