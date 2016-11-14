<?php 
namespace AhmedFathy\Helpers\Src\Files;

/**
* 
*/
use Illuminate\Http\Request;
use App\File;
class Files
{
	public static function upload(Request $req,$model,$inputs = [])
  {
   
 
    if (isAssoc($inputs)) 
    {
      foreach ($inputs as $input => $dir) 
      {
        if ($req->hasFile($input)) 
        {

        $files = $req->file($input);
        if (!is_dir(base_path($dir))) 
        {
            mkdir(base_path($dir));
        }
          if (is_array($files)) 
          {
              foreach ($files as $value) 
              {
                $fileName = uniqid($model->getTable()).'.'.$value->getClientOriginalExtension();
                $value->move(base_path($dir),$fileName);
                $model->files()->create([
                    'input' => strip_js($input),
                    'path' => $dir.'/'.$fileName,
                  ]);
              }
            
          }else{
              if (!is_null($files))
              {
              $fileName = uniqid($model->getTable()).'.'.$files->getClientOriginalExtension();
             
              $files->move(base_path($dir),$fileName);
                  $model->files()->create([
                    'input' => strip_js($input),
                    'path' => $dir.'/'.$fileName,
                  ]); 

              } 
          }
        }
      }
    }else{
      foreach ($inputs as $input) 
      {
        if ($req->hasFile($input)) 
        {
        $files = $req->file($input);
        $dir = 'public/upload';
        if (!is_dir(base_path($dir))) 
        {
            mkdir(base_path($dir));
        }
        
          if (is_array($files)) 
          {
              foreach ($files as $value) 
              {
                if (!is_null($value)) 
                {
                    $fileName = uniqid($model->getTable()).'.'.$value->getClientOriginalExtension();
                    $value->move(base_path($dir),$fileName);
                   $model->files()->create([
                    'input' => strip_js($input),
                    'path' => $dir.'/'.$fileName,
                  ]);
                }
               }
            
          }else{
              $fileName = uniqid($model->getTable()).'.'.$files->getClientOriginalExtension();
             
              $files->move(base_path($dir),$fileName);
              $model->files()->create([
                    'input' => strip_js($input),
                    'path' => $dir.'/'.$fileName,
                  ]);
          }

          
        }
      }
    }

  }	
	public static function update(Request $req,$model,$inputs = [])
  {

    if (isAssoc($inputs)) 
    {
      foreach ($inputs as $input => $dir) 
      {
        if ($req->hasFile($input)) 
        {
          if (config('upload_files.delete_files_on_update')) 
          {
          self::delete($model,$input);
          }
        $files = $req->file($input);
        if (!is_dir(base_path($dir))) 
        {
            mkdir(base_path($dir));
        }
          if (is_array($files)) 
          {
              foreach ($files as $value) 
              {
                $fileName = uniqid($model->getTable()).'.'.$value->getClientOriginalExtension();
                $value->move(base_path($dir),$fileName);
                
                $model->files()->create([
                    'input' => strip_js($input),
                    'path' => $dir.'/'.$fileName,
                  ]);
              }
            
          }else{
              $fileName = uniqid($model->getTable()).'.'.$files->getClientOriginalExtension();
             
              $files->move(base_path($dir),$fileName);
              
              $model->files()->create([
                    'input' => strip_js($input),
                    'path' => $dir.'/'.$fileName,
                  ]);
          }
        }
      }
    }else{
      foreach ($inputs as $input) 
      {
        if ($req->hasFile($input)) 
        {
          if (config('upload_files.delete_files_on_update')) 
          {
          self::delete($model,$input);
          }
        $files = $req->file($input);
        $dir = 'public/upload';
        if (!is_dir(base_path($dir))) 
        {
            mkdir(base_path($dir));
        }
        
          if (is_array($files)) 
          {
              foreach ($files as $value) 
              {
                $fileName = uniqid($model->getTable()).'.'.$value->getClientOriginalExtension();
                $value->move(base_path($dir),$fileName);
                
                $model->files()->create([
                    'input' => strip_js($input),
                    'path' => $dir.'/'.$fileName,
                  ]);
              }
            
          }else{
              $fileName = uniqid($model->getTable()).'.'.$files->getClientOriginalExtension();
             
              $files->move(base_path($dir),$fileName);
              
              $model->files()->create([
                    'input' => strip_js($input),
                    'path' => $dir.'/'.$fileName,
                  ]); 
          }

          
        }
      }
    }

    
  }

	public static function delete($model,$input = null)
  {
    if (!is_null($input)) 
    {
      if ($model->files()->where('input',$input)->count() > 0) 
       {
           $imgs = $model->files()->where('input',$input)->get();
           foreach ($imgs as $img) 
           {
               if(file_exists(base_path($img->path)))
               {
                unlink(base_path($img->path));
                $model->files()->where('input',$input)->delete();
               }
           }
       }  
    }else{

    if ($model->files()->count() > 0) 
         {
             $imgs = $model->files;
             foreach ($imgs as $img) 
             {
                 if(file_exists(base_path($img->path)))
                 {
                  unlink(base_path($img->path));
                  $model->files()->delete();
                 }
             }
         }    
      
    }
  }


}











