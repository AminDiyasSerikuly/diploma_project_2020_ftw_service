<?php

namespace App\Http\Controllers\EzioCMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Tasks;
use App\Category;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Tasks::orderBy('id', 'desc')->paginate(10);
        $data = array(
            'tasks' => $tasks,
        );
        return view('eziocms.tasks.alltask')->with($data);
    }
}
