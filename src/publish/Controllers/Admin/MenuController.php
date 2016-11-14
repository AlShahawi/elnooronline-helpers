<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->permession(__CLASS__);
        
        resourceBreadcrumbs('menu',function($menu){
            return $menu->page->name;
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return control()->index('menu');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages_query = \App\Page::where('active',1)->orderBy('id','desc')->get();
        $pages = [];
        foreach ($pages_query as $page) 
        {
           $pages[$page->id] = $page->trans('name'); 
        }
        return control()->create('menu',null,compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['page'=>'required'],[],['page'=>trans('lang.page')]);

        return control()->store($request,'menu',[
            'position' => $request->position,
            'page_id' => $request->page,
            'icon' => $request->has('icon') ? $request->icon : '',
            ],cp.'menus');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = \App\Menu::find($id);
        return redirect(cp.'pages/'.$menu->page->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages_query = \App\Page::where('active',1)->orderBy('id','desc')->get();
        $pages = [];
        foreach ($pages_query as $page) 
        {
           $pages[$page->id] = $page->trans('name'); 
        }
        return control()->edit('menu',$id,null,compact('pages'));
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
        $this->validate($request,['page'=>'required'],[],['page'=>trans('lang.page')]);

        return control()->update($request,$id,'menu',[
            'position' => $request->position,
            'page_id' => $request->page,
            'icon' => $request->has('icon') ? $request->icon : '',
            ],cp.'menus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return control()->delete($request,$id,'menu');
    }

    public function order(Request $request)
    {
        $data = json_decode($request->data,true);
        return control()->order($data,'menu',0);
    }

    public function showTrashed($id)
    {
        $menu = \App\Menu::onlyTrashed()->where('id',$id)->first();
        return redirect(cp.'pages/'.$menu->page->id);

    }
    public function getTrashed()
    {

        return \Control::getTrashed('menu');
    }
    public function forceDeleteOrRestore(Request $request, $id = null)
    {
        return \Control::forceDeleteOrRestore($request,$id,'menu');
    }
}
