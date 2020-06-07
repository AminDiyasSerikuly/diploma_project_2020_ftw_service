<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tasks;
use App\ChatMessages;

class Chat extends Model
{
    //
    protected $table = 'chat';

   	public function getTaskNameAttribute()
   	{
   		$task = Tasks::where('id',$this->task_id)->get();
   		foreach($task as $t){
   			return $t->task;
   		}
	}

	public function getLastChatMessageAttribute()
	{
		$message = ChatMessages::where('chat_id',$this->id)->orderBy('id','desc')->limit(1)->get();
		foreach($message as $m){
			return $m->message;
		}
	}
}
