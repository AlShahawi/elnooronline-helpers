<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];
    public function menus()
    {
    	return $this->hasMany(Menu::class);
    }

}
