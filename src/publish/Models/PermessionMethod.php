<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermessionMethod extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];
    
	protected $fillable = ['method','has_rule'];

    public function permession()
    {
        return $this->belongsTo(Permession::class)->withTrashed();
    }

    public function users()
    {
    	return $this->permession->user;
    }
}
