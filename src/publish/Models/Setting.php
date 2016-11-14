<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at']; 
}
