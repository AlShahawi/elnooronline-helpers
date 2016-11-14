<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->permession(__CLASS__);

        resourceBreadcrumbs('category',function($category){
            return !is_null($category) ? $category->trans('name') : '';
        });
    }

    public function index()
    {
        return \Control::index('category');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'translate' => [
                'name' => 'required',
                'info' => 'required',
            ],
        ]);
        return \Control::store($request,'category',[
            'translate' => ['name','info'],
            'icon'=>$request->icon,
            ],cp.'categories',function($category,$files) use($request){
                $category->notfications()->create([
                    'sender_id' => user('id'),
                    'type' => 'new_category_by',
                    
                    ]);
                app('pusher')->trigger('notfications', 'new', []);
                foreach($files as $file)
                {
                    $file = $file->resize(50,50);
                    $category->files()->attach([$file->id =>['input'=> 'icon']]);
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
        return \Control::show('category',$id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = \App\Category::find($id);
        return \Control::edit('category',$id);
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
            'translate' => [
                'name' => 'required',
                'info' => 'required',
            ],
        ]);
        return \Control::update($request,$id,'category',[
            'translate' => ['name','info'],
            'icon'=>$request->icon,
            ],cp.'categories',function($category,$files) use($request){
                foreach($files as $file)
                {
                    $file = $file->resize(50,50);
                    $category->files()->attach([$file->id =>['input'=> 'icon']]);
                }   
            });
    }
    
    public function destroy(Request $request, $id = null)
    {
        return \Control::destroy($request,$id,'category');
    }

    public function order(Request $request)
    {
        return \Control::order($request->data,'category',0);
    }

    public function showTrashed($id)
    {
        return \Control::showTrashed('category',$id);
    }
    public function getTrashed()
    {

        return \Control::getTrashed('category');
    }
    public function forceDeleteOrRestore(Request $request, $id = null)
    {
        return \Control::forceDeleteOrRestore($request,$id,'category');
    }

}
