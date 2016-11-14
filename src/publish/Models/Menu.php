<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function page()
    {
    	return $this->belongsTo(Page::class,'page_id')->withTrashed();
    }
}
