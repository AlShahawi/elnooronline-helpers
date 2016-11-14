<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->permession(__CLASS__);
        
        
        resourceBreadcrumbs('page',function($page){
            return $page->name;
        });
    }
    
    public function index()
    {
        return \Control::index('page'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('page');
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
            'translate'=>[
                'name' => 'required',
            ]]);

            return \Control::store($request,'page',[
                'urlname' => strtolower(str_slug($request->urlname)),
                'keywords' => $request->keywords,
                'out_url' => $request->out_url,
                'active' => $request->has('active') ? 1 : 0,
                'translate'=>['name','content']
                ],cp.'pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = \App\Page::find($id);
        foreach ($page->comments as $comment) 
        {
            if ($comment->notfication) {
                $comment->notfication->read();
            }
            foreach ($comment->replays as $replay) 
            {
                if ($replay->notfication) {
                    $replay->notfication->read();
                }
                
            }
        }
        return \Control::show('page',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Control::edit('page',$id);
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
            'translate'=>[
                'name.ar' => 'required',
            ]]);

            return \Control::update($request,$id,'page',[
                'urlname' => strtolower(str_slug($request->urlname)),
                'keywords' => $request->keywords,
                'out_url' => $request->out_url,
                'active' => $request->has('active') ? 1 : 0,
                'translate'=>['name','content']
                ],cp.'pages');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {

        
        return \Control::delete($request,$id,'page',function($query)
        {
            $query->menus()->delete();
        });
    }

    public function showTrashed($id)
    {
        return \Control::showTrashed('page',$id);
    }
    
    public function getTrashed()
    {

        return \Control::getTrashed('page');
    }

    public function forceDeleteOrRestore(Request $request, $id = null)
    {
        return \Control::forceDeleteOrRestore($request,$id,'page');
    }
}
