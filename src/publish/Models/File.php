<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['name','type','path','width','height'];

    public function filable()
    {
    	return $this->morphTo();
    }

    public function categories()
    {
    	return $this->morphedByMany(Category::class,'filable');
    }

    public function resize($w = null,$h = null,$ext = null)
    {
    	$output = $this;
    	if (str_contains($this->type,'image')) 
    	{
	    	$ext = !is_null($ext) ? $ext : 'png';
	    	$path = 'public/upload/'.uniqid().'.'.$ext;
	    	$data = [
	            'path' => $path,
	            'name' => $this->name,
	            'type' => $this->type,
	            'width' => $this->width,
	            'height' => $this->height,
	            ];	            
	    	$img = \Image::make(base_path($this->path));

	        if($img->width() != $w || $img->height() != $h)
	        {
	        	if (is_null($w) || is_null($h)) 
	        	{
		        	$img->resize($w, $h, function ($constraint) {
					    $constraint->aspectRatio();
					});
	        	}else{
	        		$img->resize($w, $h);
	        	}
					$data['width'] = $img->width();
					$data['height'] = $img->height();

			            $img->save(base_path($path));
				    	$output =  File::create($data);

	        }
	    	
    	}
    	return $output;
    }
}
