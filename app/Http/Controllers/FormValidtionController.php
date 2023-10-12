<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Form;

class FormValidtionController extends Controller
{
    public function createUserForm(Request $request) {
        return view('form');
    }

    public function UserForm(Request $request) {
        $this->validate($request, [
          'username' => 'required',
          'email' => 'required|email',
          'number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          'password'=>'required',
          'image' => 'required'
        ]);

    Form::create($request->all());
    return back()->with('success', 'Your form has been submitted.');
  }
}
