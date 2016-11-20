<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'city_id', 'area', 'major_id', 'price', 'brief', 'rate', 'fcm_token', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   

public function permessions()
    {
        return $this->hasMany(Permession::class);
    }


    public function perm_methods()
    {
        return $this->hasManyThrough(PermessionMethod::class,Permession::class);
    }


    public function exportNotfications()
    {
            return $this->hasMany(Notfication::class,'sender_id');
    }


    public function importNotfications()
    {
            return $this->hasMany(Notfication::class,'user_id');
    }  


    public function adminNotfications()
    {
            return Notfication::where('sender_id','!=',$this->id);
    }

}
