<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

use App\Tasks;
use App\TasksParam;
use App\Accounts;
use App\UserParam;
use Auth;
use DB;
use Cache;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone','email', 'role_id','password', 'check_phone', 'wallet','uid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->name} ";
    }
    public function getFioAttribute()
    {
        return "{$this->fname} {$this->name} {$this->sname}";
    }
    public function getRoleAttribute()
    {
        switch ($this->role_id) {
            case '1':
            return 'Администратор';
            break;
            case '2':
            return 'Заказчик';
            break;
            case '3':
            return 'Исполнитель';
            break;
            default:
            return 'Не известно';
            break;
        }
    }
    public function getUemailAttribute()
    {
        # code...
        if($this->email!=''){
            return $this->email;
        }
        else{
            return 'Не известно';
        }
    }   
    public function getCdateAttribute()
    {
        # code...
        return date('d.m.Y H:i', strtotime($this->created_at));
    }
    public function getUdateAttribute()
    {
        # code...
        return date('d.m.Y H:i', strtotime($this->updated_at));
    }
    public function getPhoneAccessAttribute()
    {
        # code...
        if($this->check_phone!='1'){
            return 'Не подтвержден';
        }
        else{
            return 'Подтвержден';
        }
    }
    public function getTaskCountAttribute()
    {
        # code...
        $q = Tasks::select('id')->where('user_id',$this->id)->get();
        return $q->count();
    }
    public function getDoneTaskCountAttribute()
    {
        # code...
        $q = Tasks::where([['user_id','=',$this->id],['status','=','1']])->get();
        return $q->count();
    }
    public function getUserAccountAttribute()
    {
        # code...
        $q = Accounts::select('account')->where('user_id', $this->id)->get();
        foreach($q as $r){
            return $r->account;
        }
    }
    public function getUserAccountMoneyAttribute()
    {
        # code...
//        $q = Accounts::select('wallet')->where('user_id', $this->id)->get();
        $q = User::select('wallet')->where('id', $this->id)->get();
        foreach($q as $r){
//            return $r->amount;
            return $r->amount;
        }
    }
    public function getUserDocsAttribute()
    {
        # code...
        $q = UserParam::where('user_id',$this->id)
        ->where('meta_param','document')
        ->get();
        $docs = '';
        if($q->count()>0){
            foreach($q as $r){
                $docs .= '<a href="'.asset($r->meta_value).'">'.basename($r->meta_value).'</a>, ';
            }
        }
        return $docs;
    }
    public function getActiveTaskAmountAttribute()
    {
        $q = Tasks::select('id')
        ->where('user_id',$this->id)
        ->where('status','0')
        ->get();
        $sum = 0;
        foreach($q as $r){
            $qt = TasksParam::select('value')
            ->where('task_id',$r->id)
            ->where('param','amout')
            ->get();
            foreach($qt as $rt){
                $sum += $rt->value;
            }
        }
        return $sum;
    }
    public function getAllTaskAmountAttribute()
    {
        $q = Tasks::select('id')
        ->where('user_id',$this->id)
        ->get();
        $sum = 0;
        foreach($q as $r){
            $qt = TasksParam::select('value')
            ->where('task_id',$r->id)
            ->where('param','amout')
            ->get();
            foreach($qt as $rt){
                $sum += $rt->value;
            }
        }
        return $sum;
    }
    public function getAddressAttribute()
    {
        $q = UserParam::where('meta_param','user_address')
        ->where('user_id', $this->id)
        ->get();
        if($q->count()>0){
            foreach($q as $r){
                return $r->meta_value;
            }
        }
        else{
            return 'Не определен';
        }
    }
    public static function isOnline($id)
    {
        return Cache::has('user-is-online-'.$id);
    }
}
