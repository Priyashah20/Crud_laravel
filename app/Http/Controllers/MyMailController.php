<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyMail;
use Mail;
use PDF;

class MyMailController extends Controller
{
    public function myMail(Request $request)
    {
        $myEmail = 'priya.shah@iflair.com';
        $details = [
        	'title' => 'Lorem ipsum',
        	'body' => 'Lorem ipsum is a name for a common type of placeholder text. Also known as filler or dummy text, this is simply text copy that serves to fill a space without actually saying anything meaningful.',
        	'url' => 'https://www.google.com'
        ];
        Mail::to($myEmail)->send(new MyMail($details));
        dd("Mail Send Successfully");
    }
}
