<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\SignUp;
use Validator;
use Hash;
use Illuminate\Support\Facades\Response;
use Auth;

class FrontLoginController extends Controller
{
    public function index()
    {
        $cart_qty = Cart::getTotalQuantity();
        $signup   = SignUp::get();
        return view('front.layout.login',compact('cart_qty','signup'));
    }

    public function signUp(Request $request)
    {
        try {
            $request->validate([
                'name'             =>'required',
                'email'            =>'required',
                'phone'            =>'required',
                'password'         =>'required',
                'confirm_password' =>'required',
            ]);
            $signup           = new SignUp;
            $signup->name     = $request->name;
            $signup->email    = $request->email;
            $signup->phone    = $request->phone;
            $signup->password = Hash::make($request->password);
            $signup->save();
            $arr_msg = array('msg' => __('SignUp successfully'),'status' => 'success',);
            $request->session()->flash('success', $arr_msg);
            return redirect()->route('login.index');
        }catch (ModelNotFoundException $exception) {
          return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function login(Request $request)
    {
        try{
            $request->validate([
                'email'    => 'required',
                'password' => 'required',
            ]);
            $credentials = $request->only('email', 'password');
           /* echo "<pre>";
            print_r($credentials);
            die;*/

            if (Auth::guard('web')->attempt($credentials)) {
                echo "hello";
                return redirect()->route('front.index');
            }else{
                echo "bye";
                return redirect()->route('order.index');
            }
            /*$arr_msg = array('msg' => __('Login Successfully'),'status'=>'success');
            $request->session->flash('success',$arr_msg);*/
            // return redirect()->route('login.index');
        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }
}
