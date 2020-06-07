<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Accounts;
use App\AccountsTransactions;
use App\UserParam;
use App\User; 
use App\UsersStars; 
use App\Chat;
use App\Tasks;

class Profile extends Model
{
  public static function getAccountCheckTransactions($user_id)
  {
    $q = Accounts::where('user_id', $user_id)->get();
    return $q->count();
  }
  public static function getAccountTrasactions($user_id)
  {
    $q =Accounts::where('user_id', $user_id)->get();
    foreach($q as $r){
      $qt = AccountsTransactions::where('account', $r->account)->get();
      return $qt;
    }
  }
  public static function getUserAge($year)
  {
    $year = abs($year);
    $t1 = $year % 10;
    $t2 = $year % 100;
    return $year.' '.($t1 == 1 && $t2 != 11 ? "год" : ($t1 >= 2 && $t1 <= 4 && ($t2 < 10 || $t2 >= 20) ? "года" : "лет"));
  }
  public static function getUserParam($param)
  {
    $q = UserParam::where([['user_id', '=', Auth::user()->id],['meta_param', '=', $param]])->get();
    foreach($q as $r){
      return $r->meta_value;
    }
  }
  public static function getUserParamCheck($id, $param)
  {
    $q = UserParam::where([['user_id', '=', $id],['meta_param', '=', $param]])->get();
    return $q->count();
  }
  public static function getUserName($id){
    $q = User::select('name')
    ->where('id',$id)
    ->get();
    foreach($q as $r){
      return $r->name;
    }
  }
  public static function getUserMessageId($id)
  {
      /*$q = Chat::where('res_user_id', $id)
                ->orWhere('req_user_id', $id)
                ->get();
      foreach($q as $r){
        return $r->task_id;
      }*/
      $q = Tasks::where('user_id', $id)->orderBy('id', 'desc')->limit(1)->get();
      foreach($q as $r){
        return $r->id;
      }
    }
    public static function getUserSadCount($user_id)
    {
      $q = UsersStars::where([['like', '=', '0'],['like_user_id', '=', $user_id]])->get();
      return $q->count();
    }
    public static function getUserNeutralCount($user_id)
    {
      $q = UsersStars::where([['like', '=', '1'],['like_user_id', '=', $user_id]])->get();
      return $q->count();
    }
    public static function getUserHappyCount($user_id)
    {
      $q = UsersStars::where([['like', '=', '2'],['like_user_id', '=', $user_id]])->get();
      return $q->count();
    }
    public static function getUserLikes($id)
    {
      $q = UsersStars::where([['like_user_id', '=', $id],['like','<>','3']])->get();
      return $q;
    }
    public static function getUserParamWithId($id, $param)
    {
      $q = UserParam::where([['user_id', '=', $id],['meta_param', '=', $param]])->get();
      foreach($q as $r){
        return $r->meta_value;
      }
    }
    public static function getUserEmail($id)
    {
      $q = User::where('id',$id)->get();
      foreach($q as $r){
        return $r->email;
      }
    }
    public static function getUserAvatar($id)
    {
      $q = User::where('id',$id)->get();
      foreach($q as $r){
        return $r->avatar;
      }
    }
    public static function getUserPhone($id)
    {
      $q = User::where('id',$id)->get();
      foreach($q as $r){
        return $r->phone;
      }
    }
    public static function getUserDoc($id)
    {
      $q = User::where('id',$id)->get();
      foreach($q as $r){
        return $r->docstatus;
      }
    }
  }
