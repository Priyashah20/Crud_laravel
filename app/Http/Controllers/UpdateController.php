<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use File;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
class UpdateController extends Controller
{
	public function index()
	{
		$profile = User::findOrFail(Auth::guard('web')->user()->id);
		return view('new.edit',compact('profile'));
	}
	public function create()
	{
		return view('new.create');
	}
	public function edit(Request $request)
	{
		$profile = User::findOrFail(Auth::user()->id);
		return view('new.edit',compact('profile'));
	}

	public function update(Request $request)
	{
		$profile = User::findOrFail(Auth::user()->id);
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => [
				'required','email',
				Rule::unique('users')->ignore(Auth::user()->id),
			],
		]);
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$profile = User::find(Auth::user()->id);
		$profile->name = $request->name;
		$profile->email = $request->email;
		$profile->update();
		return redirect()->route('new.edit')->with('success','User updated successfully');
	}
	public function email(Request $request)
    {
        if(!empty($request->userid))
        {
          $userid = $request->userid;
          $useremail = $request->email;
          $user = User::where('id',"!=",$userid)->where('email',$useremail)->first();

        } else {
          $useremail = $request->email;
          $user = User::where('email',$useremail)->first();
        }
        if($user)
        {
          return "false";
        }
        else
        {
          return "true";
        }
    }

}
