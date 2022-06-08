<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function getUsers()
    {
        return $this->hasMany('App\User', 'role_id');
    }


    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
    
}
