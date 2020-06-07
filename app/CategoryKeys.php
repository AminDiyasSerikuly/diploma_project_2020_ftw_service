<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class CategoryKeys extends Model
{
    //
    protected $table = 'category_keis';
    public function getCatNameAttribute()
    {
    	$q = Category::where('id',$this->cat_id)->get();
    	$p = '';
    	foreach($q as $r){
    		$qt = Category::where('id',$r->parent_id)->get();
    		foreach($qt as $rt){
    			$p = $rt->name;
    		}
    		if($p!=''){
    			return $p.' -> '.$r->name;
    		}
    		else{
    			return $r->name;
    		}
    	}
    }
}
