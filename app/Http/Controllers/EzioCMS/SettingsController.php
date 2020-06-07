<?php

namespace App\Http\Controllers\EzioCMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lang;
use App\Langs;
use Auth;
use App\Category;
use App\CategoryKeys;

class SettingsController extends Controller
{
    public function __construct()
    {
    	if(Auth::check()){
	    	if(Auth::user()->role_id!='1'){
	    		return redirect('/home');
	    	}
	    }
    }
    public function langs()
    {
    	$q = Langs::orderBy('id','desc')->paginate(10);
    	$data = array(
    		'langs' => $q
    	);
    	return view('eziocms.content.lang')->with($data);
    }
    public function langs_add(Request $request)
    {
    	$data = array(
    		'lang' => $request['lang'],
    		'param' => $request['param']
    	);
    	Langs::insert($data);
    	return back()->with('success','Новый язык добавлен!');
    }
    public function content()
    {
        if(request()->find!=''){
           $lang = Lang::whereRaw(' LOWER(param) like ? OR LOWER(value) like ?', ['%'.trim(mb_strtolower(request()->find)).'%', '%'.trim(mb_strtolower(request()->find)).'%'])
                        ->orderBy('id','desc')
                        ->paginate(10);
           $lang->appends(['find' => request()->find]);
        }
        else{            
           $lang = Lang::orderBy('id','desc')->paginate(10);
        }
    	$langs = Langs::get();
    	$data = array(
    		'lang' => $lang,
    		'langs' => $langs,
    	);
    	return view('eziocms.content.content')->with($data);
    }
    public function content_add(Request $request)
    {
    	$data = array(
    		'lang' => $request['lang'],
    		'param' => $request['param'],
    		'value' => $request['value']
    	);
    	Lang::insert($data);
    	return back()->with('success','Новый параметр добавлен!');
    }
    public function category()
    {
        if(request()->find!=''){
           $categories = Category::whereRaw(' LOWER(name) like ? OR LOWER(param) like ?', ['%'.trim(mb_strtolower(request()->find)).'%', '%'.trim(mb_strtolower(request()->find)).'%'])
                        ->orderBy('id','desc')
                        ->paginate(10);
           $categories->appends(['find' => request()->find]);
        }
        else{            
           $categories = Category::orderBy('id','desc')->paginate(10);
        }
        $category = Category::get();
        $data = array(
            'categories' => $categories,
            'category' => $category,
        );
        return view('eziocms.content.category')->with($data);
    }
    public function categorykey_update($id)
    {
        $catkey = CategoryKeys::where('id',$id)->get();
        $category = Category::get();
        $lang = Langs::get();
        $data = array(
            'catkey' => $catkey,
            'category' => $category,
            'lang' => $lang,
        );        
        return view('eziocms.content.category_key_update')->with($data);
    }
    public function categorykey_updated(Request $request)
    {
        $data = array(
            'cat_id' => $request['cat_id'],
            'key' => $request['key'],
            'lang' => $request['lang']
        );        
        CategoryKeys::where('id',$request['id'])->update($data);
        return back()->with('success','Новый ключ добавлен!');
    }
    public function categorykey()
    {
        if(request()->find!=''){
           $categories = CategoryKeys::whereRaw(' LOWER(key) like ?', ['%'.trim(mb_strtolower(request()->find)).'%'])
                        ->orderBy('id','desc')
                        ->paginate(10);
           $categories->appends(['find' => request()->find]);
        }
        else{            
           $categories = CategoryKeys::orderBy('id','desc')->paginate(10);
        }
        $lang = Langs::get();
        $category = Category::whereNotIn('name',['Что-то другое'])->get();
        $data = array(
            'categories' => $categories,
            'lang' => $lang,
            'category' => $category,
        );
        return view('eziocms.content.category_key')->with($data);
    }
    public function categorykey_add(Request $request)
    {
        $data = array(
            'cat_id' => $request['cat_id'],
            'key' => $request['key'],
            'lang' => $request['lang']
        );
        CategoryKeys::insert($data);
        return back()->with('success','Новый ключ добавлен!');
    }
    public function categorykey_delete($id)
    {
        CategoryKeys::where('id',$id)->delete();
        return back()->with('success','Ключ удаленно!');
    }
}
