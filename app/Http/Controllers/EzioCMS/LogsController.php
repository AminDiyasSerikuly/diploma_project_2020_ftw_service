<?php

namespace App\Http\Controllers\EzioCMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SendSMS\Sendsmslog;
use App\Api\ApiLog;

class LogsController extends Controller
{
	public function smslog()
    {
    	$smslog = Sendsmslog::orderBy('id','desc')->paginate(10);
    	$data = array(
    		'log' => $smslog
    	);
    	return view('eziocms.logs.smslog')->with($data);
    }
    public function apilog()
    {
    	$smslog = ApiLog::orderBy('id','desc')->paginate(10);
    	$data = array(
    		'log' => $smslog
    	);
    	return view('eziocms.logs.apilog')->with($data);
    }
    public function clearsmslog()
    {
        Sendsmslog::query()->truncate();
        return back()->with('success','Таблица очишена');
    }
    public function clearapilog()
    {
        ApiLog::query()->truncate();
        return back()->with('success','Таблица очишена');
    }
}
