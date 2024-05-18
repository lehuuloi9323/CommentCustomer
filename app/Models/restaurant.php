<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\user');
    }

    public function data(){
        return $this->hasOne('App\Models\data');
    }
}
