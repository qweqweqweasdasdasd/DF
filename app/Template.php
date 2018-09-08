<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    protected $primaryKey = 'e_id';
	
	protected $table = 'event';
	
    protected $fillable = [
    	'title','kfline','appload','gamedesc','hdesc'
    ];


    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];
}
