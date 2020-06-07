<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use File;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserParam;
use App\Tasks;
use App\Category;
use App\City;
use App\Currently;
use App\Chat;
use App\ChatMessages;
use Carbon\Carbon;
use DB;

class MyProfile extends Controller
{
    public function myprofile()
    {          
        $profile = User::where('id',Auth::user()->id)
        ->get();
        $user_cat = UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_cat']])
        ->get();
        $data = array(
            'user_cat'  => $user_cat,
            'profile'   => $profile
        );
        return view('myprofile.myprofile')->with($data);
    } 
    public function messages($id)
    {
        if($id!='0'){
            $q = Tasks::where('id',$id)->get();
            if($q->count()>0){            
                $date = Carbon::now('Asia/Dushanbe');
                foreach($q as $r){
                    $chat = Chat::where('task_id',$id)
                    ->where('req_user_id',Auth::user()->id)
                    ->orWhere('res_user_id',Auth::user()->id)
                    ->get();
                    if($chat->count()<0){
                        $data = array(
                            'task_id'       => $r->id,
                            'req_user_id'   => Auth::user()->id,
                            'res_user_id'   => $r->user_id,
                            'status'        => '0',
                            'created_at'    => $date,
                        );
                        Chat::insert($data);
                        $chat_id = DB::getPdo()->lastInsertId();
                    }
                    else{
                        foreach($chat as $c){
                            $chat_id = $c->id;
                        }
                    }
                }
            }
            $messages = ChatMessages::where('chat_id', $chat_id)->get();
            $chats = Chat::where('req_user_id',Auth::user()->id)
            ->orWhere('res_user_id',Auth::user()->id)
            ->get();
            $data = array(
                'messages' => $messages,
                'chats' => $chats,
                'chat_id' => $chat_id,
            );
            return view('myprofile.messages')->with($data);
        }
        else{
            $q = Chat::where('task_id','0')
            ->where('req_user_id',Auth::user()->id)
            ->get();
            if($q->count()>0){
                foreach($q as $r){
                    $chat_id = $r->id;
                }
            }
            else{
                $date = Carbon::now('Asia/Dushanbe');
                $data = array(
                    'task_id'       => '0',
                    'req_user_id'   => Auth::user()->id,
                    'res_user_id'   => '3',
                    'status'        => '0',
                    'created_at'    => $date,
                );
                Chat::insert($data);
                $chat_id = DB::getPdo()->lastInsertId();
            }
            $messages = ChatMessages::where('chat_id', $chat_id)->get();
            $chats = Chat::where('req_user_id',Auth::user()->id)
            ->orWhere('res_user_id',Auth::user()->id)
            ->get();
            $data = array(
                'messages' => $messages,
                'chats' => $chats,
                'chat_id' => $chat_id,
            );
            return view('myprofile.messages')->with($data);            
        }
    }
    public function messageadd(Request $request)
    {
        $data = array(
            'chat_id' => $request['chat_id'],
            'user_id' => Auth::user()->id,
            'message' => $request['msg']
        );
        ChatMessages::insert($data);
        return back()->with('success','Добавленно!');
    }
    public function document()
    {
        # code...
        return view('myprofile.document');
    }
    public function uploaddoc(Request $request)
    {
        if($request->hasFile('file')){
            foreach($request->file('file') as $images){
                $filename = time().'.'.$images->getClientOriginalExtension();
                $image_resize = Image::make($images->getRealPath());
                $image_resize->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $filename_1 = 'uploads/userdocs/'.Auth::user()->id.'/'.$filename;
                $data = array(
                    'user_id' => Auth::user()->id,
                    'meta_param' => 'document',
                    'meta_value' => $filename_1,
                );
                UserParam::insert($data);
                $dataDocStatus = array(
                    'docstatus' => '1'
                );
                DB::table('users')->where('id',Auth::user()->id)->update($dataDocStatus);
                if(!File::exists(public_path('uploads/userdocs/'.Auth::user()->id.'/'))){
                    File::makeDirectory(public_path('uploads/userdocs/'.Auth::user()->id.'/'), $mode = 0777, true, true);
                }
                $image_resize->save(public_path('uploads/userdocs/'.Auth::user()->id.'/'.$filename));
            }
            return response()->json('Файл добавлен', 200);
        } else {
            return response()->json('Выберите файл', 200);
        }
    }

    public function uploadavatar(Request $request)
    {
        if($request->hasFile('file')){
            foreach($request->file('file') as $images){
                $filename = time().'.'.$images->getClientOriginalExtension();
                $image_resize = Image::make($images->getRealPath());
                $image_resize->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $filename_1 = '/uploads/avatars/'.Auth::user()->id.'/'.$filename;
                $dataDocStatus = array(
                    'avatar' => $filename_1
                );
                DB::table('users')->where('id',Auth::user()->id)->update($dataDocStatus);
                if(!File::exists(public_path('uploads/avatars/'.Auth::user()->id.'/'))){
                    File::makeDirectory(public_path('uploads/avatars/'.Auth::user()->id.'/'), $mode = 0777, true, true);
                }
                $image_resize->save(public_path('uploads/avatars/'.Auth::user()->id.'/'.$filename));
            }
            return response()->json('Фотография добавлена', 200);
        } else {
            return response()->json('Фотография не выбрана', 200);
        }
    }

