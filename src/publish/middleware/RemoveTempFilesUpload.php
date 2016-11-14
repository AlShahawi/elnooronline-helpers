<?php

namespace App\Http\Middleware;

use Closure;

class RemoveTempFilesUpload
{
    protected $fileManagerAuthers = ['\App\User'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       //  if (!is_dir(public_path('upload'))) 
       // {
       //     mkdir(public_path('upload'));
       // }
       //  $array = scandir(public_path('upload'));

       //  if (count($array) > 2) 
       //  {
       //      for ($i=2; $i < count($array); $i++) 
       //      { 
       //          $file_path = public_path('upload').'/'.$array[$i];
       //          $file_name = 'public/upload/'.$array[$i];
       //          if (is_file($file_path)) 
       //          {
       //              $check = \App\File::where('path',$file_name)->get();
       //              if (count($check)  == 0) 
       //              {
       //                  @unlink($file_path);
       //              }else{
       //                  foreach ($check as $image) 
       //                  {
       //                      $query = '\App\\'.ucfirst(str_singular(camel_case($image->filable_type)));
       //                      $query = $query::find($image->filable_id);
       //                      if (is_null($query)) 
       //                      {
       //                          $image->delete();
       //                          @unlink($file_path);
       //                      }
       //                  }
       //              }
       //          }
       //          elseif(is_dir($file_path))
       //          {
       //              $id = $array[$i];
       //              foreach ($this->fileManagerAuthers as $model) 
       //              {
       //                  $check = $model::find($id);
       //                  if (is_null($check)) 
       //                  {
       //                      $this->rrmdir($file_path);
       //                  }
       //              }

       //          }
       //      }
       //  }
      
      // foreach (\App\Temp::where('created_at','<=',carbon()->subHours(3))->get() as $file) 
      // {
      //   if (file_exists(base_path($file->path))) 
      //   {
      //       @unlink(base_path($file->path));
      //   }
      //   $file->delete();
      // }
        return $next($request);
    }


    public function rrmdir($dir)
    {
        if (is_dir($dir)) 
      {
        $objects = scandir($dir);
        foreach ($objects as $object) {
          if ($object != "." && $object != "..") 
          {
            if (filetype($dir."/".$object) == "dir") 
               $this->rrmdir($dir."/".$object); 
            else unlink   ($dir."/".$object);
          }
        }
        reset($objects);
        rmdir($dir);
      }
    }
}
