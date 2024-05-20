<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use SoftDeletes;

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'password', 'restaurant_id', 'area_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    public function restaurant(){
        return $this->belongsTo('App\Models\restaurant');
    }
    public function area(){
        return $this->belongsTo('App\Models\area');
    }
    public function data(){
        return $this->hasOne('App\Models\data');
    }

    public function roles(){
        return $this->belongsToMany(role::class, 'user_role');
    }
    public function hasPermission($permission){
        foreach($this->roles as $role) {
            if($role->permissions->where('slug', $permission)->count() > 0){
                return true;
        }

    }
        return false;
    }
}
