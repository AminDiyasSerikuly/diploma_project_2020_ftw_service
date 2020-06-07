<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\TasksParam;
use App\TasksRequest;
use App\Lang;
use Config;
use App\User;
use App\UserParam;
use App\Accounts;
use Carbon\Carbon;
use Auth;
use DB;

class Tasks extends Model
{
    //
  protected $table = 'tasks';
  public static function getAccountAmount($user_id)
  {
//    $q = Accounts::where('user_id', $user_id)->get();
      $q = User::where('id', $user_id)->get();
    if($q->count()>0){
      foreach($q as $r){
//        return $r->amount;
          return $r->wallet;
      }
    } else {
      return '0';
    }
  }
  public function getCatNameAttribute()
  {
   $q = Category::where('id', $this->cat_id);
   foreach($q as $r){
    return $r->name;
  }
}

public static function getCatNameAttributeStatic($id_cat)
  {
   $q = Category::where('id', $id_cat)->get();  
   foreach($q as $r){
    return $r->name;
  }
}

public static function getAuthorTask($taskid) {
  $q = Tasks::where('id',$taskid)->get();
  foreach($q as $r){
    $userid = $r->user_id;
  }
  return $userid;
}
public static function getAuthorTaskRequest($id) {
  $q = TasksRequest::where('id',$id)->get();
  foreach($q as $r){
    $userid = $r->user_id;
  }
  return $userid;
}
public static function getTaskIdWithReqiestId($id) {
  $q = TasksRequest::where('id',$id)->get();
  foreach($q as $r){
    $taskid = $r->task_id;
  }
  return $taskid;
}
public function getCcyAttribute()
{
 $q = UserParam::select('meta_value')->where('user_id',$this->user_id)
 ->where('meta_param', 'user_address')
 ->get();
 if($q->count()>0){
  foreach($q as $r){
   switch ($r->meta_value) {
    case 'Душанбе':
    return 'сомони';
    break;
    case 'Dushanbe':
    return 'сомони';
    break;
    case 'Алматы':
    return 'тенге';
    break;
    case 'Almaty':
    return 'тенге';
    break;
    default:
    return 'orzu_coin';
    break;
  }
}
}
else{
  $q = TasksParam::select('value')->where('param','city')
  ->where('task_id',$this->id)
  ->get();
  if($q->count()>0){
   foreach($q as $r){
    switch ($r->value) {
     case 'Душанбе':
     return 'сомони';
     break;
     case 'Dushanbe':
     return 'сомони';
     break;
     case 'Алматы':
     return 'тенге';
     break;
     case 'Almaty':
     return 'тенге';
     break;
     default:
     return 'orzu_coin';
     break;
   }
 }
}
else{
 return 'orzu_coin';
}
}
}
public static function getTaskParamWithID($id, $param)
{
  $q = TasksParam::where([['task_id', '=', $id],['param', '=', $param]])->get();
  foreach($q as $r){
    return $r->value;
  }
}
public static function getTaskRequest($id){
  $task = TasksRequest::where([['task_id','=',$id],['selected','=','0']])
  ->get();
  return $task;
}
public static function getTaskRequestUser($id, $user_id){
  $task = TasksRequest::where([['task_id','=',$id],['user_id','=',$user_id]])
  ->get();
  return $task->count();
}
public static function getTaskRequestGet($id){
  $task = TasksRequest::where([['task_id','=',$id],['selected','=','1']])
  ->get();
  return $task;
}
public static function checkCurrentUser($id, $user_id){
  $task = TasksRequest::where([['task_id','=',$id],['user_id','=',$user_id],['selected','=','1']])
  ->get();
  return $task;
}
public static function getTaskRequestCount($id){
  $task = TasksRequest::where([['task_id','=',$id],['selected','=','0']])
  ->get();
  return $task->count();
}

public static function getUserTaskRequest($id)
{
  $q = TasksRequest::where([['user_id', '=', $id],['selected', '=', '1']])->get();
  return $q->count();
}
public static function getUserTaskCount($id)
{
  $q = DB::table('tasks')->where([['user_id', '=', $id]])->get();
  return $q->count();
}

