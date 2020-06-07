<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Langs;
use DB; 

class Lang extends Model
{
    //
    protected $table = 'lang';

    public function getLanguageAttribute()
    {
    	$q = Langs::where('param',$this->lang)->get();
    	foreach($q as $r){
    		return $r->lang;
    	}
    }
    public static function getTrans($param, $lang)
    {
    	# code...
    	$q = DB::table('lang')->where([['param','=',$param],['lang','=',$lang]])->get();
    	foreach($q as $r){
    		return $r->value;
    	}
    }
}
