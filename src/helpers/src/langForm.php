<?php

namespace AhmedFathy\Helpers\Src;
use Illuminate\Support\HtmlString;
class langForm 
{
	protected  $lang = '';
    public function __construct($id)
    {
        $this->lang = $id;
    }
    public  function text($name,$value=null,$attributes=null)
    {
        $lang_id = $this->lang;
        echo new HtmlString(view('helpers.langForm.text',compact('name','value','attributes','lang_id'))->render());
    }


    public  function textarea($name,$value=null,$attributes=null)
    {
        $lang_id = $this->lang;
    	echo new HtmlString(view('helpers.langForm.textarea',compact('name','value','attributes','lang_id'))->render());
    }



}
