<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;
use App\City;
class UserController extends Controller
{
    public function __construct()
    {
        $this->permession(__CLASS__);
        resourceBreadcrumbs('user',function($user){
            return $user->name;
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $users = \App\User::where('rule','!=','admin')->get();
        $admins = \App\User::where('rule','admin')->orderBy('id','desc')->get();
        return control()->index('user',null,compact('users','admins'));   
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return control()->create('user');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'phone' => 'required|numeric',
                    'rule' => 'required',
                    ]);

        return control()->store($request,'user',[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'rule' => $request->rule,
            'gender' => $request->gender,
            'info' => $request->info,
            ],cp.'users',function($user,$files){
                foreach($files as $file)
                {
                    $user->files()->attach([$file->id =>['input'=> 'profile']]);
                    $file = $file->resize(100,100);
                    $user->files()->attach([$file->id =>['input'=> 'sm']]);
                    $file = $file->resize(300,300);
                    $user->files()->attach([$file->id =>['input'=> 'md']]);
                }
            });
    }

     public function getEditProfile()
    {
        return view('cpanel.users.edit_profile');
    }

    public function postEditProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'min:6|confirmed',
            'phone' => 'required|numeric',
            ]);
        $id = auth()->user()->id;
        $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'info' => $request->info,
                ];

        if ($request->has('pasword')) 
        {
            $data['password'] = bcrypt($request->password);
        }

        return control()->update($request,$id,'user',$data,null,function($user,$files){
                $user->files()->detach();
                foreach($files as $file)
                {
                    $user->files()->attach([$file->id =>['input'=> 'profile']]);
                    $file = $file->resize(100,100);
                    $user->files()->attach([$file->id =>['input'=> 'sm']]);
                    $file = $file->resize(300,300);
                    $user->files()->attach([$file->id =>['input'=> 'md']]);
                }
            });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return control()->show('user',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return control()->edit('user',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'min:6|confirmed',
            'phone' => 'required|numeric',
            'rule' => 'required',
            ]);
        return control()->update($request,$id,'user',[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'rule' => $request->rule,
            'gender' => $request->gender,
            'info' => $request->info,
            ],cp.'users',function($user,$files){
                $user->files()->detach();
                foreach($files as $file)
                {
                    $user->files()->attach([$file->id =>['input'=> 'profile']]);
                    $file = $file->resize(100,100);
                    $user->files()->attach([$file->id =>['input'=> 'sm']]);
                    $file = $file->resize(300,300);
                    $user->files()->attach([$file->id =>['input'=> 'md']]);
                }
            });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return control()->delete($request,$id,'user');
    }


    public function permession_update(Request $request, $id)
    {
        $data = array_except($request->all(), ['_method','_token']);
        $user = \App\User::find($id);
        foreach ($user->permessions as $permession) 
        {
            foreach ($permession->methods as $method) 
            {
                if ($request->has($permession->controller.'_'.$method->method)) 
                {
                    $method->has_rule = true;
                }else{
                    $method->has_rule = false;
                    
                }
                    $method->save();
            }
        }
        session()->flash('success',trans('lang.system_updated'));
        return back();
        
        
    }
    public function showTrashed($id)
    {
        return \Control::showTrashed('user',$id);
    }
    
    public function getTrashed()
    {
        $users = \App\User::onlyTrashed()->where('rule','!=','admin')->get();
        $admins = \App\User::onlyTrashed()->where('rule','admin')->orderBy('id','desc')->get();
        return control()->getTrashed('user',null,compact('users','admins')); 
    }

    public function forceDeleteOrRestore(Request $request, $id = null)
    {
        return \Control::forceDeleteOrRestore($request,$id,'user');
    }
}
