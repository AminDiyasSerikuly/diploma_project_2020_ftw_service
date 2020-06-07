<?php	header('X-Frame-Options: DENY');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//web
Route::get('/','MainController@index')->name('main');
Route::get('/home','MainController@index')->name('home');
Route::get('/about','MainController@about')->name('about');
Route::post('/addblog','MainController@addblog');
Route::get('/blogview','MainController@blogview')->name('blogview')->where('id', '[0-9]+');
Route::get('/terms','MainController@terms');
Route::get('/privacy','MainController@privacy');
Route::get('/hellotaskers','MainController@hellotaskers');
Route::post('/forgot','MainController@forgot')->name('forgot');
Route::post('/load/subcat','MainController@getSubCatigories');
Route::get('/testpush','OrzuPusherController@Send');

Route::get('/check_phone','MainController@check_phone')->name('check_phone');
Route::post('/accept_check_phone','MainController@accept_check_phone')->name('access_to_user');



//Route::get('/test',function(){
//    return view('test');
//});


#Группа задач
Route::prefix('tasks')->group(function () {
	Route::get('/','TasksController@index')->name('contenttasks');
	Route::get('/cityajaxupload','TasksController@cityajaxupload')->name('cityajaxupload');
	Route::get('/taskajaxupload','TasksController@taskajaxupload')->name('taskajaxupload');
	Route::get('/currentajaxupload','TasksController@currentajaxupload')->name('currentajaxupload');
	Route::post('/ajaxupload','TasksController@loadTasksAjax')->name('taskajax');
	Route::post('/ajaxuploadfilter','TasksController@loadTasksAjaxFilter')->name('taskajaxfilter');
	Route::get('/new/{cat}/{subcat}', 'TasksController@new_task')->name('newtask');
	Route::get('/new', 'TasksController@hometask')->name('hometask');
	Route::post('/new/add', 'TasksController@add')->name('newadd'); 
	Route::post('/request/add', 'TasksController@task_requests')->name('');
	Route::get('/request/get/{id}', 'TasksController@task_requests_selected')->name('selreq');
	Route::get('/view/{id}', 'TasksController@taskview')->name('taskview')->where('id', '[0-9]+');
	Route::get('/update/{id}/{status}', 'TasksController@task_update')->where('id', '[0-9]+');
});
Route::prefix('portfolio')->middleware('auth')->group(function () {
	Route::get('/{id}','PortfolioController@portfolio');
	Route::get('/{user_id}/view/{id}','PortfolioController@portfolioview');
	Route::post('/addnewalbum','PortfolioController@addnewalbum');
	Route::post('/addnewimages','PortfolioController@addimageportfolio');
});
#
Route::prefix('profile')->group(function () {
	Route::get('/{id}','OtherProfileController@profile');
	Route::post('/add_rate','OtherProfileController@profile_add_rate');
	Route::get('/add_like/{id}','OtherProfileController@profile_add_like');
});
#Группа мой профиль
Route::prefix('my')->middleware('auth')->group(function () {
	Route::get('/','MyProfile@myprofile')->name('my');
	Route::get('/balance','MyProfile@balance');
	Route::get('/tasks','MyProfile@mytasks');
	Route::get('/messages/{task_id}','MyProfile@messages')->name('chat');
	Route::post('/messages','MyProfile@messageadd')->name('messageadd');
	Route::get('/document','MyProfile@document')->name('document');
	Route::post('/uploaddoc','MyProfile@uploaddoc')->name('uploaddoc');
	Route::post('/uploadavatar','MyProfile@uploadavatar')->name('uploadavatar');
	Route::prefix('settings')->group(function () {
		Route::get('/','MyProfile@mysettings');
		Route::post('/cat_update','MyProfile@mysettings_cat_update');
		Route::post('/request_email_update','MyProfile@mysettings_r_email_update');
		Route::post('/request_push_update','MyProfile@mysettings_push_update');
		Route::post('/request_embile_update','MyProfile@mysettings_embile_update');
		Route::post('/request_email_param_update','MyProfile@mysettings_email_param_update');
		Route::post('/pass_update','MyProfile@mysettings_pass_update');
		Route::post('/links_update','MyProfile@mysettings_links_update');
	});
	Route::post('/edit/update','MyProfile@myedit_update');
	Route::get('/edit','MyProfile@myedit');
});
	
Route::get('/api','MobApi@getApi');
Route::post('/api/avatar','MobApi@UserPhontoUpload');

Route::get('setlocale/{locale}', function ($locale) {    
    if (in_array($locale, \Config::get('app.locales'))) {   
    	Session::put('locale', $locale);                    
    }
    return redirect()->back();                              
})->name('lang');
Route::get('setcity/{city}', function ($city) {    
    if (in_array($city, \App\City::getCities('app.cities'))) {   
    	Session::put('city', $city);                    
    }
    return redirect()->back();                              
})->name('city');
Route::prefix('eziocms')->middleware('auth','eziocmsaccess')->group(function () {
	Route::get('/','EzioCMS\MainController@index');
	Route::prefix('settings')->group(function () {
		Route::get('/langs','EzioCMS\SettingsController@langs')->name('eziocmslangs');
		Route::post('/langs/new_lang','EzioCMS\SettingsController@langs_add')->name('eziocmsnewlangs');
		Route::get('/content','EzioCMS\SettingsController@content')->name('eziocmscontent');
		Route::post('/content/add','EzioCMS\SettingsController@content_add')->name('eziocmscontentadd');
		Route::get('/category','EzioCMS\SettingsController@category')->name('eziocmscategory');
		Route::get('/categorykey','EzioCMS\SettingsController@categorykey')->name('eziocmscategorykey');
		Route::get('/categorykey_update/{id}','EzioCMS\SettingsController@categorykey_update')->name('eziocmscategorykeyupdate');
		Route::post('/categorykeyadd','EzioCMS\SettingsController@categorykey_add')->name('eziocmscategorykeyadd');
		Route::post('/categorykey_updated','EzioCMS\SettingsController@categorykey_updated')->name('eziocmscategorykeyupdated');
		Route::get('/categorykeydelete/{id}','EzioCMS\SettingsController@categorykey_delete')->name('eziocmscategorykeyadelete');
	});
	Route::prefix('users')->group(function () {
		Route::get('/','EzioCMS\UsersController@index')->name('eziocmsusers');
		Route::get('/profile/{id}','EzioCMS\UsersController@profile')->name('eziocmsprofile');
	});
	Route::prefix('tasks')->group(function () {
		Route::get('/','EzioCMS\TasksController@index')->name('eziocmstasks');
	});
	Route::prefix('logs')->group(function () {
		Route::get('/smslog','EzioCMS\LogsController@smslog')->name('eziocmssmslogs');
		Route::get('/apilog','EzioCMS\LogsController@apilog')->name('eziocmsapilogs');
		Route::get('/clearapilog','EzioCMS\LogsController@clearapilog')->name('eziocmsclearapilog');
		Route::get('/clearsmslog','EzioCMS\LogsController@clearsmslog')->name('eziocmsclearsmslog');
	});
});
