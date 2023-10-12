<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Hash;
use Auth;
use Validator;
class ChangePasswordController extends Controller
{
    public function showChangePasswordGet() {
        return view('auth.passwords.change-password');

    }

  public function changePasswordPost(Request $request)
  {

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){

            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");

  }
}
