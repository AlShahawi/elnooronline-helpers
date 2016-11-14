<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->permession(__CLASS__);

        resourceBreadcrumbs('file',function($file){
            return !is_null($file) ? $file->trans('name') : '';
        });
    }

    public function index()
    {
        return \Control::index('file');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('file');
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
            'translate' => [
                'name' => 'required',
            ],
            'tags' => 'required',
        ]);
        return \Control::store($request,'file',[
            'translate' => ['name'],
            'tags' => $request->tags,
            ],cp.'files');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Control::show('file',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Control::edit('file',$id);
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
            ],
            'tags' => 'required',
        ]);
        return \Control::update($request,$id,'file',[
            'translate' => ['name'],
            'tags' => $request->tags,
            ],cp.'files');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return \Control::destroy($request,$id,'file');
    }

    public function order(Request $request)
    {
        return \Control::order($request->data,'file',0);
    }

    public function showTrashed($id)
    {
        return \Control::showTrashed('file',$id);
    }
    
    public function getTrashed()
    {

        return \Control::getTrashed('file');
    }

    public function forceDeleteOrRestore(Request $request, $id = null)
    {
        return \Control::forceDeleteOrRestore($request,$id,'file');
    }

}
