<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    use HasFactory;
    protected $fillable = ['rate', 'restaurant_id', 'area_id', 'user_id'];
    public function restaurant(){
        return $this->belongsTo('App\Models\restaurant');
    }
    public function area(){
        return $this->belongsTo('App\Models\area');
    }
    public function user(){
        return $this->belongsTo('App\Models\user');
    }
}
