<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function languages()
    {
    	return $this->hasMany('App\Language','lang')->withTrashed();
    }
}
