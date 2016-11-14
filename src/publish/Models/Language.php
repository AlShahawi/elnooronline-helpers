<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];
    
	protected $fillable = ['langable_id','langable_type','lang','colum','trans'];


    public function lang()
    {
    	return $this->belongsTo('App\Lang','lang')->withTrashed();
    }

    public function langable()
    {
    	return $this->morphTo();
    }
}
