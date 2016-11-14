<?php
namespace AhmedFathy\Helpers\Relation;
trait FilesRelation{
    
    public function file()
    {
        return $this->morphToMany('App\File','filable')->first();
    }

    public function files()
    {
        return $this->morphToMany('App\File','filable')->withPivot('input')->withTimestamps();
    }

    public function image($input = null, $fallback = null)
    {
        $img = $fallback;
        if (is_null($input) && is_null($fallback)) 
        {
            if ($this->file() && file_exists(base_path($this->file()->path))) 
            {
                $img = root($this->file()->path);
            }
            else{
                $img = $fallback;
            }
        }

        if (!is_null($input)) 
        {
            $file = $this->files()->where('filables.input',$input)->first();
            if (!is_null($file) > 0 && file_exists(base_path($file->path))) 
            {
                $img = root($file->path);
            }
            else{
                $img = $fallback;
            }
        }

        if (!is_null($fallback) && is_null($img)) 
        {
            $img = $fallback;
        }

        return $img;
    }

    public function images($input = null)
    {
        $img = [];
        if (is_null($input)) 
        {
             $files = $this->files;
            if (count($files) > 0) 
            {
                foreach ($files as $file) 
                {
                    if (file_exists(base_path($file->path))) 
                    {
                        $img[$file->id] = root($file->path);
                    }
                }
            }
        }

        if (!is_null($input)) 
        {
            $files = $this->files()->where('filables.input',$input);
            if ($files->exists()) 
            {
                foreach ($files->get() as $file) 
                {
                    if (file_exists(base_path($file->path))) 
                    {
                        $img[] = root($file->path);
                    }
                }
            }
        }

        return collect($img);
    }

    public function img($input = null)
    {
        $img = config('fallback_images.'.$this->getTable()) ?
                public_url(config('fallback_images.'.$this->getTable())) : public_url(config('fallback_images.all')) ;
        if (is_null($input)) 
        {
            if ($this->file() && file_exists(base_path($this->file()->path))) 
            {
                $img = root($this->file()->path);
            }
        }

        if (!is_null($input)) 
        {
            $file = $this->files()->where('filables.input',$input)->first();
            if (!is_null($file) > 0 && file_exists(base_path($file->path))) 
            {
                $img = root($file->path);
            }
        }

        return $img;
    }
    public function getImage($input = null)
    {
        if (is_null($input)) 
        {
            if ($this->file()) 
            {
                $img = $this->file();
            }
        }

        if (!is_null($input)) 
        {
            $file = $this->files()->where('filables.input',$input)->first();
            
                $img = $file;
            
        }

        return $img;
    }

    public function getImages($input = null)
    {
        if (is_null($input)) 
        {
            if ($this->files) 
            {
                $imgs = $this->files;
            }
        }

        if (!is_null($input)) 
        {
            $file = $this->files()->where('filables.input',$input)->get();
            
                $imgs = $file;
            
        }
        return $imgs;
    }

}