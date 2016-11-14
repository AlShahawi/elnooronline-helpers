<?php 
namespace AhmedFathy\Helpers\Src;
/**
* 
*/
use Illuminate\Http\Request;

class Control
{

  public static function index($name ,$view = null , $compact = [],$callback = null)
  {
    if (is_null($view)) 
    {
      $view = 'cpanel.'.strtolower(str_plural($name)).'.index';
    }

    $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
    $row = $model::orderBy('id','desc')->get();
      if (is_callable($callback)) 
      {
        $row = call_user_func_array($callback, [$row]);
      }
    
      if (count($compact) == 0) 
      {
        $compact = [strtolower(str_plural($name)) => $row];
      }
      return view($view,$compact);
  }
  public static function getTrashed($name ,$view = null , $compact = [],$callback = null)
  {
    if (is_null($view)) 
    {
      $view = 'cpanel.'.strtolower(str_plural($name)).'.trashed';
    }

    $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
    $row = $model::onlyTrashed()->orderBy('id','desc')->get();
      if (is_callable($callback)) 
      {
        $row = call_user_func_array($callback, [$row]);
      }
    
      if (count($compact) == 0) 
      {
        $compact = [strtolower(str_plural($name)) => $row];
      }
      return view($view,$compact);
  }

  public static function create($name ,$view = null , $compact = [])
  {
    if (is_null($view)) 
    {
      $view = 'cpanel.'.strtolower(str_plural($name)).'.create';
    }

      return view($view,$compact);
  }


  public static function show($name , $id , $view = null , $compact = [])
  {
    // \Notfication::see($name,$id);
    // \Notfication::read($name,$id);
    if (is_null($view)) 
    {
      $view = 'cpanel.'.strtolower(str_plural($name)).'.show';
    }

    $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
    $row = $model::where('id',$id);

    if ($row->exists()) 
    {
      if ($row->first()->notfication) {
        $row->first()->notfication->read();
      }
      $compact = array_add($compact, strtolower(str_singular($name)), $row->first());

      return view($view,$compact);
    }else{
      return view('helpers.main_error404');
    }
  }

  public static function showTrashed($name , $id , $view = null , $compact = [])
  {

    if (is_null($view)) 
    {
      $view = 'cpanel.'.strtolower(str_plural($name)).'.show_trashed';
    }

    $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
    $row = $model::onlyTrashed()->where('id',$id);

    if ($row->exists()) 
    {
      if ($row->first()->notfication) {
        $row->first()->notfication->read();
      }
      $compact = array_add($compact, strtolower(str_singular($name)), $row->first());

      return view($view,$compact);
    }else{
      return view('helpers.main_error404');
    }
  }

