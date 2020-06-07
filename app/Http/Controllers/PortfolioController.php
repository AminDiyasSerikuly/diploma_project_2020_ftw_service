<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Image;
use File;
use Illuminate\Support\Facades\Hash;

class PortfolioController extends Controller
{
    public function portfolio($id)
    {
        if(Auth::check()){ 
            $profile = DB::table('users')
                            ->where('id',$id)
                            ->get();
            $portfolio = DB::table('portfolio')
                            ->where('user_id',$id)
                            ->get();
            $data = array(
                'portfolio' => $portfolio,
                'profile' => $profile
            );
            return view('portfolio.portfolio')->with($data);
        }
        else{
            return redirect()->action('HomeController@index');
        }
    }
    public function addnewalbum(Request $request)
    {
        $data = array(
            'user_id'           => Auth::user()->id,
            'portfolio_name'    => $request['album_name'],
            'narrative'         => $request['album_narrative']
        );
        DB::table('portfolio')->insert($data);
        return back()->with('success','Upload successfully!');
    }
    public function portfolioview($user_id, $id)
    {
        if(Auth::check()){ 
            $profile = DB::table('users')
                            ->where('id',$user_id)
                            ->get();
            $data = array(
                'profile'   => $profile,
            );
            return view('portfolio.portfolioview')->with($data);
        }
        else{
            return redirect()->action('HomeController@index');
        }
    }
    public function addimageportfolio(Request $request)
    {
        if($request->has('image')){
            $avatar = $request->file('image');
            $filename = $avatar->getClientOriginalName();
            $image_resize = Image::make($avatar->getRealPath());
            $image_resize_1 = Image::make($avatar->getRealPath());
            $image_resize->resize(80, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $filename_1 = '/uploads/portfolio/'.Auth::user()->id.'/'.$filename;
            $filename_2 = '/uploads/portfolio/'.Auth::user()->id.'/thumbnail/'.$filename;
        }
        else{
                $filename_1 = '';
                $filename_2 = '';
        }        
        $data = array(
            'portfolio_id'          => $request['portfolio_id'],
            'img_path'              => $filename_1,
            'img_thumbnail_path'    => $filename_2,
        );
        DB::table('portfolio_images')->insert($data);
        if($request->has('image')){
            if(!File::exists(public_path('uploads/portfolio/thumbnail/'.Auth::user()->id.'/'))){
                File::makeDirectory(public_path('uploads/portfolio/'.Auth::user()->id.'/thumbnail/'), $mode = 0777, true, true);
            }
            if(!File::exists(public_path('uploads/portfolio/'.Auth::user()->id.'/'))){
                File::makeDirectory(public_path('uploads/portfolio/'.Auth::user()->id.'/'), $mode = 0777, true, true);
            }
            $image_resize->save(public_path('uploads/portfolio/'.Auth::user()->id.'/thumbnail/'.$filename));
            $image_resize_1->save(public_path('uploads/portfolio/'.Auth::user()->id.'/'.$filename));
        }
        return back()->with('error','Картинка добавлено!');
    }
}
