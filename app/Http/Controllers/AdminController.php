<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Redirect;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function adminSignUp(Request $request)
    {

        try {
            $request->validate([
                'name'             =>'required',
                'email'            =>'required',
                'password'         =>'required',
                'confirm_password' =>'required',
            ]);
            $user           = new User;
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $arr_msg = array('msg' => __('SignUp successfully'),'status' => 'success');
            $request->session()->flash('success', $arr_msg);
            return redirect()->route('admin.index');

        }catch (ModelNotFoundException $exception) {
          return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function adminLogin(Request $request)
    {
        try{
            $request->validate([
                'email'    => 'required',
                'password' => 'required',
            ]);
            $credentials = $request->only('email', 'password');
         /*   $arr_msg = array('msg' => __('Login successfully'),'status' => 'success');
            $request->session()->flash('success', $arr_msg);*/
            //return redirect()->route('admin.index');

            if (Auth::guard('web')->attempt($credentials)) {
                /*$arr_msg = array(
                    'msg' => 'Login successfully'
                );*/
                return Redirect::to('home')->with("success", "Login successfully");

               // return redirect()->route('home');
            }else{
                return redirect()->back();
            }

            // $arr_msg = array('msg' => __('Login Successfully'),'status'=>'success');
            //$request->session->flash('success',$arr_msg);
            // return redirect()->route('login.index');
        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.index');

    }

}
