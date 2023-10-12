<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Hash;
use Auth;
use Validator;

class ForgotPasswordController extends Controller
{
    public function showChangePasswordGet() {
        return view('auth.passwords.forgetPassword');
    }
}
