<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Students;
use Validator;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
           $student = Department::with('getStudent')->get();
           if ($request->ajax()) {
            foreach ($student as $k => $v) {
              $arr = array();
              foreach ($v->getStudent as $key=>$value) {
                $arr[] = $value->firstname;
            }
            $student[$k]['firstname'] = implode(',', $arr);
            $student[$k]['action'] =
            '<a href="'.route("department.edit",$v->id).'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="'.$v->id.'"><i class="fas fa-trash-alt"></i></a>';
        }
        $recordsTotal = $student->count();
        $json['data'] = $student;
        $json['recordsTotal'] = $recordsTotal;
        return json_encode($json);
        }
        return view('department.department_list');
    }
    public function create()
    {
        return view('department.department_create');
    }
    public function store(Request $request)
    {
        try {
          $request->validate([
            'name'     =>'required',
            'status'   =>'required',
            'semester' =>'required',
        ]);
          $department           = new Department;
          $department->name     = $request->name;
          $department->title    = \Str::slug($request->name,'-');
          $department->status   = $request->status;
          $department->semester = $request->semester;
          $department->save();
          return redirect()->route('department.index')
          ->with('success','Students created successfully.');
        }catch (ModelNotFoundException $exception) {
          return back()->withError($exception->getMessage())->withInput();
        }
    }
    public function edit($id)
    {
        $department = Department::where('id','=',$id)->first();
        return view('department.department_create',compact('department'));
    }
    public function update(Request $request)
    {
        try {
            $validator  = Validator::make($request->all(), [
                'name'     =>'required',
                'semester' =>'required',
                'status'   =>'required',
            ]);
            $department           = Department::find($request->id);
            $department->name     = $request->name;
            $department->title    = \Str::slug($request->name,'-');
            $department->semester = $request->semester;
            $department->status   = $request->status;
            $department->update();

            return redirect()->route('department.index')
            ->with('success','Department updated successfully');
        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    public function destroy(Request $request)
    {
        $department = Department::find($request->id);
        $department->status = '2';
        $department->save();
        return $department;
        return redirect()->route('department.index')->with('success','Department deleted successfully');
    }
}
