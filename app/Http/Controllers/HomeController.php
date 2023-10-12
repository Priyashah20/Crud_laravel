<?php

namespace App\Http\Controllers;
use Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EmailNotification;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }
    public function send() {
        $user = User::first();
        $project = [
            'greeting'   => 'Hi '.$user->name.',',
            'body'       => 'This '.$user->email.' id is logged in.,',
            'thanks'     => 'Thank you',
            'actionText' => 'View Project',
            'actionURL'  => url('/'),
            'id'         => 57
        ];
        Notification::send($user, new EmailNotification($project));
        //Notification::send(['email' => 'mailto:ritesh.khatri@iflair.com', 'name' => 'ritesh'], new EmailNotification($project));
        dd('Notification sent!');
    }

}