  public static function edit($name , $id , $view = null , $compact = [])
  {
    if (is_null($view)) 
    {
      $view = 'cpanel.'.strtolower(str_plural($name)).'.edit';
    }

    $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
    $row = $model::where('id',$id);
    if ($row->exists()) 
    {
        $compact = array_add($compact, strtolower(str_singular($name)), $row->first());
      
      return view($view,$compact);
    }else{
      return view('helpers.main_error404');
    }
  }
   public static function store(Request $request ,$name,$data=[],$redirect=null,$calback=null)
   {

       $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
       if (isset($data['translate'])) 
       {
          foreach ($data['translate'] as $k => $field) 
          {
              foreach (\App\Lang::all() as $lang) 
              {
                  if (is_string($k)) 
                  {
                    $data['lang'][$k.'-'.$lang->id] = $field;
                  }elseif(is_numeric($k))
                  {
                    $transField = $field.$lang->id;
                    $data['lang'][$field.'-'.$lang->id] = $request->{$transField};
                  }
              }
          }
       }
       $create = new $model;
            $currentLang = \App\Lang::where('code',app()->getLocale())->first();
             if (is_null($currentLang)) {
              $currentLang = \App\Lang::all()->first();
             }
            if (isset($data['translate'])) 
            {
              foreach ($data['translate'] as $k => $trans) 
              {
                if (is_string($k)) 
                {
                  $data[$k] = $trans;
                }elseif(is_numeric($k))
                {
                  $data[$trans] = $request->{$trans.$currentLang->id};
                }
              }
            }           
           $script = false;
            if (isset($data['script'])) 
            {
               $script = $data['script'];
            }
           foreach (array_except($data, ['translate','lang','files','script']) as $key => $value) 
           {
              if (is_numeric($key))
              {
                if ($key == 'password'){

                $create->{$key} = bcrypt($request->{$key});
                }else{
                $create->{$key} = $script ? $request->{$key} : strip_js($request->{$key}); 
                }
              }else{
                $create->{$key} = $script ? $value : strip_js($value);
              }
           }
       $create->save();
          if (isset($data['lang'])) 
          {
             foreach ($data['lang'] as $key => $value) 
             {
              $colum = explode('-', $key)[0];
              $lang = explode('-', $key)[1];
              $create->translate($lang,$colum,$value);
             }
          }
        $id = $create->id;
        $uploadedfiles = [];
        if ($request->has('uploadedfiles')) 
        {
          $uploadedfiles = $request->uploadedfiles;
        }
        
        if (isset($data['files'])) 
        {
           \Files::upload($request,$create,$data['files']);
        }

        session()->flash('success',trans('lang.added',['var'=>trans('lang.'.$name)]));

       if (is_callable($calback)) 
        {
          $files = \App\File::whereIn('id',$uploadedfiles)->get();
          
           call_user_func_array($calback,[$create,$files]);
        }
        $extends = strtolower(str_singular(snake_case($name)));
          newsletter($extends,$create);

        if (is_null($redirect)) 
        {
            return back();
        }else
        {
            return redirect($redirect);
        }
   }
   public static function update(Request $request,$id,$name,$data=[],$redirect=null,$calback=null)
   {
      if (isset($data['translate'])) 
       {
          foreach ($data['translate'] as $k => $field) 
          {
              foreach (\App\Lang::all() as $lang) 
              {
                  if (is_string($k)) 
                  {
                    $data['lang'][$k.'-'.$lang->id] = $field;
                  }elseif(is_numeric($k))
                  {
                    $transField = $field.$lang->id;
                    $data['lang'][$field.'-'.$lang->id] = $request->{$transField};
                  }
              }
          }
       }
       $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
       $create = $model::find($id);
             $currentLang = \App\Lang::where('code',app()->getLocale())->first();
             if (is_null($currentLang)) {
              $currentLang = \App\Lang::all()->first();
             }
             if (is_null($currentLang)) {
              $currentLang = \App\Lang::all()->first();
             }
            if (isset($data['translate'])) 
            {
              foreach ($data['translate'] as $k => $trans) 
              {
                if (is_string($k)) 
                {
                  $data[$k] = $trans;
                }elseif(is_numeric($k))
                {
                  $data[$trans] = $request->{$trans.$currentLang->id};
                }
              }
            }
            $script = false;
            if (isset($data['script'])) 
            {
               $script = $data['script'];
            }
           foreach (array_except($data, ['translate','lang','files','script']) as $key => $value) 
           {
              if (is_numeric($key))
              {
                if ($key == 'password'){

                $create->{$key} = bcrypt($request->{$key});
                }else{
                $create->{$key} = $script ? $request->{$key} : strip_js($request->{$key}); 
                }
              }else{
                $create->{$key} = $script ? $value : strip_js($value);
              }
           }
       $create->save();
       if (isset($data['lang'])) 
          {
             foreach ($data['lang'] as $key => $value) 
             {
              $colum = explode('-', $key)[0];
              $lang = explode('-', $key)[1];
              $create->translate($lang,$colum,$value);
             }
          }
        session()->flash('success',trans('lang.updated',['var'=>trans('lang.'.$name)]));
        $uploadedfiles = [];
        if ($request->has('uploadedfiles')) 
        {
          $uploadedfiles = $request->uploadedfiles;


        }
        if (isset($data['files'])) 
        {
          
          \Files::update($request,$create,$data['files']);
          
        }
       if (is_callable($calback)) 
        {
          $create->files()->detach();
          $files = \App\File::whereIn('id',$uploadedfiles)->get();
          
           call_user_func_array($calback,[$create,$files]);
        }

        if (is_null($redirect)) 
        {
            return back();
        }else
        {
            return redirect($redirect);
        }
   }
   public static function delete(Request $request  ,$id = null,$name,$calback = null){
      return self::destroy($request,$id,$name,$calback); 
   }

