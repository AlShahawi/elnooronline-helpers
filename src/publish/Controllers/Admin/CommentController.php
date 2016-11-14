<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('rule:editor',['except'=>['mainStore']]);
        $this->permession(__CLASS__);
        
        resourceBreadcrumbs('comment',function($comment){
            return $comment->user->name;
        });
    }
    
    public function index()
    {
        if (!hasRole('admin')) 
        {
            $comments = auth()->user()->comments;
            return control()->index('comment',null,compact('comments'));
        }
        return control()->index('comment');
        
    }


    public function mainStore(Request $request,$extends,$id,$parent)
    {
        $model = '\App\\'.ucfirst(camel_case(str_singular($extends)));
        $query = $model::find($id);
        if ($parent > 0) {
            $query = \App\Comment::find($parent);
        }
        $table = $query->getTable();
                $comment = $query->comments()->create([
                            'user_id'=> user('id'),
                            'comment'=> $request->comment,
                            'parent_id'=> $parent,
                            'status'=> user('rule') == 'admin' ? 1 : 0,
                        ]);
        if ($table == 'comments') 
        {
            $user = $query->user->id;
            $comment->notfications()->create([
                        'sender_id' => user('id'),
                        'user_id' => $user,
                        'type' => 'new_replay_by',
                    ]);
        }else{
            $query->notfications()->create([
                        'sender_id' => user('id'),
                        'colum' => 'name',
                        'type' => 'new_comment_by',
                    ]);
        }
                app('pusher')->trigger('notfications', 'new', []);

        return $comment->comment;
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $comment = \App\Comment::find($id);
        if (!is_null($comment)) 
        {
            if ($comment->notfication) {
                $comment->notfication->read();
            }
            $url = cp.str_plural($comment->commentable_type).'/'.$comment->commentable_id;
            return redirect(url($url));
        }
       return back();
    }

    public function destroy(Request $request, $id = null)
    {
        return control()->delete($request,$id,'comment');
    }

    public function showTrashed($id)
    {
        return \Control::showTrashed('comment',$id);
    }
    
    public function getTrashed()
    {

        return \Control::getTrashed('comment');
    }

    public function forceDeleteOrRestore(Request $request, $id = null)
    {
        return \Control::forceDeleteOrRestore($request,$id,'comment');
    }

}
