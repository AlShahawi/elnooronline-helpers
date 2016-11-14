<?php

namespace App\Http\Controllers\Functions;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Notfication;
use DB;
use Img;
use Time;
class NotficationController extends Controller
{

    public function live()
    {
        $data = view('helpers.ajax.notfication.navbar')->render();

if (auth()->user()->rule == 'admin') {
    $count = auth()->user()->adminNotfications()->where('check',0)->count();
             auth()->user()->adminNotfications()->where('check',0)->update(['check'=>1]);
}else{
    $count = auth()->user()->importNotfications()->where('check',0)->count();
            auth()->user()->importNotfications()->where('check',0)->update(['check'=>1]);
}

    // $sound ='<audio autoplay="">
    //             <source src="'.NotficationSound.'" type="audio/mpeg">
    //          </audio>';

        return  response()->json([
            'count'=>$count > 0 ? $count : '',
            'data'=>$data,
            // 'sound'=>$sound,
            ]);

        
        
        }
    


    public function seeOnClick()
    {
        DB::table('notfications')->update(['seen'=> 1]);

        $count = Notfication::where('seen', 0)->count();
        $data = view('helpers.ajax.notfication.navbar')->render();

        return  response()->json([
            'count'=>$count > 0 ? $count : '',
            'data'=>$data,
            ]);
    }

    public function read_all()
    {
        DB::table('notfications')->update(['seen'=> 1,'readed'=>1,'check'=>1]);
        return view('helpers.ajax.notfication.navbar')->render();
    }

}
