<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class City extends Model
{
    protected $table = 'cities';
    //
    public static function getCities()
    {
    	# code...
    	$q = DB::table('cities')->get();
    	$cities = array();
    	foreach($q as $r){
    		$cities[] .= $r->name;
    	}
    	return $cities;
    }
}
