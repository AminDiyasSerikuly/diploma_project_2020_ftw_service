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




class UserApi extends Controller
{
//public function getUser(){
//if(request()->param=='more' && request()->user!=''){
//    $uID = request()->user;
//    $q = User::select('id', 'name', 'fname', 'email', 'phone', 'avatar', 'wallet')->where('id',$uID)->get();
//    foreach($q as $qq){
//        $data = array(
//            'id' => $qq->id,
//            'name' => $qq->name,
//            'fname' => $qq->fname,
//            'email' => $qq->email,
//            'phone' => $qq->phone,
//            'wallet' => $qq->wallet,
//            'avatar' => $qq->avatar,
//            'status' => User::isOnline(request()->user),
//            'sex' => Profile::getUserParamWithId($uID, 'user_sex'),
//            'sad' => Profile::getUserSadCount($uID),
//            'neutral' => Profile::getUserNeutralCount($uID),
//            'happy' => Profile::getUserHappyCount($uID),
//            'city' => Profile::getUserParamWithId($uID, 'user_address'),
//            'current' => Profile::getUserParamWithId($uID, 'user_current'),
//            'task_requests' => Tasks::getUserTaskRequest($uID),
//            'tasks' => Tasks::getUserTaskCount($uID),
//            'about' => Profile::getUserParamWithId($uID, 'user_about'),
//            'birthday' => Profile::getUserParamWithId($uID, 'bday').'.'.Profile::getUserParamWithId($uID, 'bmonth').'.'.Profile::getUserParamWithId($uID, 'byear'),
//        );
//    }
//    if($q->count()>0){
//        return response()->json($data, 200);
//    }
//    else{
//        goto errror;
//    }
//    //Выводит полные данные пользователя
//} else if(request()->user!='') {
//    $q = User::select('id', 'name', 'fname', 'email', 'phone', 'avatar')->where('id', request()->user)->get();
//    foreach ($q as $qq) {
//        $data = array(
//            'id' => $qq->id,
//            'name' => $qq->name,
//            'fname' => $qq->fname,
//            'email' => $qq->email,
//            'phone' => $qq->phone,
//            'avatar' => $qq->avatar,
//            'status' => User::isOnline(request()->user),
//            'sad' => Profile::getUserSadCount(request()->user),
//            'neutral' => Profile::getUserNeutralCount(request()->user),
//            'happy' => Profile::getUserHappyCount(request()->user)
//        );
//    }
//    if ($q->count() > 0) {
//        return response()->json($data, 200);
//    } else {
//        goto errror;
//    }
//}
//}



    function catsAll()
    {
        //Вывод всех категорий
        if (request()->cat_id == 'all' || request()->cat_id == '') {
            $q = Category::select('id', 'name', 'parent_id')
                ->where('lang', request()->lang)
                ->get();
            if ($q->count() > 0) {
                return response()->json($q, 200);
            } else {
                goto errror;
            }
            return response()->json($q, 200);
        }
    }

    function catsGeneral()
    {

        $q = Category::select('id', 'name', 'parent_id')
            ->where('lang', request()->lang)
            ->where('parent_id', '0')
            ->get();
        if ($q->count() > 0) {
            return response()->json($q, 200);
        } else {
            goto errror;
        }
    }

    function catsSubcats()
    {

        $q = Category::select('id', 'name', 'parent_id')
            ->where('lang', request()->lang)
            ->where('parent_id', request()->id)
            ->get();
        if ($q->count() > 0) {
            return response()->json($q, 200);
        } else {
            goto errror;
        }
    }

    function catsEach()
    {
        $q = Category::select('id','name', 'parent_id')
            ->where('lang',request()->lang)
            ->where('id',request()->cat_id)
            ->get();
        if($q->count()>0){
            return response()->json($q, 200);
        }
    }

//    function tasksAll()
//    {
//        //Выводит задания с пагинацией (0 и 1 одинаковый результат / одна страница показывает 5 заданий)
//
//    }

