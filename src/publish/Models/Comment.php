<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id','parent_id','comment','commentable_id','commentable_type'];
    
    public function user()
    {
    	return $this->belongsTo(User::class)->withTrashed();
    }

    public function replays()
    {
    	return $this->hasMany(Comment::class,'parent_id');
    }

    /* For Replay */
    public function comment()
    {
        return $this->belongsTo(Comment::class,'parent_id')->withTrashed();
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
