<?php

namespace App\Http\Controllers\EzioCMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Tasks;
use App\Accounts;
use App\UserParam;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function index()
    {
    	# code...
    	if(request()->find!=''){
           $users = User::whereRaw(" LOWER(name) like ? OR LOWER(sname) like ? OR LOWER(fname) like ? OR LOWER(phone) like ?", ['%'.trim(mb_strtolower(request()->find)).'%', '%'.trim(mb_strtolower(request()->find)).'%', '%'.trim(mb_strtolower(request()->find)).'%', '%'.trim(mb_strtolower(request()->find)).'%'])
                        ->orderBy('id','desc')
                        ->paginate(10);
           $users->appends(['find' => request()->find]);
        }
        else{            
           $users = User::orderBy('id','desc')->paginate(10);
        }
    	$data = array(
    		'users' => $users,
    	);
    	return view('eziocms.users.users')->with($data);
    }
    public function profile($id)
    {   
        $date = Carbon::now('Asia/Dushanbe');
        $q = Accounts::where('user_id', $id)->get();
        if($q->count()<=0){  
            $data = array(
                'user_id'       => $id,
                'account'       => '1'.str_pad($id, 10, '0', STR_PAD_LEFT),
                'ccy'           => 'TJS',
                'amount'        => '0',
                'last_update'   => $date,
            );
            Accounts::insert($data);
        }
        $user = User::where('id',$id)->get();
        $userparam = UserParam::where('user_id', $id)->get();
        $tasks = Tasks::where('user_id',$id)->paginate(10);
        $data = array(
            'user'      => $user,
            'userparam' => $userparam,
            'tasks'     => $tasks,
        );
        return view('eziocms.users.userprofile')->with($data);
    }
}
