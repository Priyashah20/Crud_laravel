<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use Validator;
use Illuminate\Validation\Rule;
use File;
use Yajra\Datatables\Datatables;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Department;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $students            = Students::where('status','!=','3');
        if(request()->ajax())
        {
          return datatables()->of($students)
          ->addColumn('action', function($row){
             $action_btn = '<center><div>
             <a href="'.route("students.edit",$row->id).'" class="btn btn-success btn-sm" style="margin:0 0 0 -8px;"><i class="fa fa-edit"></i></a>
             <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'"><i class="fas fa-trash-alt"></i></a></div></center>';
             return $action_btn;})
          ->addIndexColumn()
          ->make(true);
        }
    return view('students.student_list');
    }
    public function create()
    {
        return view('students.student_create');
    }
    public function store(Request $request)
    {
        try {
          $request->validate([
            'firstname' =>'required',
            'lastname'  =>'required',
            'email'     =>'unique:students,email',
            'mobile'    =>'required',
            'gender'    =>'required',
            'image'     =>'required',
            'status'    =>'required',
            'address'   =>'required',
            'city'      =>'required',
            'semester'  =>'required',
        ]);
          $fileName = null;
          if($request->file('image')){
            $file          = $request->file('image');
            $fileName      = $file->getClientOriginalName();
            $path          =public_path('image/');
        }
        $students            = new Students;
        $students->firstname = $request->firstname;
        $students->lastname  = $request->lastname;
        $students->email     = $request->email;
        $students->mobile    = $request->mobile;
        $students->gender    = $request->gender;
        $students->image     = $fileName;
        $students->status    = $request->status;
        $students->address   = $request->address;
        $students->city      = $request->city;
        $students->semester  = $request->semester;
        $students->hobby     = implode(',',$request->input('hobby'));
        $students->state     = $request->state;
        $students->department_id = $request->department_id;
        $students->save();
        return redirect()->route('students.index')
        ->with('success','Students created successfully.');
    }
    catch (ModelNotFoundException $exception) {
      return back()->withError($exception->getMessage())->withInput();
    }
    }
    public function edit($id)
    {
        $students = Students::where('id','=',$id)->first();
        return view('students.student_create', [
            'students' => $students,
            'hobby' => explode(',', $students->hobby)
        ]);
    }

    public function update(Request $request)
    {
        try {
            $validator  = Validator::make($request->all(), [
                'firstname' =>'required',
                'lastname'  =>'required',
                'email'     =>'unique:students,email',
                'mobile'    =>'required',
                'gender'    =>'required',
                'image'     =>'required',
                'status'    =>'required',
                'address'   =>'required',
                'city'      =>'required',
                'semester'  =>'required',
            ]);
            $students            = Students::find($request->id);
            if($request->file('image')){
                $file     = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $path     = public_path('image/');
                $file->move($path,$students->image);
                if(File::exists($path))
                {
                    File::delete(public_path('image/'));
                }
            }else{
                $fileName=!empty($students->image) ? ($students->image) : '';

            }
            //$students            = Students::find($request->id);
            $students->firstname = $request->firstname;
            $students->lastname  = $request->lastname;
            $students->email     = $request->email;
            $students->mobile    = $request->mobile;
            $students->gender    = $request->gender;
            $students->image     = $fileName;
            $students->status    = $request->status;
            $students->address   = $request->address;
            $students->city      = $request->city;
            $students->semester  = $request->semester;
            $students->hobby     = implode(',',$request->hobby);
            $students->state     = $request->state;
            $students->department_id = $request->department_id;
            $students->update();

            return redirect()->route('students.index')
            ->with('success','Students updated successfully');
    }catch (ModelNotFoundException $exception) {
        return back()->withError($exception->getMessage())->withInput();
    }
    }
    public function getFile(Request $request){
        $id       = $request->id;
        $students = Students::find($id);
        $filename = $students->image;
        $path     = public_path('image/'.$filename);
        return response()->download($path);
    }
    public function email(Request $request)
    {
      if(!empty($request->id))
      {
          $id       = $request->id;
          $email    = $request->email;
          $students = Students::where('id',"!=",$id)->where('email',$email)->first();
      }
      else {
          $email    = $request->email;
          $students = Students::where('email',$email)->first();
      }
      if($students){
          return "false";
      }else{
          return "true";
      }
    }
    public function destroy(Request $request)
    {
        $students = Students::find($request->id);
        $students->status = '2';
        $students->save();
        return $students;
        return redirect()->route('students.index')->with('success','Students deleted successfully');
    }
    public function getDepartment(Request $request)
    {
        $students        = Students::find($request->id);
        $department      = Department::NotDeleted()->Active()->get();
        $department_html = '';
        $department_html = '<label>Department:</label>';
        $department_html .= '<select class="department_id" name="department_id" value="
        ">';
            $department_html .= '<option value="0">Select department</option>';
            foreach ($department as $key => $value) {
                $department_html .= '<option value="'.$value->id.'"'.(isset($students) && ($students->department_id == $value->id) ? 'selected' : '').'>'.$value->name.'</option>';
            }
        $department_html .= '</select>';
        return response()->json(array(
            'success'  => "Department list success",
            'html'     =>$department_html)
        );

    }
}
