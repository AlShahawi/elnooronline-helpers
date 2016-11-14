<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];


    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function parent_cat()
    {
    	return $this->belongsTo(Category::class,'parent')->withTrashed();
    }    

    public function children()
    {
    	return $this->hasMany(Category::class,'parent');
    }
}