   public static function destroy(Request $request  ,$id = null,$name,$calback = null){
    $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
    if ($id == null && !$request->has('delete')) 
        {
            session()->flash('error',trans('lang.no_data_selected'));
           
            
           return back(); 
        }
        
        if ($id != null) 
        {
          $row = $model::find($id);
           session()->flash('success',trans('lang.deleted',['var'=>trans('lang.'.$name)]));
           if (is_callable($calback)) 
              {
                  call_user_func_array($calback,[$row]);
              }
           $row->delete();
        }
        if ($request->has('delete')) 
        {
            foreach ($request->input('delete') as $value) 
            {
              $row = $model::find($value);
      session()->flash('success',trans('lang.deleted',['var'=>trans('lang.'.str_plural(strtolower($name)))]));
              if (is_callable($calback)) 
              {
                  call_user_func_array($calback,[$row]);
              }
               $row->delete();
            }
        }
        
        return back();
}

public static function forceDeleteOrRestore(Request $request  ,$id = null,$name,$calback = null){
    $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
    if ($id == null && !$request->has('delete_or_restore')) 
        {
            session()->flash('error',trans('lang.no_data_selected'));
           
            
           return back(); 
        }
        
        if ($id != null) 
        {
          $row = $model::onlyTrashed()->where('id',$id)->first();
           session()->flash('success',trans('lang.deleted',['var'=>trans('lang.'.$name)]));
           if (is_callable($calback)) 
              {
                  call_user_func_array($calback,[$row]);
              }
            if (!$request->has('restore')) 
            {
                $row->languages()->forceDelete();
              foreach ($row->options as $option) 
              {
                  $option->options()->forceDelete();
              }
              $row->options()->forceDelete();
              \Files::delete($row,$id);
              $row->forceDelete();
            }else
            {
              foreach ($row->options as $option) 
              {
                  $option->options()->restore();
              }
              $row->restore();
              session()->flash('success',trans('lang.restored',['var'=>trans('lang.'.str_plural(strtolower($name)))]));
            }
        }
        if ($request->has('delete_or_restore')) 
        {
            foreach ($request->input('delete_or_restore') as $value) 
            {
              $row = $model::onlyTrashed()->where('id',$value)->first();
      session()->flash('success',trans('lang.deleted',['var'=>trans('lang.'.str_plural(strtolower($name)))]));
              if (is_callable($calback)) 
              {
                  call_user_func_array($calback,[$row]);
              }

                if (!$request->has('restore')) 
                {
                    $row->languages()->forceDelete();
                  \Files::delete($row,$id);
                  $row->forceDelete();
                }else
                {
                  
                  $row->restore();
                  session()->flash('success',trans('lang.restored',['var'=>trans('lang.'.str_plural(strtolower($name)))]));
                }
            }
        }
        
        return back();
}

public static function seed($name,$data=[],$calback=null)
   {

       $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
       
           if (isset($data['translate'])) 
           {
              foreach ($data['translate'] as $k => $field) 
              {
                  foreach (\App\Lang::all() as $lang) 
                  {
                      
                        $data['lang'][$k.'-'.$lang->id] = $field;
                      
                  }
              }
           }
           $create = new $model;
                $currentLang = \App\Lang::where('code',app()->getLocale())->first();
             if (is_null($currentLang)) {
              $currentLang = \App\Lang::all()->first();
             }
                if (isset($data['translate'])) 
                {
                  foreach ($data['translate'] as $k => $trans) 
                  {
                      $data[$k] = $trans;
                  }
                }  
                if ($model::where(array_except($data, ['translate','lang','files','password']))->count() < 1) 
       {         
               foreach (array_except($data, ['translate','lang','files']) as $key => $value) 
               {
                  $create->{$key} = $value;
               }
           $create->save(); 
              if (isset($data['lang'])) 
              {
                 foreach ($data['lang'] as $key => $value) 
                 {
                  $colum = explode('-', $key)[0];
                  $lang = explode('-', $key)[1];
                  $create->translate($lang,$colum,$value);
                 }
              }
            $id = $create->id;
            session()->flash('success',trans('lang.added',['var'=>trans('lang.'.$name)]));
           if (is_callable($calback)) 
            {

               call_user_func_array($calback,[$create]);
            }
            $extends = strtolower(str_singular(snake_case($name)));
            newsletter($extends,$create);
       }
   }

public static function order($req,$name,$parent=0,$parentName = 'parent')
    {
      $data =  is_string($req) ? json_decode($req,true) : $req;
      $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
        foreach ($data as $key => $value) 
        {
            $row = $model::find($value['id']);
            $row->{$parentName} = $parent;
            $row->order = $key;
            $row->save();
            if (!empty($value['children']) && is_array($value['children'])) 
            {
                self::order($value['children'],$name,$value['id'],$parentName);
            }
        }
    }

  public static function orderHtml($name,$parentName,$parent = 0,$position=null,$country_colum = null,$country_id = 1)
  {
    $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
    $rows = $model::where($parentName,$parent)->orderBy('order','asc');
    if (!is_null($position)) 
    {
    $rows = $model::where($parentName,$parent)->where('position',$position)->orderBy('order','asc');
      
    }
    if (!is_null($country_colum)) 
    {
    $rows->where($country_colum,$country_id);
      
    }
    $rows = $rows->get();
    return view('helpers.order',compact('rows','name','parentName','parent'))->render();
  }

  public static function mainOrderHtml($name,$parentName,$parent = 0,$position=null,$country_colum = null,$country_id = 1)
  {
    $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
    $rows = $model::where($parentName,$parent)->orderBy('order','asc');
    if (!is_null($position)) 
    {
    $rows = $model::where($parentName,$parent)->where('position',$position)->orderBy('order','asc');
    }
    if (!is_null($country_colum)) 
    {
    $rows->where($country_colum,$country_id);
      
    }
    $rows = $rows->get();
    return view('helpers.main_order',compact('rows','name','parentName','parent','position'))->render();
  }
  public static function comments($extends)
  {
    return view('helpers.comments',compact('extends'))->render();
  }

}
