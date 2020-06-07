<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use App\OrzuPusher\SendForOneUser;
use App\OrzuPusher\PushNotification;
use App\OrzuPusher\PusherBeamsServer;
use Illuminate\Notifications\Notification;
use App\OrzuPusher;

class OrzuPusherController extends Controller
{
	public function Send () {
		OrzuPusher::Send('user_497', 'Подписка на категорию', 'Вы подписаны на категорию');
		return 'Отправлено';
	}
}