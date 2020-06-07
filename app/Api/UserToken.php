<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserToken extends Model
{
    //
	public static function getMyToken($id)
	{
    	# code...
		$q = User::where('id', $id)->get();
		foreach($q as $r){
			return $r->remember_token;
		}
	}
}
