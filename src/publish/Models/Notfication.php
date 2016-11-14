<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notfication extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'sender_id','user_id','notifiable_id','notifiable_type','type',
        'sound','seen','readed','check','colum'
    ];
    
    protected $table = 'notfications';

    public function notifiable()
    {
        return $this->morphTo();
    }
    public function sender()
    {
    	return $this->belongsTo(User::class,'sender_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }

    public function see()
    {
        return $this->update(['seen'=> 1,'check'=>1]);
    }
    public function read()
    {
        return $this->update(['seen'=> 1,'check'=>1,'readed' => 1]);
    }
    public function check()
    {
        return $this->update(['check'=>1]);
    }


}
