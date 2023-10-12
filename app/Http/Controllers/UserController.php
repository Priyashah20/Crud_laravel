<?php
namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use App\Models\Phone;
use Illuminate\Http\Request;
use File;
use Validator;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
class UserController extends Controller
{
  public function index()
 {
     $data = Profile::all();
     $user_id=User::with('getPhone')->get();
     if(request()->ajax())
     {
         return datatables()->of($data)
         ->addColumn('action', function($row){
             $action_btn = '<center><div>
             <a href="'.route("users.show",$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>

             <a href="'.route("users.edit",$row->id).'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

             <a href="'.route("users.destroy",$row->id).'" class="btn btn-danger btn-sm" onclick="return confirm(`Are you Sure want to delete`)"><i class="fas fa-trash-alt"></i></a></div></center>';

             return $action_btn;})
         ->addIndexColumn()
         ->make(true);
     }
     return view('profiles.index',compact('user_id'));
 }
 public function changeStatus(Request $request)
 {
     try
     {
         $profile = Profile::find($request->userid);
         $profile->status = $request->status;
         $profile->save();
         return response()->json(['success'=>true, 'message' => 'Status change successfully.'], 200);
     }
     catch (\Exception $exception)
     {
         return response()->json(['success'=>false, 'message' => $exception->getMessage()], 500);
     }
 }

 public function create()
 {
     return view('profiles.create');
 }
 public function store(Request $request)
 {
     $request->validate([
         'username' => 'required',
         'number'   => 'required',
         'password' => 'required',
         'email'    => 'required|email|unique:profiles',
         'image'    => 'required',
     ]);
     $file              = $request->file('image');
     $fileName          = time().'_'.$file->getClientOriginalName();
     $profile           = new Profile;
     $profile->username = $request->username;
     $profile->number   = $request->number;
     $profile->password = $request->password;
     $profile->email    = $request->email;
     $profile->image    = $fileName;
     $profile->save();

     $file->move(public_path('image'),$fileName);
     return redirect()->route('users.index')
     ->with('success','User created successfully.');
 }
 public function show($id)
 {
     $profile=Profile::findOrFail($id);
     return view('profiles.show',compact('profile'));
 }
 public function edit($id)
 {
     $profile=Profile::findOrFail($id);
     return view('profiles.edit',compact('profile'));
 }
 public function update(Request $request, $id)
 {
     $profile = Profile::find($id);
     $validator = Validator::make($request->all(), [
         'username' => 'required',
         'number'   => 'required',
         'password' => 'required',
         'email'    => ['required','email',
         Rule::unique('profiles')->ignore($profile->id),
     ],
 ]);
     if($validator->fails())
     {
         return redirect()->back()->withErrors($validator)->withInput();
     }
     if($request->file('image'))
     {
         $profile  = Profile::find($id);
         $file     = $request->file('image');
         $fileName = time().'_'.$file->getClientOriginalName();
         $file->move(public_path('image'),$fileName);
         $path     ="image/".$profile->image;
         if(File::exists($path))
         {
             unlink("image/".$profile->image);
         }
         $profile->username = $request->username;
         $profile->number   = $request->number;
         $profile->password = $request->password;
         $profile->email    = $request->email;
         $profile->image    = $fileName;
         $profile->update();
     }
     else
     {
         $profile           = Profile::find($id);
         $profile->username = $request->username;
         $profile->number   = $request->number;
         $profile->password = $request->password;
         $profile->email    = $request->email;
         $profile->update();
     }
     return redirect()->route('users.index')->with('success','User updated successfully');
 }
 public function getFile(Request $request){
     $id       = $request->id;
     $profile  = Profile::find($id);
     $filename = $profile->image;
     $path     = public_path('image/'.$filename);
     return response()->download($path);
 }
 public function destroy($id)
 {
     $profile = Profile::findOrFail($id);
     $profile->delete();
     return redirect()->route('users.index')->with('success','User deleted successfully');
 }
 public function email(Request $request)
 {
     if(!empty($request->userid))
     {
         $userid    = $request->userid;
         $useremail = $request->email;
         $user      = Profile::where('id',"!=",$userid)->where('email',$useremail)->first();
     }
     else {
         $useremail = $request->email;
         $user      = Profile::where('email',$useremail)->first();
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


