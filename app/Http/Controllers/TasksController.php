<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Tasks;
use App\TasksParam;
use App\TasksRequest;
use App\Category;
use App\User;
use App\Profile;
use App\Currently;
use App\OrzuPusher\PushNotification;
use Carbon\Carbon;
use Config;
use App\CategoryKeys;
use DB;
use Hash;
use App\SendSMS\SendSMSModel;   
use App\SendSMS\Sendsmslog;   
use Image;
use App\Accounts;
use File;
use GeoLocation;

class TasksController extends Controller
{
    public function taskajaxupload()
    {
        if(request()->find!=''){
            $q = DB::select("SELECT `key` FROM `category_keis` WHERE `key` like '%".request()->find."%' LIMIT 5");
        }
        else{
            $q = DB::select("SELECT `key` FROM `category_keis` LIMIT 5");
        }
        $dataa = array();
        foreach($q as $r){
            $data = array($r->key);
            $dataa = array_merge($dataa, $data);
        }
        return $dataa;
    }
    public function cityajaxupload()
    {
        if(request()->find!=''){
            $q = DB::select("SELECT * FROM `cities` WHERE `name` like '%".request()->find."%' LIMIT 10");
        }
        else{
            $q = DB::select("SELECT * FROM `cities` LIMIT 10");
        }
        return response()->json($q, 200);
    }
    public function currentajaxupload()
    {
        if(request()->find!=''){
            $q = Currently::select('id', 'name', 'name_addr', 'symbol', 'country_id')->where('country_id',request()->find)->get();
            return response()->json($q, 200);
        }
        else{
            return response()->json('Bad request', 400);
        }
    }
    public function add(Request $request)
    {
        $date = Carbon::now('Asia/Almaty');
        $cat_id = explode('/', $request['cat_id']);
        $cats = Category::select('id')
        ->where([['param','like', $cat_id[5].'/'.$cat_id[6]]])
        ->get();
	$city = 'Алматы';
        foreach($cats as $cat){
            $cat_id = $cat->id;
        }
        $data = array(
            'task'          => $request['task'],
            'cat_id'        => $cat_id,
            'narrative'     => $request['narrative'],
            'user_id'       => '0',
            'status'        => '1',
            'created_at'    => $date,
            'updated_at'    => $date,
	    'city'	    => 'Алматы',
        );
        Tasks::insert($data); 
        $task_id = DB::getPdo()->lastInsertId();
        if($request['mtoken']==''){
            if(isset($request['phone']) && isset($request['name'])){
                if($request['phone']!='' && $request['name']!=''){
                    $pass = str_random(12);
                    $user = array(
                        'name'          => $request['name'],
                        'phone'         => $request['phone'],
                        'password'      => Hash::make($pass),
                        'remember_token'=> $request['__token'],
                        'created_at'    => date('Y-m-d H:i:s', strtotime($date)),
                        'updated_at'    => date('Y-m-d H:i:s', strtotime($date))
                    );
                    User::insert($user); 
                    $id = DB::getPdo()->lastInsertId();
                    $account = array(
                        'user_id'       => $id,
                        'account'       => '1'.str_pad($id, 10, '0', STR_PAD_LEFT),
                        'last_update'   => date('Y-m-d H:i:s', strtotime($date))
                    );                
                    Accounts::insert($account);                
                    $del = array('(',')',' ','-','+');
                    if($request['phone']!=''){
                        $phone = str_replace($del,'',$request['phone']);
                    }
                    else{
                        if(Auth::check()){
                            $phone = str_replace($del,'',Auth::user()->phone);
                        }
                    }
                    $msg = 'Ваш логин: '.$phone.'Ваш пароль: '.$pass.' Ваш счет: 1'.str_pad($id, 10, '0', STR_PAD_LEFT);
                    $response = SendSMSModel::sendSms($phone, $msg);
                    if (is_array($response)){
                        $response = $response;
                    }
                    else{
                     $response = array('Нет ответа от сервера!');
                 }
                 $data = array(
                    'phone'         => $phone,
                    'message'       => $msg,
                    'respons'       => implode($response,';'),
                    'created_at'    => date('Y-m-d H:i:s', strtotime($date)),
                    'updated_at'    => date('Y-m-d H:i:s', strtotime($date))
                );               
                 Sendsmslog::insert($data);
             }
         }
         else{
            $id = Auth::user()->id;
        } 
    }
    else{
        $user = User::where('remember_token',$request['mtoken'])->get();
        foreach($user as $u){
            $id = $u->id;
        }
    }       
    $data = array(
        'user_id' => $id,
        'status' => '0'
    );
    DB::table('tasks')->where('id',$task_id)->update($data);
    if($request->has('files')){
        foreach($request->file('files') as $images){
            $filename = $images->getClientOriginalName();
            $image_resize = Image::make($images->getRealPath());
            $image_resize->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $filename_1 = 'uploads/tasks_images/'.$task_id.'/'.$filename;
            $data = array(
                'task_id' => $task_id,
                'param' => 'image',
                'value' => $filename_1,
            );
            TasksParam::insert($data);
            if(!File::exists(public_path('uploads/tasks_images/'.$task_id.'/'))){
                File::makeDirectory(public_path('uploads/tasks_images/'.$task_id.'/'), $mode = 0777, true, true);
            }
            $image_resize->save(public_path('uploads/tasks_images/'.$task_id.'/'.$filename));
        }
    }
    if(Auth::check()){
        $UserCity = Profile::getUserParam('user_address');
        $UserCurrent = Profile::getUserParam('user_current');
    } else {
        $UserCity = 'Алматы';
        $UserCurrent = 'тенге';
    }

    $data = array(
        'task_id' => $task_id,
        'param' => 'city',
        'value' => $UserCity
    );
    TasksParam::insert($data);
    $data = array(
        'task_id' => $task_id,
        'param' => 'current',
        'value' => $UserCurrent
    );
    TasksParam::insert($data);
    if($request->date_radio=='5'){
        $data = array(
            'task_id' => $task_id,
            'param' => 'work_with',
            'value' => 'reqierer',
        );
        TasksParam::insert($data);
    }
    if($request->date_radio=='6'){
        $data = array(
            'task_id' => $task_id,
            'param' => 'cdate',
            'value' => $request['cdate'],
        );
        TasksParam::insert($data);
        $data = array(
            'task_id' => $task_id,
            'param' => 'edate',
            'value' => $request['edate'],
        );
        TasksParam::insert($data);
    }
    if($request->date_radio=='7'){
        $data = array(
            'task_id' => $task_id,
            'param' => 'cdate_l',
            'value' => $request['cdate_l'],
        );
        TasksParam::insert($data);
        $data = array(
            'task_id' => $task_id,
            'param' => 'level_l',
            'value' => $request['level_l'],
        );
        TasksParam::insert($data);
    }
    if($request->location=='1'){
        $data = array(
            'task_id' => $task_id,
            'param' => 'address',
            'value' => $request->address,
        );
        TasksParam::insert($data);
    }
    if($request->location=='2'){
        $data = array(
            'task_id' => $task_id,
            'param' => 'remote',
            'value' => 'yes',
        );
        TasksParam::insert($data);
    }
    if($request->current_radio=='3'){
        $data = array(
            'task_id' => $task_id,
            'param' => 'amout',
            'value' => $request->val,
        );
        TasksParam::insert($data);
        $data = array(
            'task_id' => $task_id,
            'param' => 'amount_l',
            'value' => '3',
        );
        TasksParam::insert($data);
    }
    if($request->current_radio=='4'){
        $data = array(
            'task_id' => $task_id,
            'param' => 'no_amount',
            'value' => 'yes',
        );
        TasksParam::insert($data);
    }
    $del = array('(',')',' ','-','+');
    if($request['phone']!=''){
        $phone = str_replace($del,'',$request['phone']);
    }
    else{
        if($request['mtoken']==''){
            $phone = str_replace($del,'',Auth::user()->phone);
        }
        else{
            $user = User::where('remember_token',$request['mtoken'])->get();
            foreach($user as $u){
                $phone = str_replace($del,'', $u->phone);
            }
        }
    }

    //SendSMSModel::sendSMStoPerformerAboutCreateNewTask($request['task'], $cat_id);
    //Отправляет пуш всем юзерам, которые подписаны на категорию задачи
		
    PushNotification::SendCategories(Auth::user()->id, $cat_id, $city, 'Подписка', 'Новая задача в категории: '.Tasks::getCatNameAttributeStatic($cat_id), $task_id);
    return redirect('/tasks/view/'.$task_id);
}
public function task_requests(Request $request)
{
    $secure = false;
    if($request['secure']!=''){
        $secure = true;
    }
    $request_not = false;
    if($request['secure']!=''){
        $request_not = true;
    }
    $time_request = false;
    if($request['secure']!=''){
        $time_request = true;
    }
    $data = array(
        'user_id'       => Auth::user()->id,
        'task_id'       => $request['task_id'],
        'narrative'     => $request['narrative'],
        'secure'        => $secure,
        'request_not'   => $request_not,
        'time_request'  => $time_request,
        'amount'        => $request['amount'],
        'current'       => Profile::getUserParam('user_current'),
        'selected'      => '0'
    );
    TasksRequest::insert($data);
		$cityTask = TasksParam::select('value')->where('param','city')
		  ->where('task_id',$request['task_id'])
		  ->get();
    //Отправляет пуш, если автору задачи добавили предложение
    PushNotification::SendUser(Tasks::getAuthorTask($request['task_id']), $cityTask, 'Отличная новость!', 'Новое предложение от исполнителя', $request['task_id']);
    return back()->with('success','Request added');
}
public function task_requests_selected($id)
{
    $data = array(
        'selected' => '1'
    );
    DB::table('task_requests')->where('id',$id)->update($data);
    //SendSMSModel::sendSMStoSelectedPerfomer($id);
    //Уведомляет юзера по пуш, если его выбрали испольлителем
    $city = Profile::getUserParamWithId(Tasks::getAuthorTaskRequest($id), 'user_address');	
    PushNotification::SendUser(Tasks::getAuthorTaskRequest($id),$city, 'Отличная новость!', 'Вас выбрали исполнителем задачи', Tasks::getAuthorTaskRequest($id));
    return back()->with('success','Request selected');
}
public function hometask(Request $request)
{
    if($request['task']==''){
       return redirect()->action('TasksController@new_task', array('cat'=>'techrepair', 'subcat'=>'techrepairother', 'task'=>$request['task'])); 
   }
   else{
    $q = CategoryKeys::where([['key','like','%'.$request['task'].'%']])
    ->get();
    if($q->count()>0){
        foreach($q as $r){
            $qt = Category::where('id',$r->cat_id)
            ->get();
            foreach($qt as $rt){
                $l = explode('/', $rt->param);
                return redirect()->action('TasksController@new_task', array('cat'=>$l[0], 'subcat'=>$l[1], 'task'=>$request['task']));
            }
        }
    }
    else{
        return redirect()->action('TasksController@new_task', array('cat'=>'techrepair', 'subcat'=>'techrepairother', 'task'=>$request['task']));
    }
}
}
public function new_task()
{
        # code...
    $categories = Category::where('parent_id','0')
    ->where('lang',Config::get('app.locale'))
    ->get();        
    $data = array(
        'categories' => $categories,
    );
    return view('tasks.tasks')->with($data);
}
public function index()
{
    $find = '';
    if(request("find")!=''){
        $find = "`task` like '%".request("find")."%'";
    }
    $offers = '';
    if(request("offers")!=''){
        if(request("offers")=='yes'){
            $offers = "";
        }
    }
    $beside = '';
    if(request("beside")!=''){
        if(request("beside")=='yes'){
            $beside = "";
        }
    }
    $bs = '';
    if(request("bs")!=''){
        if(request("bs")=='yes'){
            $bs = "";
        }
    }
    $status = '';
    if(request("status")!='' && request("status")!='undefined'){
        $status = " and `status`='".request("status")."'";
    }
    $sortBy = '';
    if(request("sortBy")!=''){
        if(request("sortBy")=='last'){
            $sortBy = " ORDER BY `id` DESC";
        }
        if(request("sortBy")=='urgently'){
            $sortBy = " ORDER BY `id` DESC";
        }
    }
    $cat = '';
    $c = explode(',',request("cat"));
    $cc = '';
    for($i=0; $i<=count($c)-1; $i++){
        if((count($c)-1)==$i){
            $cc .= "'".$c[$i]."'";
        }
        else{
            $cc .= "'".$c[$i]."',";                
        }
    }
    if(request("cat")!=''){
        $cat = " and `cat_id` in (".$cc.")";
    }
    if($sortBy!='' || $find!='' || $status!=''){
        $tasks = Tasks::whereRaw($find.$status.$offers.$bs.$beside.$cat." ".$sortBy." LIMIT 10");
    }
    else{
        $tasks = Tasks::where('status','0')->orderBy('id', 'desc')->limit(10)->get();
    }
    $categories = Category::where('parent_id','0')
    ->get();  
    $data = array(
        'tasks' => $tasks,
        'categories' => $categories,
    );
    return view('tasks.alltasks')->with($data);
}
public function loadTasksAjax(Request $request)
{
    $output = '';
    $id = $request->id;
    $find = '';
    if($request->find!=''){
        $find = " AND `task` like '%".$request->find."%'";
    }
    $offers = '';
    if($request->offers!=''){
        if($request->offers=='yes'){
            $offers = "";
        }
    }
    $beside = '';
    if($request->beside!=''){
        if($request->beside=='yes'){
            $beside = "";
        }
    }
    $bs = '';
    if($request->bs!=''){
        if($request->bs=='yes'){
            $bs = "";
        }
    }
    $status = '';
    if($request->status!='' && $request->status!='undefined'){
        $status = " `status`='".$request->status."'";
    }
    else{
        $status = " `status`='0'";
    }
    $sortBy = '';
    if($request->sortBy!=''){
        if($request->sortBy=='last'){
            $sortBy = " ORDER BY `id` DESC";
        }
        if($request->sortBy=='urgently'){
            $sortBy = " ORDER BY `id` DESC";
        }
    }
    else{
       $sortBy = " ORDER BY `id` DESC"; 
   }
   $cat = '';
   $c = explode(',',$request->cat);
   $cc = '';
   for($i=0; $i<=count($c)-1; $i++){
    if((count($c)-1)==$i){
        $cc .= "'".$c[$i]."'";
    }
    else{
        $cc .= "'".$c[$i]."',";                
    }
}
if($request->cat!=''){
    $cat = " and `cat_id` in (".$cc.")";
}
if($sortBy!='' || $find!='' || $status!=''){
    $tasks = Tasks::whereRaw("`id`<'".$id."' AND ".$status.$find.$offers.$bs.$beside.$cat)
    ->orderBy('id','desc')
    ->limit(10)
    ->get();
}
else{
    $tasks = Tasks::where([['id','<',$id]])
    ->limit(10)
    ->get();
}
if($tasks->count()!=0)
{
    foreach($tasks as $t)
    {          
        $output .= '<div class="col m12 infinite-scroll" id="rm">
        <div class="card white boxsh2">
        <div class="card-content">
        <a href="'.route('taskview',$t->id).'" class="card-title truncate">'.$t->task.'</a>
        <div class="--sum veralmidd"><span>'.$t->bujet.'</span></div>
        </div>
        <div class="card-action">
        <div class="left">
        <span class="--time grey-text text-darken-1 veralmidd">
        '.$t->start_date.'
        </span>
        </div>

        <div class="right">
        <span class="--category grey-text text-darken-1 veralmidd">
        '.$t->cat_parent_name.'
        </span>
        <span class="--splitted veralmidd">•</span>
        <span class="--city grey-text text-darken-1 veralmidd">
        '.$t->city.'
        </span>
        </div>
        </div>
        </div>
        </div>';
    }

    $output .= '<div class="col m12" id="remove-row">
    <button id="btn-more" data-id="'.$t->id.'" class="btn-flat waves-effect brd2 center-align __js-tasks-more"> показать еще </button>
    </div>';
    echo $output;
} 
}
public function taskview($id)
{
    $tasks = Tasks::where('id',$id)
    ->get();
    if($tasks->count()<=0){
        return redirect('/');
    }
    $data = array(
        'tasks' => $tasks
    );
    return view('tasks.task')->with($data);
}
public function task_update($id, $status)
{   
    if($status=='done'){
        $data = array(
            'status' => '1'
        );
    }
    else{
        $data = array(
            'status' => '0'
        );
    }
    DB::table('tasks')->where('id',$id)->update($data);
    return back()->with('success','Task updated');
}
public function loadTasksAjaxFilter(Request $request)
{
    $output = '';
    $find = '';
    if($request->find!=''){
        $find = " AND `task` like '%".$request->find."%'";
    }
    $offers = '';
    if($request->offers!=''){
        if($request->offers=='yes'){
            $offers = "";
        }
    }
    $beside = '';
    if($request->beside!=''){
        if($request->beside=='yes'){
            $beside = "";
        }
    }
    $bs = '';
    if($request->bs!=''){
        if($request->bs=='yes'){
            $bs = "";
        }
    }
    $status = '';
    if($request->status!='' && $request->status!='undefined'){
        $status = " `status`='".$request->status."'";
    }
    else{
        $status = " `status`='0'";
    }
    $sortBy = '';
    if($request->sortBy!=''){
        if($request->sortBy=='last'){
            $sortBy = " ORDER BY `id` DESC";
        }
        if($request->sortBy=='urgently'){
            $sortBy = " ORDER BY `id` DESC";
        }
    }
    else{
       $sortBy = " ORDER BY `id` DESC"; 
   }
   $cat = '';
   $c = explode(',',$request->cat);
   $cc = '';
   for($i=0; $i<=count($c)-1; $i++){
    if((count($c)-1)==$i){
        $cc .= "'".$c[$i]."'";
    }
    else{
        $cc .= "'".$c[$i]."',";                
    }
}
if($request->cat!=''){
    $cat = " and `cat_id` in (".$cc.")";
}
if($sortBy!='' || $find!='' || $status!=''){
    $tasks = Tasks::whereRaw($status.$find.$offers.$bs.$beside.$cat)
    ->orderBy('id','desc')
    ->limit(10)
    ->get();
}
else{
    $tasks = Tasks::limit(10)
    ->get();
} 
if($tasks->count()!=0)
{
    foreach($tasks as $t)
    {          
        $output .= '<div class="col m12 infinite-scroll" id="rm">
        <div class="card white boxsh2">
        <div class="card-content">
        <a href="'.route('taskview',$t->id).'" class="card-title truncate">'.$t->task.'</a>
        <div class="--sum veralmidd"><span>'.$t->bujet.'</span></div>
        </div>
        <div class="card-action">
        <div class="left">
        <span class="--time grey-text text-darken-1 veralmidd">
        '.$t->start_date.'
        </span>
        </div>

        <div class="right">
        <span class="--category grey-text text-darken-1 veralmidd">
        '.$t->cat_parent_name.'
        </span>
        <span class="--splitted veralmidd">•</span>
        <span class="--city grey-text text-darken-1 veralmidd">
        '.$t->city.'
        </span>
        </div>
        </div>
        </div>
        </div>';
    }

    $output .= '<div class="col m12" id="remove-row">
    <button id="btn-more" data-id="'.$t->id.'" class="btn-flat waves-effect brd2 center-align __js-tasks-more" > показать еще </button>
    </div>';
    echo $output;
} 
}
}
