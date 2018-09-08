<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    protected $primaryKey = 's_id';
	
	protected $table = 'message';
	
    protected $fillable = [
    	's_message','s_count','u_id'
    ];


    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //与用户表建立一对一的关系
    public function username(){
    	
    	return $this->hasOne('App\Username','u_id','u_id');
    }
}
