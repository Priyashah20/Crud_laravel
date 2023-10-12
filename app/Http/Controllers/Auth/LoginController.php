<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Notification;
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

    use AuthenticatesUsers;
    public function redirectTo()
    {
       // auth()->user()->notify(new EmailNotification());
        $user = Auth::user();
        //$user->notify(new EmailNotification('ritesh.khatri@iflair.com'));
        // Notification::send($user, new EmailNotification($user));
         //Notification::send($user, new EmailNotification($user));
        $user->notify(new EmailNotification($user));
       /*  Notification::route('email', 'arpita.parmar@iflair.com')->notify(new EmailNotification($user));*/
       /*  Notification::route('mail', $user)->notify(new EmailNotification($user));*/
    }
    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
       /* echo "<pre>";
        print_r($request->all());
        die;*/
    }
}
