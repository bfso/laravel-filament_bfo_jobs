<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
