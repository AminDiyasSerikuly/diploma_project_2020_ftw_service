<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Accounts;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'phone'     => $data['phone'],
            'role_id'   => '2',
            'password'  => Hash::make($data['password']),
            'check_phone' => 0,
            'wallet' => 1000
        ]);
        return redirect()->route($redirectTo);
    }
}
