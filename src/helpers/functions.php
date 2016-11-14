<?php
function isAssoc($arr){
    return array_keys($arr) !== range(0, count($arr) - 1);
}
function site($row=null,$lang=null)
{
    try {
            if (is_null($row)) 
            {
                    return @App\Setting::find(1);
                    
            }else{
                $query = App\Setting::find(1);
                if (!is_null($query)) 
                {
                    return $query->trans($row,$lang);
                }
            }
        } catch (\Exception $e) {
            
        }
    
}

function home($row=null,$lang=null)
{
    try {
            if (is_null($row)) 
            {
                    return @App\HomeSetting::find(1);
                    
            }else{
                $query = App\HomeSetting::find(1);
                if (!is_null($query)) 
                {
                    return $query->trans($row,$lang);
                }
            }
        } catch (\Exception $e) {
            
        }
    
}

function flug($lang = null)
{
    if (is_null($lang)) 
    {
    $lang = \App\Lang::where('code',app()->getLocale())->first();
    }else{
    $lang = \App\Lang::where('code',$lang)->first();
    }
    if (!file_exists(flugs_path.$lang->flug) || empty($lang->flug)) 
    {
        return flugs_url.'sa.png';
    }
    return flugs_url.$lang->flug;
}
function flugs()
{
   $flugs = glob(flugs_path.'*.png');
   $images = [];
    foreach ($flugs as $key => $flug) 
    {
        $flug_url = flugs_url.last(explode('/', $flug));
        $flug_file = last(explode('/', $flug));
         $images[$key]['url'] = $flug_url;
         $images[$key]['file'] = $flug_file;
    }
    return $images;
}

function langName($lang = null)
{
    if (is_null($lang)) 
    {
        return trans('lang_'.app()->getLocale());
    }else{
        return trans('lang_'.$lang);  
    }
}

function languages()
{
    $langsQuery = \App\Lang::all();
    $langs = [];
    foreach ($langsQuery as $value) 
    {
        
            $langs[$value->code]['name'] = $value->name;
            $langs[$value->code]['url'] = url('lang',$value->code);
            $langs[$value->code]['flug'] = flug($value->code);
            
    
    }

    return $langs;

}
function currentLang($value=null)
{
    $lang_query = \App\Lang::where('code',app()->getLocale());
    if ($lang_query->exists()) 
    {
        $lang = $lang_query->first();
    }else
    {
        $default_lang_query = \App\Lang::where('default',1);
        if ($default_lang_query->exists()) 
        {
            $lang = $default_lang_query->first();
        }else
        {
            $lang = \App\Lang::first();
        }
    }
    $langs = [];
    if (!array_key_exists($value,$langs)) 
        {
            $langs['name'] = $lang->name;
            $langs['url'] = url('lang',$lang->url);
            $langs['flug'] = flug($lang->code);
        }
        if (is_null($value)) 
        {
            return $langs;
        }else 
        {
            return $langs[$value];
        }
}
 
function updateLang(int $lang , string $colum,$trans)
{
    $trans = [
      'lang' => $lang,
      'colum' => $colum,
      'trans' => $trans,
        ];
      $checkTrans = $user->languages()->where($trans)->first();
      if (is_null($checkTrans)) 
      {
        $user->languages()->create($trans);
      }
    
    $language = App\Language::where([
        'lang'=>$lang,
        'extends'=>$extends,
        'parent'=>$parent,
        'colum'=>$colum
        ]);
    if ($language->exists()) 
    {
        $update = $language->first();
        $update->trans = strip_js($trans);
        $update->save();
    }else{

        $add = new App\Language;
        $add->parent = $parent;
        $add->extends = $extends;
        $add->lang = $lang;
        $add->colum = strip_js($colum);
        $add->trans = strip_js($trans);
        $add->save(); 
    }
    
    
}
function deleteLang($extends,$parent)
{
    @ App\Language::where([
        'extends'=>$extends,
        'parent'=>$parent
        ])->delete();
}
function langFiles($lang)
{
   $lang_files = glob(base_path('resources/lang/'.$lang.'/*.php'));
   $files = [];
    foreach ($lang_files as $key => $file) 
    {
        $file_name = last(explode('/', $file));
        $file_path = base_path('resources/lang/'.$lang.'/'.$file_name);
         $files[$key]['path'] = $file_path;
         $files[$key]['name'] = $file_name;
    }
    return $files;
}
function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }

        $d->close();
    }else {
        copy( $source, $target );
    }
}


function hasRule($rule = 'admin')
{
    if (auth()->check()) 
    {
        if ($rule == 'admin') 
        {
            if (auth()->user()->rule == 'admin') 
            {
                return true;
            }else
            {
                return false;
            }
        }else
        {
            if (auth()->user()->rule == $rule || auth()->user()->rule == 'admin') 
            {
                return true;
            }else
            {
                return false;
            }

        }
    }
}

function user($row=null)
{
    if (is_null($row)) 
    {
        return auth();
    }
    if (auth()->check()) 
    {
        return !is_null($row) ? auth()->user()->{$row} : auth()->user();
    } else {
        return $row;
    }
}

function admin($row=null)
{
    if (is_null($row)) 
    {
        return auth();
    }
    if (auth()->check()) 
    {
        return !is_null($row) ? auth()->user()->{$row} : auth()->user();
    } else {
        return $row;
    }
}

