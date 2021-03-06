<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Import extends Model
{
    protected $primaryKey = 'i_id';
	
	protected $table = 'import';
	
    protected $fillable = [
    	'order','count','mg_id'
    ];


    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];
}
