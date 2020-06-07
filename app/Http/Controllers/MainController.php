<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\SendSMS\SendSMSModel as SendSMS;
use App\SendSMS\Sendsmslog as SMSLog;
use Carbon\Carbon;
use App\Blogs;
use App\User;
use App\Category;
use DB;
use Agent;
use Hash;

class MainController extends Controller
{
    //
    public function index()
    {
        $categories = Category::where('parent_id','0')->get();
        $tasks = DB::table('tasks')
            ->where('status','0')
            ->get();
        $last_tasks = DB::table('tasks')
            ->where('status','0')
            ->orderBy('id','desc')
            ->limit('7')
            ->get();
        $data = array(
            'categories' => $categories,
            'task_count' => $tasks->count(),
            'last_tasks' => $last_tasks,
            'last_tasks' => $last_tasks,
        );
        return view('home')->with($data);
    }
    public function getSubCatigories(Request $request) {
        $categories = Category::where('parent_id',$request['id'])->get();
        $echoList  ='';
        foreach ($categories as $subcat) {
            $echoList .= '<li><a href="/tasks/new/'.$subcat->param.'">'.$subcat->name.'</a></li>';
        }
        echo $echoList;
    }
    public function forgot()
    {
        $q = User::where('phone',request()->phone)->get();
//        return response()->json(response()->uid);
        if($q->count()>0){

            // TODO: Создать колонку uid в БД
//            return response()->json($q->uid);

//            $data=[];
            foreach($q as $r){
             if($r->uid == request()->uid || $r->uid == '' ){
             if($r->uid == ''){
                 $r->uid = request()->uid;
             }

                $data = array(
                    'password' => Hash::make(request()->password),
                    'uid' => $r->uid,
                );


                User::where('phone',request()->phone)
                    ->update($data);
                return response()->json('Пароль успешно изменен',200);

             } else {
                 return response()->json('Хьюстон, у нас ананас, свяжитесь с нашей службой');
             }
            }
        }
    }
    public function about()
    {
        return view('about');
    }
    public function terms()
    {
        return view('terms');
    }
    public function privacy()
    {
        return view('privacy');
    }
    public function hellotaskers()
    {
        return view('hellotaskers');
    }

  public function addblog(Request $request)
    {
        $date = Carbon::now('Asia/Almaty');
        $data = array(
            'blog'          => $request['name'],
            'discription'     => $request['discription']      
        );
        Blogs::insert($data); 
        $blog_id = DB::getPdo()->lastInsertId();
    if($request->has('files')){
        foreach($request->file('files') as $images){
            $filename = $images->getClientOriginalName();
            $image_resize = Image::make($images->getRealPath());
            $image_resize->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $filename_1 = 'uploads/blog_images/'.$blog_id.'/'.$filename;
            $data = array(
                'image' => $filename_1,
            );
            Blogs::insert($data);
            if(!File::exists(public_path('uploads/blog_images/'.$blog_id.'/'))){
                File::makeDirectory(public_path('uploads/blog_images/'.$blog_id.'/'), $mode = 0777, true, true);
                }
            $image_resize->save(public_path('uploads/blog_images/'.$blog_id.'/'.$filename));
            }
        }

    //Отправляет пуш всем юзерам, которые подписаны на категорию задачи
   // PushNotification::SendCategories(Auth::user()->id, $cat_id, 'Подписка', 'Новая задача в категории: '.Tasks::getCatNameAttributeStatic($cat_id), $task_id);
    return redirect('/blogs/view/'.$blog_id);
    }

	public function blogview()
	{
	    $blog = Blogs::where('id','1')
	    ->get();
	    if($blog->count()<=0){
		return redirect('/');
	    }
	    $data = array(
		'blogs' => $blog
	    );
	return view('blogview')->with($data);
        return view('blogview',compact('data'));
     }

    public function check_phone(){
        if(Auth::check()){
            if(Auth::user()->check_phone==1){
               return redirect('/');
            }
           else{
           	$date = Carbon::now('Asia/Almaty')->format('Y-m-d H:i:s');
               $del = array('(',')',' ','-','+');
           }
        }
        else{
            return redirect('/');
        }
       return view('auth.check_phone');
    }
    public function accept_check_phone(Request $request)
    {
       foreach($q as $r){
           if(substr($r->message, strpos($r->message, 'Verification code:')+19, 6)==$request['check_phone']){
                $data = array(
                    'check_phone' => '1'
                );
                User::where('id', Auth::user()->id)->update($data);
               return redirect('/');
           }
           else{
               return redirect('/');
           }
       }
    }
}
