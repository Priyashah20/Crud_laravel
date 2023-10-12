<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyTestMail;
use Mail;

class MailController extends Controller
{
    public function myTestMail()
    {
        $myEmail = 'priya.shah@iflair.com';
        $details = [
             'title' => 'Lorem ipsum',
             'body' => 'Lorem ipsum is a name for a common type of placeholder text. Also known as filler or dummy text, this is simply text copy that serves to fill a space without actually saying anything meaningful.',
             'url' => 'https://www.google.com'
        ];
        Mail::to($myEmail)->send(new MyTestMail($details));
        dd("Mail Send Successfully");
    }
}
