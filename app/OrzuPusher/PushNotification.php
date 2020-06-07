<?php

namespace App\OrzuPusher;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\User;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount;

class PushNotification extends Model
{
	protected $table = 'push_notifications';

	public static function UserNotifiesList($userid) {
		$q = PushNotification::where('user_id',$userid)->get();
		$PushList = '';
		if($q->count()!=0){
			foreach ($q as $r) {
				$PushList .= '<div class="--list">
				<div class="--item">
				<i class="material-icons">fiber_manual_record</i>
				<a href="'.$r->direct.'">'.$r->message.'</a>
				<span>'.$r->date.'</span>
				</div>
				</div>';
			}
		} else {
			$PushList .= '<div class="--noPush">Нет уведомлений</div>';
		}
		echo $PushList;
	}

	//Отправляет пуш всем пользователям, которые подписаны на определенную категорию по catid
	public static function SendUser($userid, $city, $title, $message, $task_id) {
		$date = Carbon::now('Asia/Almaty');
		$data = array (
			'user_id' => $userid,
			'title' => $title,
			'message' => $message,
			'direct' => 'user_'.$userid,
			'date' => date('Y-m-d H:i:s', strtotime($date))
		);
		PushNotification::insert($data);

		$topic = 'user_'.$userid;
		
		$factory = (new Factory())->withServiceAccount(__DIR__.'/orzu-pusher-firebase-adminsdk-mcdse-0f17b8acde.json');
		$messaging = ($factory)->createMessaging();
		$message = CloudMessage::fromArray([
		'topic' => $topic,
		'notification' => [
		'title' => $title,
		'body' => $message,
		], // optional
		'data' => ['ID'=>$task_id,
		'city'=>$city], // optional
		]);
		$messaging->send($message);
	}

	//Отправляет пуш для определенного юзера по userid
	public static function SendCategories($userid, $catid, $city, $title, $message, $task_id) {
		$date = Carbon::now('Asia/Almaty');
		$data = array (
			'user_id' => $userid,		
			'title' => $title,
			'message' => $message,
			'direct' => 'cat_'.$catid,
			'date' => date('Y-m-d H:i:s', strtotime($date))
		);
		PushNotification::insert($data);


		$topic = 'cat_'.$catid;
		
		$factory = (new Factory())->withServiceAccount(__DIR__.'/orzu-pusher-firebase-adminsdk-mcdse-0f17b8acde.json');
		$messaging = ($factory)->createMessaging();
		$message = CloudMessage::fromArray([
		'topic' => $topic,
		'notification' => [
		'title' => $title,
		'body' => $message,
		], // optional
		'data' => ['ID'=>$task_id,
		'city'=>$city], // optional
		]);
		$messaging->send($message);
	}
}