    public function balance()
    {
        $tasks = Tasks::where('user_id',Auth::user()->id)
        ->get();
        $profile = User::where('id',Auth::user()->id)
        ->get();
        $data = array(
            'tasks' => $tasks,
            'profile' => $profile
        );
        return view('myprofile.balance')->with($data);
    }
    public function mytasks()
    {
        $tasks = Tasks::where('user_id',Auth::user()->id)
        ->orderBy('id','desc')
        ->get();
        $profile = User::where('id',Auth::user()->id)
        ->get();
        $data = array(
            'tasks' => $tasks,
            'profile' => $profile
        );
        return view('myprofile.mytasks')->with($data);
    }
    public function mysettings()
    {
        if(Auth::check()){
            $categories = Category::where('parent_id','0')
            ->get();
            $user_mobile = UserParam::where([['user_id', '=', Auth::user()->id], ['meta_param', '=', 'user_phone']])
            ->get();
            $user_email = User::where([['id', '=', Auth::user()->id]])
            ->get(); 
            $profile = User::where('id',Auth::user()->id)
            ->get();
            $data = array(
                'user_mobile' => $user_mobile,
                'user_email' => $user_email,
                'categories' => $categories,
                'profile' => $profile
            );
            return view('myprofile.settings')->with($data);
        }
        else{
            return redirect()->action('HomeController@index');
        }
    } 
    public function mysettings_cat_update(Request $request)
    {
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_cat']])->delete();
        for($i=0; $i<=count($request['cat'])-1;$i++){
            $data = array(
                'user_id'       => Auth::user()->id,
                'meta_param'    => 'user_cat',
                'meta_value'    => $request['cat'][$i]
            );
            UserParam::insert($data);
        }
    }
    public function mysettings_r_email_update(Request $request)
    {
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_req_email']])->delete();
        $email = 'no';
        if(isset($request['email'])){
            if($request['email']!=''){
                $email = 'yes';
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'user_req_email',
            'meta_value'    => $email
        );
        UserParam::insert($data);
    }
    public function mysettings_push_update(Request $request)
    {
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_req_push']])->delete();
        $push = 'no';
        if(isset($request['push'])){
            if($request['push']!=''){
                $push = 'yes';
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'user_req_push',
            'meta_value'    => $push
        );
        UserParam::insert($data);
    }
    public function mysettings_embile_update(Request $request)
    {
        if(isset($request['email'])){
            if($request['email']!=''){
                $q = User::where('email', $request['email'])->get();
                if($q->count()<=0){
                    $data = array(
                        'email' => trim($request['email'])
                    );
                    User::where('id', Auth::user()->id)->update($data);
                }
            }
        }
        if(isset($request['phone'])){
            if($request['phone']!=''){
                $q = User::where('phone', $request['phone'])->get();
                if($q->count()<=0){
                    $data = array(
                        'phone' => trim($request['phone'])
                    );
                    User::where('id', Auth::user()->id)->update($data);
                }
            }
        }
        return back()->with('success','Upload successfully!');
    }
    public function mysettings_pass_update(Request $request)
    {
        $q = User::where('id', Auth::user()->id)->get();
        foreach($q as $r){
            if(!Hash::check($request['password'],$r->password)){
                return back()->with('error','Пароль введен не верно!');
            }
            else{
                if($request['newpassword']==$request['vernewpassword']){
                    $data = array(
                        'password' => Hash::make($request['newpassword']),
                        'remember_token' => $request['__token']
                    );
                    User::where('id', Auth::user()->id)->update($data);
                    return back()->with('success','Upload successfully!');
                }
                else{
                    return back()->with('error','Новый пароль не совподает!');
                }
            }
        }
    }
    public function mysettings_links_update(Request $request)
    {
        $fb='';
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_fb']])->delete();
        if(isset($request['fb'])){
            if($request['fb']!=''){
                $fb = $request['fb'];
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'user_fb',
            'meta_value'    => $fb
        );
        UserParam::insert($data);
        $vk='';
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_vk']])->delete();
        if(isset($request['vk'])){
            if($request['vk']!=''){
                $vk = $request['vk'];
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'user_vk',
            'meta_value'    => $vk
        );
        UserParam::insert($data);
        $inst='';
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_instagram']])->delete();
        if(isset($request['inst'])){
            if($request['inst']!=''){
                $inst = $request['inst'];
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'user_instagram',
            'meta_value'    => $inst
        );
        UserParam::insert($data);
        $web='';
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_web']])->delete();
        if(isset($request['web'])){
            if($request['web']!=''){
                $web = $request['web'];
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'user_web',
            'meta_value'    => $web
        );
        UserParam::insert($data);
        return back()->with('success','Upload successfully!');
    }
    public function mysettings_email_param_update(Request $request)
    {
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'new_req']])->delete();
        $new_req = 'no';
        if(isset($request['new_req'])){
            if($request['new_req']!=''){
                $new_req = 'yes';
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'new_req',
            'meta_value'    => $new_req
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'new_msg']])->delete();
        $new_msg = 'no';
        if(isset($request['new_msg'])){
            if($request['new_msg']!=''){
                $new_msg = 'yes';
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'new_msg',
            'meta_value'    => $new_msg
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'sys_msg']])->delete();
        $sys_msg = 'no';
        if(isset($request['sys_msg'])){
            if($request['sys_msg']!=''){
                $sys_msg = 'yes';
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'sys_msg',
            'meta_value'    => $sys_msg
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'site_news']])->delete();
        $site_news = 'no';
        if(isset($request['site_news'])){
            if($request['site_news']!=''){
                $site_news = 'yes';
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'site_news',
            'meta_value'    => $site_news
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'new_myreq']])->delete();
        $new_myreq = 'no';
        if(isset($request['new_myreq'])){
            if($request['new_myreq']!=''){
                $new_myreq = 'yes';
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'new_myreq',
            'meta_value'    => $new_myreq
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'new_mymsg']])->delete();
        $new_mymsg = 'no';
        if(isset($request['new_mymsg'])){
            if($request['new_mymsg']!=''){
                $new_mymsg = 'yes';
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'new_mymsg',
            'meta_value'    => $new_mymsg
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'sys_mymsg']])->delete();
        $sys_mymsg = 'no';
        if(isset($request['sys_mymsg'])){
            if($request['sys_mymsg']!=''){
                $sys_mymsg = 'yes';
            }
        }
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'sys_mymsg',
            'meta_value'    => $sys_mymsg
        );
        UserParam::insert($data);
    }
    public function myedit()
    {
        $profile = User::where('id',Auth::user()->id)
        ->get();
        $data = array(
            'profile' => $profile
        );
        return view('myprofile.edit')->with($data);
    }
    public function myedit_update(Request $request)
    {
        $data = array(
            'name' => $request['name'],
            'fname' => $request['fname']
        );
        User::where('id',Auth::user()->id)
        ->update($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_address']])->delete();
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'user_address',
            'meta_value'    => $request['cities']
        );
        UserParam::insert($data);

        //User currently setting
        $city = City::select('contry_id')->where('name',$request['cities'])->get();
        foreach($city as $r) {
            $getCid = $r->contry_id;
            $q = Currently::select('name')->where('country_id',$getCid)->get();
            foreach($q as $qq) {
                $GetCurrent = $qq->name;
                UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_current']])->delete();
                $data = array (
                    'user_id' => Auth::user()->id,
                    'meta_param' => 'user_current',
                    'meta_value' => $GetCurrent
                );
                UserParam::insert($data);
            }
        }

        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_about']])->delete();
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'user_about',
            'meta_value'    => $request['about']
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_sex']])->delete();
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'user_sex',
            'meta_value'    => $request['gender']
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'bday']])->delete();
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'bday',
            'meta_value'    => $request['bday']
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'bmonth']])->delete();
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'bmonth',
            'meta_value'    => $request['bmonth']
        );
        UserParam::insert($data);
        UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'byear']])->delete();
        $data = array(
            'user_id'       => Auth::user()->id,
            'meta_param'    => 'byear',
            'meta_value'    => $request['byear']
        );
        UserParam::insert($data);
        return back()->with('error','Сохранено');
    }
    public function add_money_with_terminal()
    {
        $terminal_id    = request("terminal_id");
        $password       = request("password");
        $account        = request("account");
        $amount         = request("amount");
        $narrative      = request("narrative");        
        $q = DB::table('terminal_api')->where('terminal_id', $terminal_id)->get();
        dump($q);
        foreach($q as $r){
            if(!Hash::check($password,$r->password)){
                echo 'Пароль введен не верно!';
            }
            else{
                $data = array(
                    'terminal_id'   => $terminal_id,
                    'datain'        => date('Y-m-d H:i:s'),
                    'account'       => $account,
                    'amount'        => $amount,
                    'narrative'     => $narrative,
                );
                DB::table('transactions')->insert($data);
                $qt = DB::table('accounts')->where('account',$account)->get();
                $old_amount = 0;
                foreach($qt as $rt){
                    $old_amount = $rt->amount;
                }
                $data = array(
                    'amount' => ($old_amount+$amount),
                    'last_update' => date('Y-m-d H:i:s'),
                );
                DB::table('accounts')->where('account',$account)->update($data);
            }
        }
    }
}
