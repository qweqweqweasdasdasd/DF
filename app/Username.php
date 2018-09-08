<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Username extends Model
{
    protected $primaryKey = 'u_id';
	
	protected $table = 'username';
	
    protected $fillable = [
    	'username','password','tel','tpasspwd','sum','link','e_id'
    ];


   // use SoftDeletes;
   // protected $dates 	  = ['deleted_at'];
}
