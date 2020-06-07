<?php

namespace App\Http\Controllers\EzioCMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MainController extends Controller
{
    public function index()
    {
    	# code...

    	return view('eziocms.home');
    }
}
