<?php

namespace AhmedFathy\Helpers\Src;

class Btn
{
    public static function create($url = null,$attr = null)
    {
    	return view('helpers.btns.create',compact('url','attr'))->render();
    }

    public static function edit($id,$attr = null)
    {
    	return view('helpers.btns.edit',compact('id','url','attr'))->render();
    }
    public static function delete($options = null,$name = null)
    {
        return view('helpers.btns.delete',compact('options','name'))->render();
    }    

    public static function forceDelete($options = null,$name = null)
    {
        return view('helpers.btns.forceDelete',compact('options','name'))->render();
    } 
    public static function restoreAll($options = null,$name = null)
    {
    	return view('helpers.btns.restoreAll',compact('options','name'))->render();
    }    
    public static function view($id,$attr = null)
    {
        return view('helpers.btns.view',compact('id','attr'))->render();
    }    
    public static function viewTrash($id,$attr = null)
    {
    	return view('helpers.btns.viewTrash',compact('id','attr'))->render();
    }    

    public static function deleteAll($attr = null)
    {
        return view('helpers.btns.deleteAll',compact('attr'))->render();
    }

    public static function trashed($attr = null)
    {
        return view('helpers.btns.trashed',compact('attr'))->render();
    }

    public static function forceDeleteAll($attr = null)
    {
        return view('helpers.btns.forceDeleteAll',compact('attr'))->render();
    }

}
