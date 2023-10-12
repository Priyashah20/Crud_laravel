<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Phone;
class SiteController extends Controller
{
    public function getPhone($user_id)
    {
        $id = '51';
        $user = User::find($id);
        $phone = $user->getPhone->phone;
        dd($phone);
    }
    public function getUser($phone_id)
    {
        return Phone::find($phone_id)->user;
    }
}


