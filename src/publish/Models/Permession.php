<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permession extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];
    
	protected $fillable = ['controller'];
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function methods()
    {
    	return $this->hasMany(PermessionMethod::class);
    }
}
