<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Image;
use File;
use Illuminate\Support\Facades\Hash;

class OtherProfileController extends Controller
{
    public function profile($id)
    {
        $profile = DB::table('users')
                        ->where('id',$id)
                        ->get();
        $user_cat = DB::table('users_param')
                            ->where([['user_id', '=', $id],['meta_param', '=', 'user_cat']])
                            ->get();
        $data = array(
            'user_cat'  => $user_cat,
            'profile' => $profile
        );
        return view('profile')->with($data);
    }
    public function profile_add_rate(Request $request)
    {
        if($request['smiley']=='sad'){
            $like = '0';
        }
        else if($request['smiley']=='neutral'){
            $like = '1';
        }
        else{
            $like = '2';
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'remote_addr'   => $_SERVER['REMOTE_ADDR'],
            'like'          => $like,
            'datein'        => date('Y-m-d H:i:s'),
            'narrative'     => $request['narrative'],
            'like_user_id'  => $request['like_user_id']
        );
        DB::table('users_stars')->insert($data);
        return back()->with('error','Новый пароль не совподает!');
    }
    public function profile_add_like($id)
    {
        $data = array(
            'user_id'       => Auth::user()->id,
            'remote_addr'   => $_SERVER['REMOTE_ADDR'],
            'like'          => '3',
            'datein'        => date('Y-m-d H:i:s'),
            'narrative'     => '',
            'like_user_id'  => $id
        );
        DB::table('users_stars')->insert($data);
        return back()->with('error','Новый пароль не совподает!');
    } 
}