    function tasksActual()
    {
        //Выводит только актуальные задания
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

    function tasksClosed()
    {
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

    function tasksDeletion()
    {
        //Delete задания
        $getidofTask = request()->delete;
        $q = DB::table('tasks')
            ->where('id',$getidofTask)
            ->delete();
        $qt = DB::table('tasks_param')
            ->where('task_id',$getidofTask)
            ->delete();
        return response()->json($qt, 200);
    }

    function tasksNoRequest()
    {
        //Выводит задания без откликов по {requests}
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

    function tasksByCity()
    {
        //Выводит задания по городам {city}
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
							b.city FROM tasks b WHERE city='{$getcityTasks}' ORDER BY `id` DESC LIMIT " . (($page - 1) * 5) . ",5");
        if (count($q) > 0) {
            return response()->json($q, 200);
        } else {
            return response()->json('Not tasks yet', 200);
        }
    }

    function tasksByCatId()
    {
        //Выводит задания по категориям {catid}
        for ($i = 0; $i <= count(request()->catid) - 1; $i++) {
            $getcatTasks = request()->catid[$i];
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
							b.narrative FROM tasks b WHERE cat_id='{$getcatTasks}' ORDER BY `id` DESC LIMIT " . (($page - 1) * 5) . ",5");
            if (0 == count($q[$i])) {
                $qq[$i] += $q[$i];
            }
        }
        if (count($q) > 0) {
            return response()->json($q, 200);
        } else {
            return response()->json('Not tasks yet', 200);
        }
    }

    function tasksByUserId()
    {
        //Выводит задания пользователя по {userid}
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
							b.narrative FROM tasks b WHERE user_id='{$getuserTasks}' ORDER BY `id` DESC LIMIT " . (($page - 1) * 5) . ",5");
        if (count($q) > 0) {
            return response()->json($q, 200);
        } else {
            return response()->json('Not tasks yet', 200);
        }
    }

    function tasksActualSearch()
    {
        //Поиск по заданиям (только актуальные задания)
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
							b.narrative FROM tasks b WHERE status='0' and task like '%$getSearchQ%' ORDER BY `id` DESC LIMIT " . (($page - 1) * 5) . ",5");
        if (count($q) > 0) {
            return response()->json($q, 200);
        } else {
            return response()->json('Not result yet', 200);
        }
    }

    function tasksAll()
    {
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
            return response()->json('Not tasks yet', 200);
        }
    }


    function tasksByTaskId()
    {

        //Выводит одно задание по {taskid}
        $q = Tasks::select('id', 'task', 'cat_id', 'created_at', 'narrative', 'user_id')->where('id', request()->tasks)->get();
        $qt = TasksParam::select('param', 'value')->where('task_id', request()->tasks)->get();
        if ($q->count() > 0) {
            return response()->json(array($q, $qt), 200);
        } else {
            return response()->json('Task not found', 200);
        }
    }

    function tasksCreateNewTask()
    {
        //Добавление нового задания
        if (request()->task != '' && request()->catid != '' && request()->narrative != '' && request()->userid != '' && request()->utoken != '') {
            //Проверяем добавляемого пользователя по его токену, если токен и {userid} совпадают, значит добавляет сам пользователь
            if (request()->utoken == UserToken::getMyToken(request()->userid)) {
                try {
                    $data = array(
                        'task' => request()->task,
                        'cat_id' => request()->catid,
                        'narrative' => request()->narrative,
                        'user_id' => request()->userid,
                        'status' => '0',
                        'created_at' => $date,
                        'updated_at' => $date,
                        'city' => Profile::getUserParamWithId(request()->userid, 'user_address'),
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
                    if (request()->date == 'wtasker') {
                        $dataParams = array(
                            'task_id' => $task_id,
                            'param' => 'work_with',
                            'value' => 'reqierer',
                        );
                        TasksParam::insert($dataParams);
                    }
                    //Сроки 2: Указать период
                    if (request()->date == 'period') {
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
                    if (request()->date == 'exact') {
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
                    if (request()->location == 'indicate') {
                        $dataParams = array(
                            'task_id' => $task_id,
                            'param' => 'address',
                            'value' => request()->locationVal,
                        );
                        TasksParam::insert($dataParams);
                    }
                    //Удаленно
                    if (request()->location == 'remote') {
                        $dataParams = array(
                            'task_id' => $task_id,
                            'param' => 'remote',
                            'value' => 'yes',
                        );
                        TasksParam::insert($dataParams);
                    }
                    //Указать цену
                    if (request()->price == 'indicate') {
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
                    if (request()->price == 'wtasker') {
                        $dataParams = array(
                            'task_id' => $task_id,
                            'param' => 'no_amount',
                            'value' => 'yes',
                        );
                        TasksParam::insert($dataParams);
                    }


                    PushNotification::SendCategories(request()->userid, request()->catid, 'Подписка', 'Новая задача в категории: ' . Tasks::getCatNameAttributeStatic(request()->catid), $task_id);
                    return response()->json('Task created:' . $task_id, 201);

                } catch (\Illuminate\Database\QueryException $e) {
                    goto errror;
                }
            } else {
                return response()->json('User token error', 200);
            }
        }

    }

    function tasksProposal()
    {

        //Добавление предложения к задаче
        if (request()->act == 'input' && request()->task_id != '' && request()->narrative != '' && request()->userid != '' && request()->amount != '' && request()->utoken != '') {
            //Проверяем добавляемого пользователя по его токену, если токен и {userid} совпадают, значит добавляет сам пользователь
            if (request()->utoken == UserToken::getMyToken(request()->userid)) {
                $Task = Tasks::where('id', request()->task_id)->get();
                foreach ($Task as $rTask) {
                    $getUserid = $rTask->user_id;
                    $getTaskid = $rTask->task;
                }
                //Если пользователь уже добавлял предложение
                if (Tasks::getTaskRequestUser(request()->task_id, request()->userid) > 0) {
                    return response()->json('This user has already added a request', 208);
                    //Если пользователь не добавлял предложение, то добавляем запрос
                } else {
                    try {
                        $data = array(
                            'user_id' => request()->userid,
                            'task_id' => request()->task_id,
                            'narrative' => request()->narrative,
                            'amount' => request()->amount,
                            'current' => Profile::getUserParamWithId(request()->userid, 'user_current'),
                            'secure' => '0',
                            'request_not' => '0',
                            'time_request' => '0',
                            'selected' => '0'
                        );
                        TasksRequest::insert($data);
                        PushNotification::SendUser($getUserid, 'Отличная новость!', 'У вас новое предложение!', 'my.' . request()->task_id);
                        return response()->json('Request added', 201);
                    } catch (\Illuminate\Database\QueryException $e) {
                        goto errror;
                    }
                }
            } else {
                return response()->json('User token error', 200);
            }


        } //Выводит список добавленных предложений к задании
        else if (request()->act == 'view' && request()->task_id != '') {
            $q = TasksRequest::select('id', 'user_id', 'narrative', 'amount')->where('task_id', request()->task_id)->get();
            if ($q->count() > 0) {
                $qq = DB::select("SELECT a.user_id, 
							(select b.name from users as b where b.id = a.user_id) as username,
							(select c.phone from users as c where c.id = a.user_id) as userphone,
							(select count(d.like) as COL from users_stars as d where d.like='0' AND d.like_user_id = a.user_id) as userstars_sad,
							(select count(e.like) as COL from users_stars as e where e.like='1' AND e.like_user_id = a.user_id) as userstars_neutral,
							(select count(f.like) as COL from users_stars as f where f.like='2' AND f.like_user_id = a.user_id) as userstars_happy,
							a.id, a.user_id, a.narrative, a.amount, a.current, a.selected FROM task_requests as a WHERE a.task_id = '" . request()->task_id . "'");
                return response()->json($qq, 200);
            } else {
                return response()->json('No request yet', 200);
            }
        } //Выбор исполнителя
        else if (request()->act == 'selected' && request()->req_id != '' && request()->utoken != '' && request()->userid != '') {
            //Вытаскивает id задания из предложения (отклик)
            $TaskRequest = TasksRequest::where('id', request()->req_id)->get();
            foreach ($TaskRequest as $rRequest) {
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
            if (request()->utoken == UserToken::getMyToken(request()->userid) && request()->userid == $getUserid) {
                $data = array(
                    'selected' => '1'
                );
                DB::table('task_requests')->where('id', request()->req_id)->update($data);
                PushNotification::SendUser($getUserToid, 'Отличная новость!', 'Вас выбрали исполнителем задачи: ' . $getTaskName, $getTaskId);
                return response()->json('Request selected', 200);
            } else {
                return response()->json('Access error: User token or user id empty. Or token and userid mismatched.' . $getUserid, 200);
            }
        }
    }

    function userGet()
    {
//!!!!!!!!!!!!!!!!!!!!!! Full data here???
        if (request()->param == 'more' && request()->user != '') {
            $uID = request()->user;
            $q = User::select('id', 'name', 'fname', 'email', 'phone', 'avatar', 'wallet')->where('id', $uID)->get();
            foreach ($q as $qq) {
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
                    'birthday' => Profile::getUserParamWithId($uID, 'bday') . '.' . Profile::getUserParamWithId($uID, 'bmonth') . '.' . Profile::getUserParamWithId($uID, 'byear'),
                );
            }
            if ($q->count() > 0) {
                return response()->json($data, 200);
            } else {
                goto errror;
            }
            //Выводит полные данные пользователя
        } else if (request()->user != '') {
            $q = User::select('id', 'name', 'fname', 'email', 'phone', 'avatar')->where('id', request()->user)->get();
            foreach ($q as $qq) {
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
            if ($q->count() > 0) {
                return response()->json($data, 200);
            } else {
                goto errror;
            }


            //Выводит список доступных альбомов из портфолио
        } else if (request()->portfolio != '') {
            $q = Portfolio::select('id', 'user_id', 'portfolio_name', 'narrative')->where('user_id', request()->portfolio)->get();
            if ($q->count() > 0) {
                return response()->json($q, 200);
            } else {
                return response()->json('No portfolio yet', 200);
            }
            //Выводит доступный список фотографий портфолио по id portfolio
        } else if (request()->portfolioImages != '') {
            $q = PortfolioImages::select('id', 'portfolio_id', 'img_path', 'img_thumbnail_path')->where('portfolio_id', request()->portfolioImages)->get();
            if ($q->count() > 0) {
                return response()->json($q, 200);
            } else {
                return response()->json('No images yet', 200);
            }
            //Выводит список категорий, на которые подписан пользователь
        } else if (request()->user_cat != '') {
            $ol = array();
            $q = UserParam::where([['user_id', '=', request()->user_cat], ['meta_param', '=', 'user_cat']])->get();
            if ($q->count() > 0) {
                foreach ($q as $uc) {
                    $qq = explode(';', $uc->meta_value);
                    for ($i = 0; $i < count($qq); $i++) {
                        $ol[$qq[1]] = Tasks::getCatName($qq[1]);
                    }
                }
                return $ol;
            } else {
                return response()->json('No subscribe categories', 200);
            }
        }
    }















}