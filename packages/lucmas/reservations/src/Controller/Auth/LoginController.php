<?php

namespace Lucmas\Reservations\Controller\Auth;

use App\Http\Controllers\Controller;
use Lucmas\Reservations\Model\User;
use Lucmas\Reservations\Traits\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/admin";

    /**
     * il valore ritornato da questa funzione sarà la riga del database che verrà usata per effettuare il login
     * @return string
     */
    public function username()
    {
        return 'username';
    }

}