    #Конверт недели в пропись
public static function getWeekRu($week){
  switch ($week) {
    case '1':
    return Lang::getTrans('monday', Config::get('app.locale'));
    break;
    case '2':
    return Lang::getTrans('thuesday', Config::get('app.locale'));
    break;
    case '3':
    return Lang::getTrans('wendnesday', Config::get('app.locale'));
    break;
    case '4':
    return Lang::getTrans('thursday', Config::get('app.locale'));
    break;
    case '5':
    return Lang::getTrans('friday', Config::get('app.locale'));
    break;
    case '6':
    return Lang::getTrans('saturday', Config::get('app.locale'));
    break;
    case '7':
    return Lang::getTrans('sunday', Config::get('app.locale'));
    break;
    default:
    return 'Нет такой недели!';
    break;
  }
}
public static function getUserParamWithId($id, $param)
{
  $q = DB::table('users_param')->where([['user_id', '=', $id],['meta_param', '=', $param]])->get();
  foreach($q as $r){
    return $r->meta_value;
  }
}
public static function getUserLike($like_user_id, $user_id){
  $q = DB::table('users_stars')->where([['like_user_id', '=', $like_user_id],['user_id', '=', $user_id],['like','<>','3']])->get();
  return $q->count();
}
public static function getUserLikeCount($user_id)
{
  $q = DB::table('users_stars')->where([['like', '=', '3'],['like_user_id', '=', $user_id]])->get();
  return $q->count();
}
public static function getCheckUserLike($id)
{
  $q = DB::table('users_stars')->where([['user_id', '=', Auth::user()->id],['like_user_id', '=', $id]])->get();
  return $q->count();
}
    #Конверт месяца в пропись
public static function getMonthRu($month){
  switch ($month) {
    case '01':
    return Lang::getTrans('january', Config::get('app.locale'));
    break;
    case '02':
    return Lang::getTrans('february', Config::get('app.locale'));
    break;
    case '03':
    return Lang::getTrans('march', Config::get('app.locale'));
    break;
    case '04':
    return Lang::getTrans('april', Config::get('app.locale'));
    break;
    case '05':
    return Lang::getTrans('may', Config::get('app.locale'));
    break;
    case '06':
    return Lang::getTrans('june', Config::get('app.locale'));
    break;
    case '07':
    return Lang::getTrans('july', Config::get('app.locale'));
    break;
    case '08':
    return Lang::getTrans('august', Config::get('app.locale'));
    break;
    case '09':
    return Lang::getTrans('september', Config::get('app.locale'));
    break;
    case '10':
    return Lang::getTrans('october', Config::get('app.locale'));
    break;
    case '11':
    return Lang::getTrans('november', Config::get('app.locale'));
    break;
    case '12':
    return Lang::getTrans('december', Config::get('app.locale'));
    break;
    default:
    return 'Нет такого месяца!';
    break;
  }
}
public function getCreatedDateAttribute()
{
 return $this->getWeekRu(date('N', strtotime($this->created_at))).', '.date('j', strtotime($this->created_at)).' '.$this->getMonthRu(date('m', strtotime($this->created_at))).' '.date('Y', strtotime($this->created_at)).' в '.date('H:i', strtotime($this->created_at));
}
public function getStartDateAttribute()
{
  $q = TasksParam::where('param', 'work_with')
  ->where('task_id',$this->id)
  ->get();
  if($q->count()>0){
    return Lang::getTrans('com_requer', Config::get('app.locale'));
  }
  else{
    $qr = TasksParam::where('param', 'edate')
    ->where('task_id',$this->id)
    ->get();
    if($qr->count()>0){
      foreach($qr as $rr){
        return 'До '.date('j', strtotime($rr->value)).' '.$this->getMonthRu(date('m', strtotime($rr->value))).' '.date('Y', strtotime($rr->value));
      }
    }
    else{
      $qrt = TasksParam::where('param', 'cdate_l')
      ->where('task_id',$this->id)
      ->get();
      if($qrt->count()>0){
        foreach($qrt as $rrt){
          $qt = TasksParam::where('param', 'level_l')
          ->where('task_id',$this->id)
          ->get();
          foreach($qt as $rt){
            $l = $rt->value;
          }                      
          return 'До '.date('j', strtotime($rrt->value)).' '.$this->getMonthRu(date('m', strtotime($rrt->value)));
        }
      }
      else{
        return '';
      }
    }
  }
}
public function getStartDateSAttribute()
{
  $q = TasksParam::where('param', 'work_with')
  ->where('task_id',$this->id)
  ->get();
  if($q->count()>0){
    return Lang::getTrans('com_requer', Config::get('app.locale'));
  }
  else{
    $qr = TasksParam::where('param', 'edate')
    ->where('task_id',$this->id)
    ->get();
    if($qr->count()>0){
      foreach($qr as $rr){
        return 'До '.date('j', strtotime($rr->value)).' '.$this->getMonthRu(date('m', strtotime($rr->value))).' '.date('Y', strtotime($rr->value));
      }
    }
    else{
      $qrt = TasksParam::where('param', 'cdate_l')
      ->where('task_id',$this->id)
      ->get();
      if($qrt->count()>0){
        foreach($qrt as $rrt){
          $qt = TasksParam::where('param', 'level_l')
          ->where('task_id',$this->id)
          ->get();
          foreach($qt as $rt){
            $l = $rt->value;
          }                      
          return 'До '.date('j', strtotime($rrt->value)).' '.$this->getMonthRu(date('m', strtotime($rrt->value))).', '.$this->level_l($l);
        }
      }
      else{
        return '';
      }
    }
  }
}
public function level_l($l)
{
  switch ($l) {
    case '1':
    return Lang::getTrans('every_time', Config::get('app.locale'));
    break;
    case '2':
    return Lang::getTrans('to_12', Config::get('app.locale'));
    break;
    case '3':
    return Lang::getTrans('from_12_to_17', Config::get('app.locale'));
    break;
    case '4':
    return Lang::getTrans('from_17_to_22', Config::get('app.locale'));
    break;
    case '5':
    return Lang::getTrans('after_22', Config::get('app.locale'));
    break; 
    default:
    return '';
    break;
  }
}
public function val_l($l)
{
  switch ($l) {
    case '1':
    return '('.Lang::getTrans('every_time', Config::get('app.locale')).')';
    break;
    case '2':
    return '('.Lang::getTrans('every_time', Config::get('app.locale')).')';
    break;
    case '3':
    return '('.Lang::getTrans('every_time', Config::get('app.locale')).')';
    break;
    case '4':
    return '('.Lang::getTrans('every_time', Config::get('app.locale')).')';
    break;
    case '5':
    return '('.Lang::getTrans('every_time', Config::get('app.locale')).')';
    break;
    case '6':
    return '('.Lang::getTrans('every_time', Config::get('app.locale')).')';
    break;
    default:
    return '';
    break;
  }
}
public function getEndDateAttribute()
{
  $q = TasksParam::where('param', 'work_with')
  ->where('task_id',$this->id)
  ->get();
  if($q->count()>0){
    return '';
  }
  else{
    $qr = TasksParam::where('param', 'edate')
    ->where('task_id',$this->id)
    ->get();
    if($qr->count()>0){
      foreach($qr as $rr){
        return date('j', strtotime($rr->value)).' '.$this->getMonthRu(date('m', strtotime($rr->value))).' '.date('Y', strtotime($rr->value));
      }
    }
    else{
      return '';
    }
  }
}
public function getBujetAttribute()
{
  $q = TasksParam::where('param','amout')->where('task_id', $this->id)->get();
  if($q->count()>0){
    foreach($q as $r){
      return  $r->value.' '.$this->getTaskParamWithID($this->id, 'current');
    }
  } else {
    $q = TasksParam::where('param','no_amount')->where('task_id', $this->id)->get();
    if($q->count()>0){
      return Lang::getTrans('no_amount', Config::get('app.locale'));
    } else {
      return '';
    }
  }
}
public function getAddressAttribute()
{
  $q = TasksParam::where('param','address')
  ->where('task_id', $this->id)
  ->get();
  if($q->count()>0){
    foreach($q as $r){
      return '<span class="--js-map ymaps-geolink">'.$r->value.'</span>';
    }
  }
  else{
    $q = TasksParam::where('param','remote')
    ->where('task_id', $this->id)
    ->get();
    if($q->count()>0){
      return Lang::getTrans('remote_do', Config::get('app.locale'));
    }
    else{
      return '';
    }
  }
}
public function getCityAttribute()
{
  $q = TasksParam::where('param','city')
  ->where('task_id', $this->id)
  ->get();
  if($q->count()>0){
    foreach($q as $r){
      return $r->value;
    }
  }
}
public function getFilesAttribute()
{
  $q = TasksParam::where('param','image')
  ->where('task_id', $this->id)
  ->get();
  $files ='';
  // $files =[];
  if($q->count()>0){
    foreach($q as $r){
      // $files .= '<a href="'.asset($r->value).'">'.basename($r->value).'</a>, ';
      $files .= '<img src="' .asset($r->value). '" class="task-image-each">';
    }
    return $files;
  }
  else{
    return '';
  }
}
public function getUserNameAttribute()
{
  $q = User::where('id', $this->user_id)->get();
  foreach($q as $r){
    return $r->name.' '.$r->fname;
  }
}
public function getUserPhoneAttribute()
{
  $q = User::where('id', $this->user_id)->get();
  foreach($q as $r){
    return $r->phone;
  }
}
public function getRealStatusAttribute()
{
  switch ($this->status) {
    case '0':
    return '<span class="label label-success">Активный</span>';
    break;
    case '1':
    return '<span class="label label-danger">Завершенный</span>';
    break;
    default:
          # code...
    break;
  }
}
public static function getUserCatChecked($id){
  $cat = UserParam::where([['user_id', '=', $id],['meta_param', '=', 'user_cat']])->get();
  return $cat->count();
}
public static function getCatChecked($id){
  $cat = UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_cat'],['meta_value','like','%;'.$id]])->get();
  if($cat->count()<=0){
    return 0;
  }
  else{
    return 1;
  }
}
public static function getParentCatChecked($id){
  $cat = UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', 'user_cat'],['meta_value','like',$id.';%']])->get();
  if($cat->count()<=0){
    return 0;
  }
  else{
    return 1;
  }
}
public static function getSubCatParam($cat){
  $acc = Category::where('param','like',$cat.'/%')
  ->get();
  return $acc;
}
public static function getCatName($id){
  $q = Category::where('id', $id)->get();
  foreach($q as $r){
    return $r->name;
  }
}
public function getCatParentNameAttribute()
{
  $q = Category::select('name')
  ->where('id',$this->cat_id) 
  ->where('parent_id','0')
  ->get();
  if($q->count()>0){
    foreach($q as $r){
      return $r->name;
    }
  }
  else{
    $q = Category::select('parent_id')
    ->where('id',$this->cat_id) 
    ->get();
    foreach($q as $r){
      $qt = Category::select('name')
      ->where('id',$r->parent_id) 
      ->get();
      foreach($qt as $rt){
        return $rt->name;
      }
    }
  }
}
public static function getSubCatName($id){
  $acc = Category::where('parent_id',$id)
  ->get();
  return $acc;
}
public function getUserEmailAttribute()
{
  $q = User::where('id', $this->user_id)->get();
  foreach($q as $r){
    return $r->email;
  }
}
}
