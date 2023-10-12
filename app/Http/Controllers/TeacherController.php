<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Validator;
use Illuminate\Validation\Rule;
use File;
use Yajra\Datatables\Datatables;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeacherController extends Controller
{
    public function index()
    {
        $data = Teacher::Active()->Deleted();

        if(request()->ajax())
        {
            return datatables()->of($data)
            ->addColumn('action', function($row){
                $action_btn = '<center><div>
                <a href="javascript:void(0)" class="btn btn-success btn-sm editTeacher" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'"><i class="fas fa-trash-alt"></i></a></div></center>';
                return $action_btn;})
            ->addIndexColumn()
            ->make(true);
        }
        return view('teacher.teacher_list');
    }
    public function create()
    {
        return view('teacher.teacher_list');
    }
     public function store(Request $request)
    {
        try {
            $request->validate([
                'firstname' =>'required',
                'lastname'  =>'required',
                'email'     =>'unique:teacher,email',
                'mobile'    =>'required',
                'subject'   =>'required',
                //'image'     =>'required',
                'gender'    =>'required',
            ]);
                $id = $request->id;
                $teacher=Teacher::find($id);
                if(empty($teacher)){
                    $teacher = new Teacher;
                }

                $fileName = null;
                if($request->file('image')){
                    $file          = $request->file('image');
                    $fileName      = $file->getClientOriginalName();
                    $path          = public_path('image/');
                    $file->move($path,$fileName);
                }
                $teacher->firstname = $request->firstname;
                $teacher->lastname  = $request->lastname;
                $teacher->email     = $request->email;
                $teacher->mobile    = $request->mobile;
                $teacher->subject   = $request->subject;
                $teacher->image     = $fileName;
                $teacher->gender    = $request->gender;
                $teacher->status    = $request->status;
                $teacher->save();
            return redirect()->route('teacher.index')
            ->with('success','Teacher created successfully.');
        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    public function edit(Request $request)
    {
        $id      = $request->id;
        $teacher = Teacher::find($id);
        return $teacher;
    }
    public function getFile(Request $request){
        $id       = $request->id;
        $teacher  = Teacher::find($id);
        $filename = $teacher->image;
        $path     = public_path('image/'.$filename);
        return response()->download($path);
    }
    public function email(Request $request)
    {
        if(!empty($request->id)){
            $id      = $request->id;
            $email   = $request->email;
            $teacher = Teacher::where('id',"!=",$id)->where('email',$email)->first();
        }
        else{
            $email   = $request->email;
            $teacher = Teacher::where('email',$email)->first();
        }
        if($teacher){
            return "false";
        }else{
            return "true";
        }
    }
    public function destroy(Request $request)
    {
        $teacher = Teacher::find($request->id);
        $teacher->status ='2';
        $teacher->save();
        return $teacher;
        return redirect()->route('teacher.index')->with('success','Teacher deleted successfully');
    }
}
