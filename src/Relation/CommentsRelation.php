<?php
namespace AhmedFathy\Helpers\Relation;
trait CommentsRelation{
    
    public function comments()
    {
        return $this->morphMany('App\Comment','commentable');
    }
    public function notfications()
    {
        return $this->morphMany('App\Notfication','notifiable');
    }
    public function notfication()
    {
        return $this->morphOne('App\Notfication','notifiable');
    }

}