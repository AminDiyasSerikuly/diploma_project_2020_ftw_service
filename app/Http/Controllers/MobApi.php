<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Api\ApiKey;
use App\Api\UserToken;
use App\Tasks;
use App\TasksParam;
use App\TasksRequest;
use App\User;
use App\UserParam;
use App\UserBonus;
use App\Partners;
use App\Partners_sales;
use App\UsersStars;
use App\Profile;
use App\Portfolio;
use App\PortfolioImages;
use App\Currently;
use App\City;
use App\Country;
use App\OrzuPusher\PushNotification;
use Carbon\Carbon;
use App\Api\ApiLog;
use Hash;
use DB;
use Image;
use File;
use App\SendSMS\Sendsmslog;
use App\SendSMS\SendSMSModel;

class MobApi extends Controller
{
    //
	
	function array_trim($array) {
    while (!empty($array) and strlen(reset($array)) === 0) {
        array_shift($array);
    }
    while (!empty($array) and strlen(end($array)) === 0) {
        array_pop($array);
    }
    return $array;
}
	
	public function getApi()
	{
		$date = Carbon::now('Asia/Almaty')->format('Y-m-d H:i:s'); 
		$data = array(
			'log' => json_encode(request()->server())
		);
		$del = array('(',')',' ','-','+');
		ApiLog::insert($data);
		//Проверка ключа API
		if(request()->appid==ApiKey::getMyKey()){
			//Вывод категорий
			if(request()->opt=='view_cat'){
				//Вывод всех категорий
				if(request()->cat_id=='all' || request()->cat_id==''){
					$q = Category::select('id','name', 'parent_id')->where('lang',request()->lang)->get();
					if($q->count()>0){
						return response()->json($q, 200); 
					}
					else{
						goto errror;
					}
					return response()->json($q, 200); 
				}
				//Список главных категорий
				else if(request()->cat_id=='only_parent'){
					$q = Category::select('id','name', 'parent_id')
					->where('lang',request()->lang)
					->where('parent_id','0')
					->get();
					if($q->count()>0){
						return response()->json($q, 200); 
					}
					else{
						goto errror;
					}
				}
				//Список подкатегорий
				else if(request()->cat_id=='only_subcat'){
					$q = Category::select('id','name', 'parent_id')
					->where('lang',request()->lang)
					->where('parent_id', request()->id)
					->get();
					if($q->count()>0){
						return response()->json($q, 200); 
					}
					else{
						goto errror;
					}
				}
				else{
					$q = Category::select('id','name', 'parent_id')
					->where('lang',request()->lang)
					->where('id',request()->cat_id)
					->get();
					if($q->count()>0){
						return response()->json($q, 200); 
					}
					else{
					}
				}
			}
			//Работаем с заданиями
			else if(request()->opt=='view_task'){
				//Выводит все задания
				if(request()->tasks=='all'){
					//Выводит задания с пагинацией (0 и 1 одинаковый результат / одна страница показывает 5 заданий)
					if(request()->page!='' && request()->page!='0'){
						$page = request()->page;
					}
					else{
						$page = 1;
					}
					//Выводит только актуальные задания
					if(request()->status=='open'){
						$q = DB::select("SELECT b.id, 
							b.task, 
							b.cat_id as sub_cat_id, 
							(select a.name from category a where a.id=b.cat_id) as sub_cat_name, 
							(select a.parent_id from category a where a.id=b.cat_id) as cat_id,
							(select c.name from category c where c.id=(select a.parent_id from category a where a.id=b.cat_id)) as cat_id,
							ifnull((select d.value from tasks_param d where d.param='amout' and d.task_id=b.id),'Предложите цену') as amount,
							(select d.value from tasks_param d where d.param='current' and d.task_id=b.id) as current,
							(select d.value from tasks_param d where d.param='cdate' and d.task_id=b.id) as cdate,
							(select d.value from tasks_param d where d.param='edate' and d.task_id=b.id) as edate,
							(select d.value from tasks_param d where d.param='cdate_l' and d.task_id=b.id) as cdate_l,
							(select d.value from tasks_param d where d.param='level_l' and d.task_id=b.id) as level_l,
							(select d.value from tasks_param d where d.param='work_with' and d.task_id=b.id) as work_with,
							(select d.value from tasks_param d where d.param='city' and d.task_id=b.id) as city,
							b.narrative FROM tasks b WHERE status='0' ORDER BY `id` DESC LIMIT ".(($page-1)*5).",5");
						if(count($q)>0){
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Not tasks yet', 200);
						}
					}
					//Выводит закрытые задания
					else if(request()->status=='close'){
						$q = DB::select("SELECT b.id, 
							b.task, 
							b.cat_id as sub_cat_id, 
							(select a.name from category a where a.id=b.cat_id) as sub_cat_name, 
							(select a.parent_id from category a where a.id=b.cat_id) as cat_id,
							(select c.name from category c where c.id=(select a.parent_id from category a where a.id=b.cat_id)) as cat_id,
							ifnull((select d.value from tasks_param d where d.param='amout' and d.task_id=b.id),'Предложите цену') as amount,
							(select d.value from tasks_param d where d.param='current' and d.task_id=b.id) as current,
							(select d.value from tasks_param d where d.param='cdate' and d.task_id=b.id) as cdate,
							(select d.value from tasks_param d where d.param='edate' and d.task_id=b.id) as edate,
							(select d.value from tasks_param d where d.param='cdate_l' and d.task_id=b.id) as cdate_l,
							(select d.value from tasks_param d where d.param='level_l' and d.task_id=b.id) as level_l,
							(select d.value from tasks_param d where d.param='work_with' and d.task_id=b.id) as work_with,
							(select d.value from tasks_param d where d.param='city' and d.task_id=b.id) as city,
							b.narrative FROM tasks b WHERE status='1' ORDER BY `id` DESC LIMIT ".(($page-1)*5).",5");
						if(count($q)>0){
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Not tasks yet', 200);
						}
					}
					//Delete задания
					else if(request()->delete!=''){
						$getidofTask = request()->delete;	
						$q = DB::table('tasks')
							->where('id',$getidofTask)
							->delete();
						$qt = DB::table('tasks_param')
							->where('task_id',$getidofTask)
							->delete();
						return response()->json($qt, 200);
					} 
					//Выводит задания без откликов по {requests}
					else if(request()->requests=='no'){
						$q = collect(DB::table('task_requests')->pluck('task_id')->all());
						$qq = collect(DB::table('tasks')->pluck('id')->all());
						$items = TasksRequest::select('task_id')
								->get();
						foreach($items as $itemsq){								
								$itemsq = DB::select("SELECT b.id,
									b.task, 
									b.cat_id as sub_cat_id, 
									(select a.name from category a where a.id=b.cat_id) as sub_cat_name, 
									(select a.parent_id from category a where a.id=b.cat_id) as cat_id,
									(select c.name from category c where c.id=(select a.parent_id from category a where a.id=b.cat_id)) as cat_id,
									ifnull((select d.value from tasks_param d where d.param='amout' and d.task_id=b.id),'Предложите цену') as amount,
									(select d.value from tasks_param d where d.param='current' and d.task_id=b.id) as current,
									(select d.value from tasks_param d where d.param='cdate' and d.task_id=b.id) as cdate,
									(select d.value from tasks_param d where d.param='edate' and d.task_id=b.id) as edate,
									(select d.value from tasks_param d where d.param='cdate_l' and d.task_id=b.id) as cdate_l,
									(select d.value from tasks_param d where d.param='level_l' and d.task_id=b.id) as level_l,
									(select d.value from tasks_param d where d.param='work_with' and d.task_id=b.id) as work_with,
									(select d.value from tasks_param d where d.param='city' and d.task_id=b.id) as city,
									(select COUNT(distinct `task_id`) FROM `task_requests` where task_id=b.id) as requests,
									b.narrative FROM tasks b WHERE status='0' ORDER BY `requests` ASC LIMIT ".(($page-1)*5).",5");							
						}
							
						if(count($items)>0){
							
							return response()->json($itemsq, 200); 
						}
						else{
							return response()->json('Not tasks yet', 200);
						}
					}
					//Выводит задания по городам {city}
					else if(request()->city!=''){
						$getcityTasks = request()->city;
						$q = DB::select("SELECT b.id,
							b.task, 
							b.cat_id as sub_cat_id, 
							b.narrative as narrative,
							(select a.name from category a where a.id=b.cat_id) as sub_cat_name, 
							(select a.parent_id from category a where a.id=b.cat_id) as cat_id,
							(select c.name from category c where c.id=(select a.parent_id from category a where a.id=b.cat_id)) as cat_id,
							ifnull((select d.value from tasks_param d where d.param='amout' and d.task_id=b.id),'Предложите цену') as amount,
							(select d.value from tasks_param d where d.param='current' and d.task_id=b.id) as current,
							(select d.value from tasks_param d where d.param='cdate' and d.task_id=b.id) as cdate,
							(select d.value from tasks_param d where d.param='edate' and d.task_id=b.id) as edate,
							(select d.value from tasks_param d where d.param='cdate_l' and d.task_id=b.id) as cdate_l,
							(select d.value from tasks_param d where d.param='level_l' and d.task_id=b.id) as level_l,
							(select d.value from tasks_param d where d.param='work_with' and d.task_id=b.id) as work_with,
							b.city FROM tasks b WHERE city='{$getcityTasks}' and status='0' ORDER BY `id` DESC LIMIT ".(($page-1)*5).",5");						
						if(count($q)>0){
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Not tasks yet', 200);
						}
					}
					//Выводит задания по категориям {catid}
					else if(request()->catid!='' && request()->citycat!='' && request()->requestscat='no' ){						
						for($i=0; $i<=count(request()->catid)-1;$i++){
							$getcatTasks = request()->catid[$i];
							$getcityTasks = request()->citycat;						
							$qq[] = [];
							$q[$i] = DB::select("SELECT b.id,
							b.task,
							b.cat_id as sub_cat_id,
							(select a.name from category a where a.id=b.cat_id) as sub_cat_name,
							(select a.parent_id from category a where a.id=b.cat_id) as cat_id,
							(select c.name from category c where c.id=(select a.parent_id from category a where a.id=b.cat_id)) as cat_id,
							ifnull((select d.value from tasks_param d where d.param='amout' and d.task_id=b.id),'Предложите цену') as amount,
							(select d.value from tasks_param d where d.param='current' and d.task_id=b.id) as current,
							(select d.value from tasks_param d where d.param='cdate' and d.task_id=b.id) as cdate,
							(select d.value from tasks_param d where d.param='edate' and d.task_id=b.id) as edate,
							(select d.value from tasks_param d where d.param='cdate_l' and d.task_id=b.id) as cdate_l,
							(select d.value from tasks_param d where d.param='level_l' and d.task_id=b.id) as level_l,
							(select d.value from tasks_param d where d.param='work_with' and d.task_id=b.id) as work_with,
							(select d.value from tasks_param d where d.param='city' and d.task_id=b.id) as city,	
                                                        (select COUNT(distinct `task_id`) FROM `task_requests` where task_id=b.id ) as requests,						
							b.narrative FROM tasks b WHERE cat_id='{$getcatTasks}' and b.city='{$getcityTasks}' and status='0' ORDER BY id DESC LIMIT ".(($page-1)*5).",5");
							if (0 == count($q[$i])){
								$qq[$i] += $q[$i];
							}
							
						}
						if(count($q) > 0){														
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Not tasks yet', 200);
						}
					}
					//Выводит задания пользователя по {userid}
					else if(request()->userid!=''){
						$getuserTasks = request()->userid;
						$q = DB::select("SELECT b.id,
							b.task,
							b.cat_id as sub_cat_id,
							(select a.name from category a where a.id=b.cat_id) as sub_cat_name,
							(select a.parent_id from category a where a.id=b.cat_id) as cat_id,
							(select c.name from category c where c.id=(select a.parent_id from category a where a.id=b.cat_id)) as cat_id,
							ifnull((select d.value from tasks_param d where d.param='amout' and d.task_id=b.id),'Предложите цену') as amount,
							(select d.value from tasks_param d where d.param='current' and d.task_id=b.id) as current,
							(select d.value from tasks_param d where d.param='cdate' and d.task_id=b.id) as cdate,
							(select d.value from tasks_param d where d.param='edate' and d.task_id=b.id) as edate,
							(select d.value from tasks_param d where d.param='cdate_l' and d.task_id=b.id) as cdate_l,
							(select d.value from tasks_param d where d.param='level_l' and d.task_id=b.id) as level_l,
							(select d.value from tasks_param d where d.param='work_with' and d.task_id=b.id) as work_with,
							(select d.value from tasks_param d where d.param='city' and d.task_id=b.id) as city,
							b.narrative FROM tasks b WHERE user_id='{$getuserTasks}' ORDER BY `id` DESC LIMIT ".(($page-1)*5).",5");
						if(count($q)>0){
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Not tasks yet', 200);
						}
					}
					//Поиск по заданиям (только актуальные задания)
					else if(request()->search!=''){
						$getSearchQ = request()->search;
						$q = DB::select("SELECT b.id, 
							b.task, 
							b.cat_id as sub_cat_id, 
							(select a.name from category a where a.id=b.cat_id) as sub_cat_name, 
							(select a.parent_id from category a where a.id=b.cat_id) as cat_id,
							(select c.name from category c where c.id=(select a.parent_id from category a where a.id=b.cat_id)) as cat_id,
							ifnull((select d.value from tasks_param d where d.param='amout' and d.task_id=b.id),'Предложите цену') as amount,
							(select d.value from tasks_param d where d.param='current' and d.task_id=b.id) as current,
							(select d.value from tasks_param d where d.param='cdate' and d.task_id=b.id) as cdate,
							(select d.value from tasks_param d where d.param='edate' and d.task_id=b.id) as edate,
							(select d.value from tasks_param d where d.param='cdate_l' and d.task_id=b.id) as cdate_l,
							(select d.value from tasks_param d where d.param='level_l' and d.task_id=b.id) as level_l,
							(select d.value from tasks_param d where d.param='work_with' and d.task_id=b.id) as work_with,
							(select d.value from tasks_param d where d.param='city' and d.task_id=b.id) as city,
							b.narrative FROM tasks b WHERE status='0' and task like '%$getSearchQ%' ORDER BY `id` DESC LIMIT ".(($page-1)*5).",5");
						if(count($q)>0){
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Not result yet', 200);
						}
					}
					else{
						$q = DB::select("SELECT b.id, 
							b.task, 
							b.cat_id as sub_cat_id, 
							(select a.name from category a where a.id=b.cat_id) as sub_cat_name, 
							(select f.parent_id from category f where f.id=b.cat_id) as cat_id,
							(select c.name from category c where c.id=(select l.parent_id from category l where l.id=b.cat_id)) as cat_id,
							ifnull((select d.value from tasks_param d where d.param='amout' and d.task_id=b.id),'Предложите цену') as amount,
							(select d.value from tasks_param d where d.param='current' and d.task_id=b.id) as current,
							(select t.value from tasks_param t where t.param='cdate' and t.task_id=b.id) as cdate,
							(select y.value from tasks_param y where y.param='edate' and y.task_id=b.id) as edate,
							(select u.value from tasks_param u where u.param='cdate_l' and u.task_id=b.id) as cdate_l,
							(select d.value from tasks_param d where d.param='level_l' and d.task_id=b.id) as level_l,
							(select d.value from tasks_param d where d.param='work_with' and d.task_id=b.id) as work_with,
							(select i.value from tasks_param i where i.param='city' and i.task_id=b.id) as city,
							b.narrative FROM tasks b  ORDER BY `id` DESC LIMIT ".(($page-1)*5).",5");
						if(count($q)>0){
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Not tasks yet.asdasd', 200);
						}
					}
				}
				//Выводит одно задание по {taskid}
				else{
					$q = Tasks::select('id','task', 'cat_id', 'created_at', 'narrative', 'user_id')->where('id',request()->tasks)->get();
					$qt = TasksParam::select('param', 'value')->where('task_id',request()->tasks)->get();
					if($q->count()>0){
						return response()->json(array($q, $qt), 200);
					}
					else{
						return response()->json('Task not found', 200);
					}
				}
			}
			//Добавление нового задания
			else if(request()->opt=='input_task'){
				if(request()->task!='' && request()->catid!='' && request()->narrative!='' && request()->userid!='' && request()->utoken!=''){
					//Проверяем добавляемого пользователя по его токену, если токен и {userid} совпадают, значит добавляет сам пользователь
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {
						try{
							$data = array(
								'task' 		=> request()->task,
								'cat_id' 	=> request()->catid,
								'narrative' => request()->narrative,
								'user_id' 	=> request()->userid,
								'status'	=> '0',
								'created_at'=> $date,								
								'updated_at'=> $date,
								'city'=> Profile::getUserParamWithId(request()->userid, 'user_address'),								
							);
							Tasks::insert($data);
							$task_id = DB::getPdo()->lastInsertId();
							//Город пользователя
							$dataParams = array(
								'task_id' => $task_id,
								'param' => 'city',
								'value' => Profile::getUserParamWithId(request()->userid, 'user_address')
							);
							
							TasksParam::insert($dataParams);
							//Валюта пользователя на основе его города
							$dataParams = array(
								'task_id' => $task_id,
								'param' => 'current',
								'value' => Profile::getUserParamWithId(request()->userid, 'user_current')
							);
							TasksParam::insert($dataParams);
							//Сроки 1: Договорюсь с исполнителем
							if(request()->date=='wtasker'){
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'work_with',
									'value' => 'reqierer',
								);
								TasksParam::insert($dataParams);
							}
							//Сроки 2: Указать период
							if(request()->date=='period'){
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'cdate',
									'value' => request()->periodA,
								);
								TasksParam::insert($dataParams);
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'edate',
									'value' => request()->periodB,
								);
								TasksParam::insert($dataParams);
							}
							//Сроки 3: Точная дата
							if(request()->date=='exact'){
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'cdate_l',
									'value' => request()->exactD,
								);
								TasksParam::insert($dataParams);
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'level_l',
									'value' => request()->exactT
								);
								TasksParam::insert($dataParams);
							}
							//Указать место
							if(request()->location=='indicate'){
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'address',
									'value' => request()->locationVal,
								);
								TasksParam::insert($dataParams);
							}
							//Удаленно
							if(request()->location=='remote'){
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'remote',
									'value' => 'yes',
								);
								TasksParam::insert($dataParams);
							}
							//Указать цену
							if(request()->price=='indicate'){
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'amout',
									'value' => request()->priceVal,
								);
								TasksParam::insert($dataParams);
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'amount_l',
									'value' => request()->val_l,
								);
								TasksParam::insert($dataParams);
							}
							//Исполнитель предложит цену
							if(request()->price=='wtasker'){
								$dataParams = array(
									'task_id' => $task_id,
									'param' => 'no_amount',
									'value' => 'yes',
								);
								TasksParam::insert($dataParams);
							}							
						
							$city = Profile::getUserParamWithId(request()->userid, 'user_address');

							PushNotification::SendCategories(request()->userid, request()->catid, $city, 'Подписка', 'Новая задача в категории: '.Tasks::getCatNameAttributeStatic(request()->catid), $task_id);
							return response()->json('Task created: '.$task_id, 201);
							
						}
						catch(\Illuminate\Database\QueryException $e){
							goto errror;
						}
					} else {
						return response()->json('User token error', 200);
					}
				}
			}
			//Добавление предложения к задаче
			else if(request()->opt=='task_requests'){
				if(request()->act=='input' && request()->task_id!='' && request()->narrative!='' && request()->userid!='' && request()->amount!='' && request()->utoken!=''){
					//Проверяем добавляемого пользователя по его токену, если токен и {userid} совпадают, значит добавляет сам пользователь
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {
					$Task = Tasks::where('id', request()->task_id)->get();
					foreach ($Task as $rTask) {
						$getUserid = $rTask->user_id;
						$getTaskid = $rTask->task;
					}
						//Если пользователь уже добавлял предложение
						if(Tasks::getTaskRequestUser(request()->task_id, request()->userid)>0) {
							return response()->json('This user has already added a request', 208);
						//Если пользователь не добавлял предложение, то добавляем запрос
						} else {
							try {
								$city = Profile::getUserParamWithId(request()->userid, 'user_address');
								$data = array(
									'user_id'       => request()->userid,
									'task_id'       => request()->task_id,
									'narrative'     => request()->narrative,
									'amount'        => request()->amount,
									'current'	=> Profile::getUserParamWithId(request()->userid, 'user_current'),
									'secure'        => '0',
									'request_not'   => '0',
									'time_request'  => '0',
									'selected'      => '0'
								);
								TasksRequest::insert($data);
								PushNotification::SendUser($getUserid, $city, 'Отличная новость!', 'У вас новое предложение!', 'my.'.request()->task_id);
								return response()->json('Request added', 201);
							}
							catch(\Illuminate\Database\QueryException $e){
								goto errror;
							}
						}
					} else {
						return response()->json('User token error', 200);
					}

				}
				//Выводит список добавленных предложений к задании
				else if(request()->act=='view' && request()->task_id!='') {
					$q = TasksRequest::select('id','user_id','narrative','amount')->where('task_id', request()->task_id)->get();
					if($q->count()>0){
						$qq = DB::select("SELECT a.user_id, 
							(select b.name from users as b where b.id = a.user_id) as username,
							(select b.avatar from users as b where b.id = a.user_id) as avatar,
							(select c.phone from users as c where c.id = a.user_id) as userphone,
							(select count(d.like) as COL from users_stars as d where d.like='0' AND d.like_user_id = a.user_id) as userstars_sad,
							(select count(e.like) as COL from users_stars as e where e.like='1' AND e.like_user_id = a.user_id) as userstars_neutral,
							(select count(f.like) as COL from users_stars as f where f.like='2' AND f.like_user_id = a.user_id) as userstars_happy,
							a.id, a.user_id, a.narrative, a.amount, a.current, a.selected FROM task_requests as a WHERE a.task_id = '".request()->task_id."'");
						return response()->json($qq, 200);
					} else {
						return response()->json('No request yet', 200);
					}
				}
				//Выбор исполнителя
				else if(request()->act=='selected' && request()->req_id!='' && request()->utoken!='' && request()->userid!=''){
					//Вытаскивает id задания из предложения (отклик)
					$TaskRequest = TasksRequest::where('id', request()->req_id)->get();
					foreach($TaskRequest as $rRequest){
						$getTaskId = $rRequest->task_id;
						$getUserToid = $rRequest->user_id;
						
					}
					//Вытаскиваем id пользователя из задания на основе отклика
					$Task = Tasks::where('id', $getTaskId)->get();
					foreach ($Task as $rTask) {
						$getUserid = $rTask->user_id;
						$getTaskName = $rTask->task;
					}
					//На основе request()->req_id и $getTaskId и $getUserid, а так же utoken, проверяем юзера, кто выбирает исполнителя
					if(request()->utoken==UserToken::getMyToken(request()->userid) && request()->userid==$getUserid) {
						$data = array(
							'selected' => '1'
						);
						$dataTasks = array(
							'status' => '1'
						);
						DB::table('task_requests')->where('id',request()->req_id)->update($data);
						DB::table('tasks')->where('id',$getTaskId)->update($dataTasks);
						$city = Profile::getUserParamWithId(request()->userid, 'user_address');						
						PushNotification::SendUser($getUserToid, $city, 'Отличная новость!', 'Вас выбрали исполнителем задачи: '.$getTaskName, $getTaskId.'');
						return response()->json('Request selected', 200);
					} else {
						return response()->json('Access error: User token or user id empty. Or token and userid mismatched.'.$getUserid, 200);
					}
				}
			}
			else if(request()->opt=='view_user'){
				if(request()->param=='more' && request()->user!=''){
					$uID = request()->user;
					$q = User::select('id', 'name', 'fname', 'email', 'phone', 'avatar', 'wallet')->where('id',$uID)->get();
					foreach($q as $qq){
						$data = array(
							'id' => $qq->id,
							'name' => $qq->name,
							'fname' => $qq->fname,
							'email' => $qq->email,
							'phone' => $qq->phone,
							'wallet' => $qq->wallet,
							'avatar' => $qq->avatar,
							'status' => User::isOnline(request()->user),
							'sex' => Profile::getUserParamWithId($uID, 'user_sex'),
							'sad' => Profile::getUserSadCount($uID),
							'neutral' => Profile::getUserNeutralCount($uID),
							'happy' => Profile::getUserHappyCount($uID),
							'city' => Profile::getUserParamWithId($uID, 'user_address'),
							'current' => Profile::getUserParamWithId($uID, 'user_current'),
							'task_requests' => Tasks::getUserTaskRequest($uID),
							'tasks' => Tasks::getUserTaskCount($uID),
							'about' => Profile::getUserParamWithId($uID, 'user_about'),
							'birthday' => Profile::getUserParamWithId($uID, 'bday').'.'.Profile::getUserParamWithId($uID, 'bmonth').'.'.Profile::getUserParamWithId($uID, 'byear'),
						);						
					}
					if($q->count()>0){
						return response()->json($data, 200);
					}
					else{
						goto errror;
					}
				//Выводит полные данные пользователя
				} else if(request()->user!='') {
					$q = User::select('id', 'name', 'fname', 'email', 'phone', 'avatar')->where('id',request()->user)->get();
					foreach($q as $qq){
						$data = array(
							'id' => $qq->id,
							'name' => $qq->name,
							'fname' => $qq->fname,
							'email' => $qq->email,
							'phone' => $qq->phone,
							'avatar' => $qq->avatar,
							'status' => User::isOnline(request()->user),
							'sad' => Profile::getUserSadCount(request()->user),
							'neutral' => Profile::getUserNeutralCount(request()->user),
							'happy' => Profile::getUserHappyCount(request()->user)
						);						
					}
					if($q->count()>0){
						return response()->json($data, 200);
					}
					else{
						goto errror;
					}
				//Выводит список доступных альбомов из портфолио
				} else if(request()->portfolio!='') {
					$q = Portfolio::select('id', 'user_id', 'portfolio_name', 'narrative')->where('user_id',request()->portfolio)->get();
					if($q->count()>0){
						return response()->json($q, 200);
					} else {
						return response()->json('No portfolio yet', 200);
					}
				//Выводит доступный список фотографий портфолио по id portfolio
				} else if(request()->portfolioImages!='') {
					$q = PortfolioImages::select('id', 'portfolio_id', 'img_path', 'img_thumbnail_path')->where('portfolio_id',request()->portfolioImages)->get();
					if($q->count()>0){
						return response()->json($q, 200);
					} else {
						return response()->json('No images yet', 200);
					}
				//Выводит список категорий, на которые подписан пользователь
				} else if(request()->user_cat!='') {
					$ol = array();
					$q = UserParam::where([['user_id', '=', request()->user_cat],['meta_param', '=', 'user_cat']])->get();
					if($q->count()>0){
						foreach($q as $uc){
							$qq = explode(';', $uc->meta_value);
							for($i=0; $i<count($qq); $i++){
								$ol[$qq[1]] = Tasks::getCatName($qq[1]);
							}
						}
						return $ol;
					} else {
						return response()->json('No subscribe categories', 200);
					}
				}
			}
			else if(request()->opt=='user_param'){

					//Выводит моих партнеров и скидки по категориям и городам плюс сортировка {catid}
					if(request()->act=='partners_list_sales_my' && request()->idPartner!=''){
	 		$q = Partners::select('id', 'userid', 'name', 'discription', 'images', 'logo', 'city', 'catid', 'percent', 'date' )->where('userid', request()->idPartner)->get();	
			$qq = Partners_sales::select('id', 'idPartner', 'namePartner', 'sale_name', 'description', 'image', 'partner_city' , 'partners_cat' , 'partners_subcat' , 'sale_percent' , 'create_date' )->where('idPartner', request()->idPartner)->get();	
						$final = $q->merge($qq);				
						if(count($q) > 0){														
							return response()->json($final, 200); 
						}
						else{
							return response()->json('Нет партнёров в данной категории', 200);
						}
					}

					//Выводит моих партнеров и скидки по категориям и городам плюс сортировка {catid}
					if(request()->act=='partners_list_sales_sort' && request()->catid!='' && request()->city!='' && request()->sort!=''){
	 		$q = Partners::select('id', 'userid', 'name', 'discription', 'images', 'logo', 'city', 'catid', 'percent', 'date' )->where('userid', request()->idPartner)->get();	
			$qq = Partners_sales::select('id', 'idPartner', 'namePartner', 'sale_name', 'description', 'image', 'partner_city' , 'partners_cat' , 'partners_subcat' , 'sale_percent' , 'create_date' )->where('partners_cat', request()->catid)->where('partner_city', request()->city)->get();	
						$final = $q->merge($qq);				
						if(count($q) > 0){														
							return response()->json($final, 200); 
						}
						else{
							return response()->json('Нет партнёров в данной категории', 200);
						}
					}


					//Выводит моих партнеров и скидки по категориям и городам плюс сортировка {catid}
					if(request()->act=='partners_list_sales_all'){
	 		$q = Partners::select('id', 'userid', 'name', 'discription', 'images', 'logo', 'city', 'catid', 'percent', 'date' )->get();	
			$qq = Partners_sales::select('id', 'idPartner', 'namePartner', 'sale_name', 'description', 'image', 'partner_city' , 'partners_cat' , 'partners_subcat' , 'sale_percent' , 'create_date' )->get();	
						$final = $q->merge($qq);				
						if(count($q) > 0){														
							return response()->json($final, 200); 
						}
						else{
							return response()->json('Нет партнёров в данной категории', 200);
						}
					}
					

					//Выводит партнеров по категориям и городам плюс сортировка {catid}
					if(request()->act=='partners_list_my' && request()->idPartner!=''){
	 		$q = Partners::select('id', 'userid', 'name', 'discription', 'images', 'logo', 'city', 'catid', 'percent', 'date')->where('userid', request()->idPartner)->get();
						if(count($q) > 0){														
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Нет партнёров в данной категории', 200);
						}
					}

					//Выводит партнеров по категориям и городам плюс сортировка {catid}
					if(request()->act=='partners_list_sort' && request()->catid!='' && request()->city!='' && request()->sort!=''){
	 		$q = Partners::select('id', 'userid', 'name', 'discription', 'images', 'logo', 'city', 'catid', 'percent', 'date')->where('catid', request()->catid)->where('city', request()->city)->get();
						if(count($q) > 0){														
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Нет партнёров в данной категории', 200);
						}
					}

					
					//Выводит партнеров по категориям и городам плюс сортировка {catid}
					if(request()->act=='partners_list_all'){
	 		$q = Partners::select('id', 'userid', 'name', 'discription', 'images', 'logo', 'city', 'catid', 'percent', 'date' )->get();
						if(count($q) > 0){														
							return response()->json($q, 200); 
						}
						else{
							return response()->json('Нет партнёров в категориях', 200);
						}
					}

					//Выводит скидки по категориям и городам плюс сортировка {catid}
					if(request()->act=='sales_list_my' && request()->id!=''){
	 		$qq = Partners_sales::select('id', 'idPartner', 'namePartner', 'sale_name', 'description', 'image', 'partner_city' , 'partners_cat' , 'partners_subcat' , 'sale_percent' , 'create_date' )->where('idPartner', request()->id)->get();	
						if(count($qq) > 0){														
							return response()->json($qq, 200); 
						}
						else{
							return response()->json('Нет партнёров в данной категории', 200);
						}
					}

					//Выводит скидки по категориям и городам плюс сортировка {catid}
					if(request()->act=='sales_list_my_all' && request()->idPartner!=''){
	 		$qq = Partners_sales::select('id', 'idPartner', 'namePartner', 'sale_name', 'description', 'image', 'partner_city' , 'partners_cat' , 'partners_subcat' , 'sale_percent' , 'create_date' )->where('idPartner', request()->idPartner)->get();	
						if(count($qq) > 0){														
							return response()->json($qq, 200); 
						}
						else{
							return response()->json('Нет партнёров в данной категории', 200);
						}
					}

					//Выводит скидки по категориям и городам плюс сортировка {catid}
					if(request()->act=='sales_list_sort' && request()->catid!='' && request()->city!='' && request()->sort!=''){
	 		$qq = Partners_sales::select('id', 'idPartner', 'namePartner', 'sale_name', 'description', 'image', 'partner_city' , 'partners_cat' , 'partners_subcat' , 'sale_percent' , 'create_date' )->where('partners_subcat', request()->catid)->where('partner_city', request()->city)->get();	
						if(count($qq) > 0){														
							return response()->json($qq, 200); 
						}
						else{
							return response()->json('Нет партнёров в данной категории', 200);
						}
					}

					//Выводит скидки по категориям и городам плюс сортировка {catid}
					if(request()->act=='sales_list_all'){
	 		$qq = Partners_sales::select('id', 'idPartner', 'namePartner', 'sale_name', 'description', 'image', 'partner_city' , 'partners_cat' , 'partners_subcat' , 'sale_percent' , 'create_date' )->get();	
						if(count($qq) > 0){														
							return response()->json($qq, 200); 
						}
						else{
							return response()->json('Нет партнёров в данной категории', 200);
						}
					}



				//Выводит список бонусов
				if(request()->act=='bonus_list' && request()->userid!='') {
					$q = UserBonus::select('idUser','date','value','reason', 'pl_mn')->where('idUser', request()->userid)->get();
					if($q->count()>0){						
						return response()->json($q, 200);
					} else {
						return response()->json('No bonus yet', 200);
					}
				}

				//Добавление скидки от партнера
				if(request()->act=='create_partners_sale' && request()->idUser!='' && request()->idPartner!='' && request()->utoken!=''&& request()->namePartner!='' && request()->sale_name!=''  && request()->description!=''  && request()->partner_city!=''  && request()->partners_cat!=''  && request()->partners_subcat!=''  && request()->sale_percent!=''){
					//Проверяем токен пользователя
					if(request()->utoken==UserToken::getMyToken(request()->idUser)) {		
							$dataPartner = array(
								'idPartner' => request()->idPartner,
								'namePartner' => request()->namePartner,
								'sale_name' => request()->sale_name,
								'description' => request()->description, 
								'partner_city' => request()->partner_city,
								'partners_cat' => request()->partners_cat, 
								'partners_subcat' => request()->partners_subcat,
								'sale_percent' => request()->sale_percent,
								'create_date' => $date
								);
								Partners_sales::insert($dataPartner);	
								$sale_id = DB::getPdo()->lastInsertId();					
							return response()->json('Скидка от партнера создана: '.$sale_id, 200);								
							} else {
						return response()->json('User token error', 200);
					}
				}

				//Добавление партнера
				if(request()->act=='create_partner' && request()->userid!='' && request()->utoken!=''&& request()->name!='' && request()->partnersdisc!=''&& request()->city!='' && request()->subcatid!=''&& request()->percent!=''){
					//Проверяем токен пользователя
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {		
							$dataPartner = array(
								'userid' => request()->userid,
								'name'   => request()->name,
								'discription'  => request()->partnersdisc,
								'city'  => request()->city,
								'catid'  => request()->subcatid,
								'percent'  => request()->percent,								
								'date' => $date 
								);
								Partners::insert($dataPartner);	
								$partner_id = DB::getPdo()->lastInsertId();											
							return response()->json('Зарегестрирован новый партнер: '.$partner_id, 200);								
							} else {
						return response()->json('User token error', 200);
					}
				}

				//Добавление бонусов
				if(request()->act=='edit_bonus_plus' && request()->userid!='' && request()->utoken!='' && request()->useridTo!=''){
					//Проверяем токен пользователя
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {							
							$q = User::select('wallet')->where('id',request()->useridTo)->value('wallet') + 100;	
								$data = array(									
									'wallet' => $q,
								);
								User::where('id',request()->useridTo)
								->update($data);
								$dataBonus = array(
									'idUser'     	=> request()->useridTo,
									'date'   	=> $date,
									'value'   	=> 100,
									'reason'   	=> 'Регистрация друга', 
									'pl_mn'   	=> '+' 
								);
								UserBonus::insert($dataBonus);						
							return response()->json($q, 200);								
							} else {
						return response()->json('User token error', 200);
					}
				}

				if(request()->act=='edit_bonus_feedback_plus' && request()->userid!='' && request()->utoken!='' && request()->useridTo!=''){
					//Проверяем токен пользователя
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {							
							$q = User::select('wallet')->where('id',request()->useridTo)->value('wallet') + 100;	
								$data = array(									
									'wallet' => $q,
								);
								User::where('id',request()->useridTo)
								->update($data);
								$dataBonus = array(
									'idUser'     	=> request()->useridTo,
									'date'   	=> $date,
									'value'   	=> 100,
									'reason'   	=> 'Отзыв положительный',
									'pl_mn'   	=> '+' 
								);
								UserBonus::insert($dataBonus);	
							$qq = User::select('wallet')->where('id',request()->userid)->value('wallet') + 100;	
								$dataq = array(									
									'wallet' => $qq,
								);
								User::where('id',request()->userid)
								->update($dataq);
								$dataBonusq = array(
									'idUser'     	=> request()->userid,
									'date'   	=> $date,
									'value'   	=> 100,
									'reason'   	=> 'Оставленный отзыв',
									'pl_mn'   	=> '+' 
								);
								UserBonus::insert($dataBonusq);						
							return response()->json('Спасибо за отзыв!', 200);								
							} else {
						return response()->json('User token error', 200);
					}
				}

				if(request()->act=='edit_bonus_feedback_minus' && request()->userid!='' && request()->utoken!='' && request()->useridTo!=''){
					//Проверяем токен пользователя
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {							
							$q = User::select('wallet')->where('id',request()->useridTo)->value('wallet') - 100;	
								$data = array(									
									'wallet' => $q,
								);
								User::where('id',request()->useridTo)
								//->update($data);
								$dataBonus = array(
									'idUser'     	=> request()->useridTo,
									'date'   	=> $date,
									'value'   	=> 100,
									'reason'   	=> 'Отзыв отрицательный', 
									'pl_mn'   	=> '-' 
								);
								UserBonus::insert($dataBonus);	
							$qq = User::select('wallet')->where('id',request()->userid)->value('wallet') + 100;	
								$dataq = array(									
									'wallet' => $qq,
								);
								User::where('id',request()->userid)
								->update($dataq);
								$dataBonusq = array(
									'idUser'     	=> request()->userid,
									'date'   	=> $date,
									'value'   	=> 100,
									'reason'   	=> 'Оставленный отзыв', 
									'pl_mn'   	=> '+' 
								);
								UserBonus::insert($dataBonusq);						
							return response()->json('Спасибо за отзыв!', 200);								
							} else {
						return response()->json('User token error', 200);
					}
				}


				if(request()->act=='edit_bonus_minus' && request()->userid!='' && request()->utoken!='' ){
					//Проверяем токен пользователя
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {							
							$q = User::select('wallet')->where('id',request()->userid)->value('wallet') - 100;	
								$data = array(									
									'wallet' => $q,
								);
								User::where('id',request()->userid)
								->update($data);
								$dataBonus = array(
									'idUser'     	=> request()->userid,
									'date'   	=> $date,
									'value'   	=> 100,
									'reason'   	=> 'Размещение задания', 
									'pl_mn'   	=> '-' 
								);
								UserBonus::insert($dataBonus);							
							return response()->json($q, 200);								
							} else {
						return response()->json('User token error', 200);
					}
				}

				//Редактирование города профиля
				if(request()->act=='edit_city' && request()->userid!='' && request()->utoken!='' && request()->city!=''){
					//Проверяем токен пользователя
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {
						UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'user_address']])->delete();
						$data = array(
							'user_id'       => request()->userid,
							'meta_param'    => 'user_address',
							'meta_value'    => request()->city
						);
						UserParam::insert($data);
						//User currently setting
						$city = City::select('contry_id')->where('name',request()->city)->get();
						foreach($city as $r) {
							$getCid = $r->contry_id;
							$q = Currently::select('name')->where('country_id',$getCid)->get();
							foreach($q as $qq) {
								$GetCurrent = $qq->name;
								UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'user_current']])->delete();
								$data = array (
									'user_id' => request()->userid,
									'meta_param' => 'user_current',
									'meta_value' => $GetCurrent
								);
								UserParam::insert($data);
							}
						}						
						UserParam::insert($data);
						return response()->json('Profile city edited', 200);
					} else {
						return response()->json('User token error', 200);
					}
				}

				//Изменение пароля пользователя
				if(request()->act=='edit_password' && request()->userid!='' && request()->utoken!='' && request()->name!='' && request()->password!=''&& request()->old_password!=''){
					//Проверяем токен пользователя
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {
						$q = User::select('password')->where('id',request()->userid)->get();
						
						if($q->count()>0){
							foreach($q as $r){
								if(Hash::check(request()->old_password, $r->password)){
									$data = array(
										'name' => request()->name,
										'password' => Hash::make(request()->password),
									);
									User::where('id',request()->userid)
									->update($data);
									return response()->json('Profile password edited', 200);
								}else{
									return response()->json('Old password Error', 200);
								}		
							}
						}
					}else {
						return response()->json('User token error', 200);
					}
				}

				//Изменение пароля пользователя
				if(request()->act=='forget_password' && request()->phone!='' && request()->password!=''){
					
						$q = User::where('phone', '+'.request()->phone)->get();						
						if($q->count()>0){						
							foreach($q as $r){								
									$data = array(										
										'password' => Hash::make(request()->password),
									);
									User::where('phone','+'.request()->phone)
									->update($data);
									return response()->json('password changed', 200);									
							}
						} else {
							return response()->json('phone doesnt exists', 200);
						}
					}

				//Изменение пароля пользователя
				if(request()->act=='check_phone' && request()->phone!=''){					
						$q = User::where('phone', '+'.request()->phone)->get();						
						if($q->count()>0){						
							return response()->json('phone exists', 200);									
							
						} else {
							return response()->json('phone doesnt exists', 200);
						}
					}				
				
				//Редактирование профиля
				if(request()->act=='edit' && request()->userid!='' && request()->utoken!='' && request()->name!='' && request()->fname!='' && request()->city!='' && request()->about!='' && request()->gender!='' && request()->bday!='' && request()->bmonth!='' && request()->byear!=''){
					//Проверяем токен пользователя
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {
						$data = array(
							'name' => request()->name,
							'fname' => request()->fname
						);
						User::where('id',request()->userid)
						->update($data);
						UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'user_address']])->delete();
						$data = array(
							'user_id'       => request()->userid,
							'meta_param'    => 'user_address',
							'meta_value'    => request()->city
						);
						UserParam::insert($data);
						//User currently setting
						$city = City::select('contry_id')->where('name',request()->city)->get();
						foreach($city as $r) {
							$getCid = $r->contry_id;
							$q = Currently::select('name')->where('country_id',$getCid)->get();
							foreach($q as $qq) {
								$GetCurrent = $qq->name;
								UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'user_current']])->delete();
								$data = array (
									'user_id' => request()->userid,
									'meta_param' => 'user_current',
									'meta_value' => $GetCurrent
								);
								UserParam::insert($data);
							}
						}
						//User about
						UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'user_about']])->delete();
						$data = array(
							'user_id'       => request()->userid,
							'meta_param'    => 'user_about',
							'meta_value'    => request()->about
						);
						UserParam::insert($data);
						//User gender: male/female
						UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'user_sex']])->delete();
						$data = array(
							'user_id'       => request()->userid,
							'meta_param'    => 'user_sex',
							'meta_value'    => request()->gender
						);
						UserParam::insert($data);
						//Birthday|day
						UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'bday']])->delete();
						$data = array(
							'user_id'       => request()->userid,
							'meta_param'    => 'bday',
							'meta_value'    => request()->bday
						);
						UserParam::insert($data);
						//Birthday|month
						UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'bmonth']])->delete();
						$data = array(
							'user_id'       => request()->userid,
							'meta_param'    => 'bmonth',
							'meta_value'    => request()->bmonth
						);
						UserParam::insert($data);
						//Birthday|year
						UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'byear']])->delete();
						$data = array(
							'user_id'       => request()->userid,
							'meta_param'    => 'byear',
							'meta_value'    => request()->byear
						);
						UserParam::insert($data);
						return response()->json('Profile edited', 200);
					} else {
						return response()->json('User token error', 200);
					}
				}
				//settings
				else if(request()->act=='settings') {
					return response()->json('settings started', 200);
				}
				//settings
				else if(request()->act=='subscribe' && request()->userid!='' && request()->cat!='' && request()->utoken!='') {
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {
						UserParam::where([['user_id', '=', request()->userid],['meta_param', '=', 'user_cat']])->delete();
						for($i=0; $i<=count(request()->cat)-1;$i++){
							$data = array(
								'user_id'       => request()->userid,
								'meta_param'    => 'user_cat',
								'meta_value'    => request()->cat[$i]
							);
							UserParam::insert($data);
						}
						return response()->json('Success', 200);
					} else {
						return response()->json('User token error', 200);
					}
				}
			}
			//Выводит отзывы пользователя
			else if(request()->opt=='reviews'){
				if(request()->act=='view'){
					$UserIDRev = request()->userid;
					if(request()->page!='' && request()->page!='0'){
						$page = request()->page;
					}
					else{
						$page = 1;
					}
					//Выводит все отзывы
					if(request()->userid!='' && request()->sort=='all'){
						$q = DB::select("SELECT a.user_id, (select b.name from users as b where b.id=a.user_id) as username,
							(select b.avatar from users as b where b.id = a.user_id) as avatar,
							a.like, a.datein, a.narrative FROM  users_stars as a WHERE a.like_user_id = '{$UserIDRev}' ORDER BY id DESC LIMIT ".(($page-1)*10).",10");
						if(count($q)>0){
							return response()->json($q, 200);
						} else {
							return response()->json('No reviews yet', 200);
						}
					}
					//Выводит только отзывы SAD
					else if(request()->userid!='' && request()->sort=='sad'){
						$q = DB::select("SELECT a.user_id, (select b.name from users as b where b.id=a.user_id) as username,
							(select b.avatar from users as b where b.id = a.user_id) as avatar,
							a.like, a.datein, a.narrative FROM users_stars as a WHERE a.like='0' AND a.like_user_id = '{$UserIDRev}' ORDER BY `id` DESC LIMIT ".(($page-1)*10).",10");
						if(count($q)>0){
							return response()->json($q, 200);
						} else {
							return response()->json('No SAD reviews yet', 200);
						}
					}
					//Выводит только отзывы Neutral
					else if(request()->userid!='' && request()->sort=='neutral'){
						$q = DB::select("SELECT a.user_id, (select b.name from users as b where b.id=a.user_id) as username,
							(select b.avatar from users as b where b.id = a.user_id) as avatar,
							a.like, a.datein, a.narrative FROM users_stars as a WHERE a.like='1' AND a.like_user_id = '{$UserIDRev}' ORDER BY `id` DESC LIMIT ".(($page-1)*10).",10");
						if(count($q)>0){
							return response()->json($q, 200);
						} else {
							return response()->json('No NEUTRAL reviews yet', 200);
						}
					}
					//Выводит только отзывы SAD
					else if(request()->userid!='' && request()->sort=='happy'){
						$q = DB::select("SELECT a.user_id, (select b.name from users as b where b.id=a.user_id) as username,
							(select b.avatar from users as b where b.id = a.user_id) as avatar,
							a.like, a.datein, a.narrative FROM users_stars as a WHERE a.like='2' AND a.like_user_id = '{$UserIDRev}' ORDER BY `id` DESC LIMIT ".(($page-1)*10).",10");
						if(count($q)>0){
							return response()->json($q, 200);
						} else {
							return response()->json('No HAPPY reviews yet', 200);
						}
					}
				}
				else if(request()->act=='input' && request()->userid!='' && request()->narrative!='' && request()->like!='' && request()->like_user_id!='' && request()->utoken!=''){
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {
						try {
							$data = array(
								'user_id'       => request()->userid,
								'remote_addr'   => $_SERVER['REMOTE_ADDR'],
								'like'          => request()->like,
								'datein'        => date('Y-m-d H:i:s'),
								'narrative'     => request()->narrative,
								'like_user_id'  => request()->like_user_id
							);
							UsersStars::insert($data);
							return response()->json('Review added', 201);
						}
						catch(\Illuminate\Database\QueryException $e){
							goto errror;
						}
					} else {
						return response()->json('User token error', 200);
					}
				}
			}
			else if(request()->opt=='user_auth'){
				$q = User::select('phone','password')->where('phone', '+'.request()->phone)->get();
				request()->validate([
					'phone' => 'required|min:9|numeric',
				]);
				if($q->count()>0){
					foreach($q as $r){
						if(Hash::check(request()->password, $r->password)){
							$str = Hash::make(str_random(32)); 
							User::where('phone', '+'.request()->phone)->update(['remember_token' => $str]);
							$q = User::select('id')->where('phone', '+'.request()->phone)->get();
							$r = '';
							foreach($q as $r){
								$id = $r->id;
							}
							$data = array(
								'id' => $id,
								'auth_status' => 'yes',
								'_token' => $str,
							);
							return response()->json($data, 200);
						}
						else{
							return response()->json('noAuth', 400);						
						}
					}
				}
				else{
					goto errror;
				}
			}
			else if(request()->opt=='check_sms'){
				if(request()->phone!='' && request()->code){
					request()->validate([
						'phone' => 'required|min:9|numeric',
						'code' => 'required|min:9|numeric',
					]);
					$q = Sendsmslog::where('phone', request()->phone)->orderBy('id','desc')->limit(1)->get();
					if($q->count()>0){
						foreach($q as $r){
							if($r->message=='CODE: '.request()->code){
								User::where('phone', '+'.request()->phone)->update(['check_phone' => '1']);
								$data = array(
									'check' => 'yes'
								);
								return response()->json($data, 200);
							}
							else{
								goto errror;
							}
						}
					}
					else{
						goto errror;
					}
				}
			}
			else if(request()->opt=='register_user'){
				if(request()->phone!='' && request()->password!='' && request()->name!=''){
					if(is_numeric(request()->phone) && strlen(request()->phone)>9){
						$q = User::where('phone', '+'.request()->phone)->get();
						if($q->count()<=0){
							$str = Hash::make(str_random(32));
							$data = array(
								'name' 		=> request()->name,
								'phone' 	=> '+'.request()->phone,
								'password'	=> Hash::make(request()->password),
								'wallet'	=> 1000,
								'remember_token' => $str,
								'check_phone' => '1');
							try{
								User::insert($data);
								$id = DB::getPdo()->lastInsertId();
								$msg = 'CODE: '.rand(100000,999999);
								$dataBonus = array(
									'idUser'     	=> $id,
									'date'   	=> $date,
									'value'   	=> 1000,
									'reason'   	=> 'Регистрация', 
									'pl_mn'   	=> '+',									
								);
								UserBonus::insert($dataBonus);	
							
							
								$data = array(
									'id' => $id,
									'auth_status' => 'yes',
									'_token' => $str
								);

								return response()->json($data, 200);
							}
							catch(\Illuminate\Database\QueryException $e){
								goto errror;
							}
						}
						else{
							return response()->json('This user alreday registered',208);
						}
					}
					else{
						goto errror;
					}					
				}
				else{
					goto errror;
				}
			}
			else if(request()->opt=='getOther'){
				if(request()->get=='countries'){
					$q = DB::select("SELECT * FROM `coutry`");
					return response()->json($q, 200);
				}
				elseif(request()->get=='cities'){
					$q = DB::select("SELECT * FROM `cities`");
					return response()->json($q, 200);
				}
				else if (request()->get=='notifications' && request()->userid!=''){
					if(request()->utoken==UserToken::getMyToken(request()->userid)) {
						$q = PushNotifications::select('message', 'direct', 'viewed', 'date')->where('user_id', request()->userid)->get();
						return response()->json($q, 200);
					} else {
						return response()->json('User token error', 200);
					}
				}
			}
			else{
				goto errror;
			}
		}
		else{
			errror: return response()->json($date.' API not correct request',400);
		}		
	}
	public function UserPhontoUpload(Request $request){
		if($request->hasFile('file') && isset($request['userid']) && isset($request['appid']) && isset($request['utoken'])){
			if($request['appid']==ApiKey::getMyKey() && $request['utoken']==UserToken::getMyToken($request['userid'])){
				$userid = $request['userid'];
				$images = $request->file('file');
				$filename = time().'.'.$images->getClientOriginalExtension();
				$image_resize = Image::make($images->getRealPath());
				$image_resize->resize(400, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				$filename_1 = '/uploads/avatars/'.$userid.'/'.$filename;
				$dataDocStatus = array(
					'avatar' => $filename_1
				);
				DB::table('users')->where('id',$userid)->update($dataDocStatus);
				if(!File::exists(public_path('uploads/avatars/'.$userid.'/'))){
					File::makeDirectory(public_path('uploads/avatars/'.$userid.'/'), $mode = 0777, true, true);
				}
				$image_resize->save(public_path('uploads/avatars/'.$userid.'/'.$filename));
				return response()->json(['url' => $filename_1], 200);
			}else{
				return response()->json('UserToken or ApiKey error');
			}
		} else if($request->hasFile('file') && isset($request['task_id'])){				
				$task_id = $request['task_id'];
				$images = $request->file('file');
				$filename = time().'.'.$images->getClientOriginalExtension();
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
				return response()->json(['url' => $filename_1], 200);			
		} else if($request->hasFile('file')  && isset($request['partnerid_logo'])){				
				$userid = $request['partnerid_logo'];
				$images = $request->file('file');
				$filename = time().'.'.$images->getClientOriginalExtension();
				$image_resize = Image::make($images->getRealPath());
				$image_resize->resize(400, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				$filename_1 = 'uploads/partner_logo/'.$userid.'/'.$filename;
				$data = array(					
					'logo' => $filename_1,					
				);				
				DB::table('partners')->where('id',$userid)->update($data);
				if(!File::exists(public_path('uploads/partner_logo/'.$userid.'/'))){
					File::makeDirectory(public_path('uploads/partner_logo/'.$userid.'/'), $mode = 0777, true, true);
				}
				$image_resize->save(public_path('uploads/partner_logo/'.$userid.'/'.$filename));
				return response()->json(['url' => $filename_1], 200);			
		} else if($request->hasFile('file') && isset($request['partnerid_images'])){				
				$userid = $request['partnerid_images'];
				$images = $request->file('file');
				$filename = time().'.'.$images->getClientOriginalExtension();
				$image_resize = Image::make($images->getRealPath());
				$image_resize->resize(400, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				$filename_1 = 'uploads/partner_images/'.$userid.'/'.$filename;
				$data = array(					
					'images' => $filename_1,					
				);				
				DB::table('partners')->where('id',$userid)->update($data);
				if(!File::exists(public_path('uploads/partner_images/'.$userid.'/'))){
					File::makeDirectory(public_path('uploads/partner_images/'.$userid.'/'), $mode = 0777, true, true);
				}
				$image_resize->save(public_path('uploads/partner_images/'.$userid.'/'.$filename));
				return response()->json(['url' => $filename_1], 200);			
		} else if($request->hasFile('file') && isset($request['sale_id'])){				
				$userid = $request['sale_id'];
				$images = $request->file('file');
				$filename = time().'.'.$images->getClientOriginalExtension();
				$image_resize = Image::make($images->getRealPath());
				$image_resize->resize(400, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				$filename_1 = 'uploads/sale_images/'.$userid.'/'.$filename;
				$data = array(					
					'image' => $filename_1,					
				);				
				DB::table('partners_sales')->where('id',$userid)->update($data);
				if(!File::exists(public_path('uploads/sale_images/'.$userid.'/'))){
					File::makeDirectory(public_path('uploads/sale_images/'.$userid.'/'), $mode = 0777, true, true);
				}
				$image_resize->save(public_path('uploads/sale_images/'.$userid.'/'.$filename));
				return response()->json(['url' => $filename_1], 200);			
		} else {
			return response()->json('File or user data request empty', 200);
		}
		
			
		
	}
	
	
}
