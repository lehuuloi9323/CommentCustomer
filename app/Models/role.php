<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];
    public function permissions(){

        return $this->belongsToMany(permission::class, 'role_permission');
    }
    public function users(){

        return $this->belongsToMany(user::class, 'user_role');
    }
}
