<?php

namespace App\OrzuPusher;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\User;
use Auth;

class PusherBeams extends Model
{
	protected $table = 'push_notifications';		
	public static function Send($interest, $city, $title, $body, $id)
	{
		try {
			$pushNotification = new \Pusher\PushNotifications\PushNotifications([
				'instanceId' => 'e33cda0a-16d0-41cd-a5c9-8ae60b9b7042',
				'secretKey' => '74F763F2BE759BFC8158ACF237A7F610317D4E49B02C87F697DBCEC80DDF9F37',				
			]);

			$publishResponse = $pushNotification->publishToInterests([$interest], [
				'apns' => [
					'aps' => ['alert' => $body]
				],
				'fcm' => [
					'notification' => [
						'title' => $title,
						'body' => $body
					],
					'data' => [
					'inAppNotificationMessage' => 'Display me somewhere in the app ui!',
					'ID' => $id,
					'city' => $city,					
				]	
					
				]
			]);
		} catch (\Exception $e) {
			return $e;
		}
	}
}
