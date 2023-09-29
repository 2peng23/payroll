<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    

    use AuthenticatesUsers;
    protected $redirectTo = '/home';
 
    protected $maxAttempts = 2;
    protected $decayMinutes = 1/4
    ;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
