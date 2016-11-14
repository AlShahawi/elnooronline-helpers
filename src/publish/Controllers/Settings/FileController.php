<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Temp;
use App\File;
use Image;
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
    }


    public function files_upload(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:jpg,jpeg,png,gif,pdf,doc,xls,docx,rar,zip',
        ],[
        'file.mimes' => trans('validation.file-mimes'),
        'file.required' => trans('validation.file-mimes'),
        ]);
        $file = $request->file('file');
        $dir = public_path('upload');
        $filename = uniqid().'.'.$file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();
        $file->move($dir,$filename);
        $width = '';
        $height = '';
        if(str_contains($mimeType, 'image'))
        {
            $img = Image::make(base_path('public/upload/'.$filename));
            $width = $img->width();
            $height = $img->height();
        }
            $upload = File::create([
                'name' => $name,
                'type' => $mimeType,
                'path' => 'public/upload/'.$filename,
                'width' => $width,
                'height' =>$height, 
            ]);
            $view = view('helpers.upload-ajax',['file'=>$upload])->render();
            $files = File::orderBy('id','desc')->paginate(8,['*'],'f');
            $type = $request->type;
            $manager = view('files.files-paginate',compact('files','type'))->render();
        $data = [
            'file_id' => $upload->id,
            'filename' => $upload->name,
            'view' => $view,
            'path' => 'public/upload/'.$filename,
            'url' => public_url('upload/'.$filename),
            'delete_btn' => trans('lang.delete'),
            'delete_url' => url('file/delete'),
            'get_delete_url' => url('file/delete',$upload->id),
            'id' => uniqid(),
            'token' => csrf_token(),
            'type' => $type,
            'request_type' => $request->type,
            'manager'=>$manager
        ];

        return response()->json($data);
    }



    public function delete(Request $request,$id=null)
    {
        if (!is_null($id)) 
        {
            $file = File::find($id);
            if (!is_null($file)) 
            {
                if (file_exists(base_path($file->path))) 
                {
                    @unlink(base_path($file->path));
                }
                $file->delete();
            }
            $files = File::orderBy('id','desc')->paginate(8,['*'],'f');
            $type = $request->type;
            $manager = view('files.files-paginate',compact('files','type'))->render();
            return $request->ajax() ? response()->json(['manager'=>$manager]) : back();
        }
        if ($request->has('path')) 
        {
            if (file_exists(base_path($request->path))) 
            {
                @unlink(base_path($request->path));
            }
            File::where('path',$request->path)->delete();
            $files = File::orderBy('id','desc')->paginate(8,['*'],'f');
            $type = $request->type;
            $manager = view('files.files-paginate',compact('files','type'))->render();
            return response()->json(['manager'=>$manager]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pagination()
    {
        $files = File::orderBy('id','desc')->paginate(8,['*'],'f');
        $type = request('type');
        $data = view('files.files-paginate',compact('files','type'))->render();
        return $data;
    }

    public function check($id)
    {
        $data = view('files.files-selected', ['id' => $id])->render();
        return $data;
    }
    public function getModal(Request $request)
    {
        $data = view('files.files-modal', ['type' => $request->type])->render();
        return $data;
    }

}
