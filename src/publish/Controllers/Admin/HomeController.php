<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->permession(__CLASS__);
        
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        return view('cpanel.layout.home');
    }

    public function search(Request $request)
    {
        $model = '\App\\'.ucfirst(camel_case(str_singular($request->type)));
        $view = 'cpanel.ajax.search.'.$request->type;
        $table = (new $model)->getTable();
        if (view()->exists($view)) 
        {
            $data = $model::where('id','>',0);
            $req = array_except($request->all(), ['_token','type']);
            foreach ($req as $key => $value) 
            {
                    if($request->has($key)){
                        if (\Schema::hasColumn($table, $key)) 
                        {
                          $data->where($key,'like','%'.$value.'%');  
                        }else{
                          $data->whereHas($key,function($query)use($value){
                            $query->where('name','like','%'.$value.'%');
                          });    
                        }
                        
                        
                    }
            }
            $data = $data->orderBy('id','desc')->get();
            return view($view,compact('data'))->render();
        }

    }

   
}
