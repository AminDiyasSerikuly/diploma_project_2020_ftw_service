<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class Category extends Model
{
    //
    protected $table = 'category';

    public function getSubCatNameAttribute()
    {
    	$q = DB::table('category')
    				->where('parent_id',$this->id)
                    ->where('lang',Config::get('app.locale'))
    				->get();
    	return $q;
    }
    public function getParentNameAttribute()
    {
        $q = DB::table('category')
                    ->where('id',$this->parent_id)
                    ->get();
        foreach($q as $r){
            return $r->name; 
        }
    }
    public static function getSubCatParam($cat){
        $q = DB::table('category')
                    ->where('param','like',$cat.'/%')
                    ->get();
        return $q;
    }
    public static function getCatTasksCount($cat_id)
    {
        $q = Tasks::whereRaw('`cat_id` in (select `id` from `category` where `id`=? OR `parent_id`=?)',[$cat_id, $cat_id])
                    ->where('status','=','0')
                    ->get();
        return $q->count();
    }
    public static function getAllTasksCount()
    {
        $q = Tasks::where([['status','=','0']])->get();
        return $q->count();
    }
}
