<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Authenticatable
{
    protected $fillable = ["company_name", "email", "password"];

    protected $hidden = ["password"];

    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
