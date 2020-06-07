<?php

namespace App\OrzuModels;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\OrzuModels\Tasks;

class Category extends Model
{
    //
    public static function getCatTasksCount($cat_id)
    {
    	# code...
    	$q = Tasks::where([['cat_id','=',$cat_id],['status','=','0']])->get();
    	return $q->count();
    }
    public static function getAllTasksCount()
    {
    	# code...
    	$q = Tasks::where([['status','=','0']])->get();
    	return $q->count();
    }
}