function client($row=null)
{
    if (is_null($row)) 
    {
        return auth()->guard('client');
    }
    if (auth()->guard('client')->check()) 
    {
        return !is_null($row) ? auth()->guard('client')->user()->{$row} : auth()->guard('client')->user();
    } else {
        return $row;
    }
}

 function getDir($style = false)
{
    $lang_query = \App\Lang::where('code',app()->getLocale());
    if ($lang_query->exists()) 
    {
        $dir = $lang_query->first()->direction;
    }else
    {
        $default_lang_query = \App\Lang::where('default',1);
        if ($default_lang_query->exists()) 
        {
            $dir = $default_lang_query->first()->direction;
        }else
        {
            $dir = 'rtl';
        }
    }
    if ($style == false) 
    {
        return $dir;
    }else{
        return $dir == 'ltr' ? '' : '-'.$dir;
    }
} 


function word_limit($string, $count, $ellipsis = null)
{
  $words = explode(' ', $string);
  if (count($words) > $count)
  {
    array_splice($words, $count);
    $string = implode(' ', $words);
    
      $string .= $ellipsis;
    
  }
  return $string;
}


function bsForm(){
    return new \bsForm;
}

function control(){
    return new \Control;
}

function sidebar(){
    return new \AhmedFathy\Helpers\Src\Sidebar();
}

function queryLists($model,$colum,$key =null,$options = []){
    $model = '\App\\'.ucfirst(str_singular(camel_case($model)));
    $array = [];
    if (isset($options['before'])) 
    {
        if (is_string($options['before'])) 
        {
            if (isAssoc($array)) 
            {
                $array[] = trans('lang.'.$options['before']);
            }else{
                $array[] = trans('lang.'.$options['before']);

            }
            # code...
        }elseif(is_array($options['before'])){
            foreach ($options['before']as $k => $v) 
            {
                $array[$k] = $v;
            }
        }
    }
    $query = $model::get();
    if (isset($options['except'])) 
    {
        $query = $query->except($options['except']);
    }
    foreach ($query as $row) 
    {
        if (is_null($key)) 
        {
            $array[] = $row->{$colum};
        }else{
            $array[$row->{$key}] = $row->{$colum};
        }
    }
    if (isset($options['after'])) 
    {
        if (is_string($options['after'])) 
        {
            if (isAssoc($array)) 
            {
                $array[''] = trans('lang.'.$options['after']);
            }else{
                $array[] = trans('lang.'.$options['after']);

            }
            # code...
        }elseif(is_array($options['after'])){
            foreach ($options['after']as $k => $v) 
            {
                $array[$k] = $v;
            }
        }
    }

    return collect($array);
}

function strip_js($html)
{
    $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
    return $html;
}
function getController()
{
    $controller = '\\'.Route::getCurrentRoute()->getActionName();

    $controller = explode('@',$controller)[0];

    // $controller = str_replace('App\Http\Controllers\\','',$controller);
    return $controller;

}
function getTable()
{
    $controller = '\\'.Route::getCurrentRoute()->getActionName();

    $controller = explode('@',$controller)[0];

    $controller = class_basename($controller);
    $controller = str_replace('Controller','',$controller);
    $controller = strtolower(str_plural(snake_case($controller)));
    return $controller;

}

function carbon()
{
    return new \Carbon\Carbon;
}


function public_url()
{
    $urls = func_get_args();
    if (isset($urls[0])) 
    {
        if (starts_with($urls[0],'public')) 
        {
            $urls[0] = explode('public/',$urls[0])[1];
        }
        if (starts_with($urls[0],'/public')) 
        {
            $urls[0] = explode('/public/',$urls[0])[1];
        }
    }
    $url = implode('/',$urls);
    $public = ends_with(url('/'), 'public') ? '' : 'public/';
    $url = str_replace('//','/',$url);
    return url($public.$url);
}

function root()
{
    $urls = func_get_args();
    if (isset($urls[0])) 
    {
        if (starts_with($urls[0],'public') && ends_with(url('/'), 'public')) 
        {
            $urls[0] = explode('public/',$urls[0])[1];
        }
        if (starts_with($urls[0],'/public')) 
        {
            $urls[0] = explode('/public/',$urls[0])[1];
        }
    }
    $url = implode('/',$urls);
    $url = str_replace('//','/',$url);
    return url($url);
}

function has_perm($action)
{
    if (auth()->user()->rule  == 'admin') 
    {
        return true;
    }

    try {
        $namespace = '\App\Http\Controllers\\';
        $controller = $namespace.explode('@',$action)[0];
        $method = explode('@',$action)[1];
        $query = auth()->user()->permessions()->where('controller',$controller)->first();
        if (!is_null($query)) 
        {
            $check_method = $query->methods()->where('method',$method)
               ->where('has_rule',true)->exists();
            return $check_method;
        } 
    } catch (\Exception $e) {
        return false;
    }

    return false;


}

function newsletter($extends,$row)
{
    if (site('send_newsletter')) 
    {
        foreach(\App\Newsletter::all() as $user)
        {
            if (view()->exists('emails.newsletter.'.$extends)) 
            {
                try {
                    Mail::send('emails.newsletter.'.$extends, ['row' => $row], function ($m) use ($user,$extends) {
                            $m->from(site('mail'), site('site_name'));
                            $m->to($user->email, trans('lang.User'));
                            $m->subject(site('site_name'));
                        });   
                } catch (\Exception $e) {
                    
                }
            }
        }
    }
}
