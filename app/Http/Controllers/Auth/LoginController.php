<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        if ($request->ajax()){
            return response()->json([
                'auth' => auth()->check(),
                'user' => $user,
                'intended' => $this->redirectPath(),
            ]);
        }
        return redirect()->route($redirectTo);
    }
}
