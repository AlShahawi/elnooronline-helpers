<?php

namespace AhmedFathy\Helpers\Src;
use Illuminate\Support\HtmlString;
class bsForm 
{
    static $field = 0;
    public static function open($attributes=null)
    {
        return new HtmlString(view('helpers.bsForm.start',compact('attributes'))->render());
    } 

    public static function start($attributes=null)
    {
        return self::open($attributes);
    } 

    public static function end($options=null)
    {
    	return self::close($options);
    } 



    public static function close($options=null)
    {
    	return new HtmlString(view('helpers.bsForm.end',compact('options'))->render());
    } 



    public static function text($name,$value=null,$attributes=null)
    {
        return new HtmlString(view('helpers.bsForm.text',compact('name','value','attributes'))->render());
    }


    public static function textarea($name,$value=null,$attributes=null)
    {
    	return new HtmlString(view('helpers.bsForm.textarea',compact('name','value','attributes'))->render());
    }


    public static function number($name,$value=null,$attributes=null)
    {
        return new HtmlString(view('helpers.bsForm.number',compact('name','value','attributes'))->render());
    }

    public static function url($name,$value=null,$attributes=null)
    {
        return new HtmlString(view('helpers.bsForm.url',compact('name','value','attributes'))->render());
    }

    public static function password($name,$attributes=null)
    {
    	return new HtmlString(view('helpers.bsForm.password',compact('name','attributes'))->render());
    }


    public static function email($name,$value=null,$attributes=null)
    {
        return new HtmlString(view('helpers.bsForm.email',compact('name','value','attributes'))->render());
    }

    public static function time($name,$value=null,$attributes=null)
    {
    	return new HtmlString(view('helpers.bsForm.time',compact('name','value','attributes'))->render());
    }



    public static function checkbox($name,$value=null,$checked=null,$attributes = [])
    {
        return new HtmlString(view('helpers.bsForm.checkbox',compact('name','value','attributes','checked'))->render());
    }
    public static function radio($name,$value=null,$checked=null,$attributes = [])
    {
        return new HtmlString(view('helpers.bsForm.radio',compact('name','value','attributes','checked'))->render());
    }



    public static function birthday($values=null,$attributes=null)
    {
      return new HtmlString(view('helpers.bsForm.birthday',compact('values','attributes'))->render());
    }

    public static function select($name,$options,$value=null,$attributes=null)
    {
      return new HtmlString(view('helpers.bsForm.select',compact('name','options','value','attributes'))->render());
    }
    public static function deleteSelect($id=null)
    {
      return new HtmlString(view('helpers.bsForm.deleteSelect',compact('id'))->render());
    }
    public static function forceDeleteSelect($id=null)
    {
      return new HtmlString(view('helpers.bsForm.forceDeleteSelect',compact('id'))->render());
    }

    public static function image($name=null,$url=null)
    {
      return new HtmlString(view('helpers.bsForm.image',compact('name','url'))->render());
    }

    public static function deleteAllSelect()
    {
      return new HtmlString(view('helpers.bsForm.deleteAll')->render());
    }
    
    public static function forceDeleteAllSelect()
    {
      return new HtmlString(view('helpers.bsForm.forceDeleteAll')->render());
    }
    
    public static function translate($callback)
    {
        self::$field++;
        $field = self::$field;
        if (is_callable($callback)) 
        {
            return new HtmlString(view('helpers.bsForm.translate',compact('callback','field'))->render());
        }
    }

    public static function file($files = [],$input = null,$label = null)
    {
      return new HtmlString(view('helpers.bsForm.file',compact('label','files','input'))->render());
    }
    public static function files($files = [],$input = null,$label = null)
    {
      return new HtmlString(view('helpers.bsForm.files',compact('label','files','input'))->render());
    }
    

}
