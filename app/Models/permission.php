<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description'];
    public function roles(){

        return $this->belongsToMany(role::class, 'role_permission');
    }
}
