<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use File;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
	public function index(Request $request)
	{
		$category = Category::with('getProductName')->get();
		if ($request->ajax()) {
			foreach ($category as $k => $v) {
				$arr = array();
				foreach ($v->getProductName as $key=>$value) {
					$arr[] = $value->name;
				}
				$category[$k]['product_name'] = implode(',', $arr);
				$category[$k]['action'] =
				'<a href="'.route("categories.show",$v->id).'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
				<a href="'.route("categories.edit",$v->id).'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a href="'.route("categories.destroy",$v->id).'" class="btn btn-danger btn-sm" onclick="return confirm(`Are you sure want to delete`)"><i class="fas fa-trash-alt"></i></a>';
			}
			$recordsTotal = $category->count();
			$json['data'] = $category;
			$json['recordsTotal'] = $recordsTotal;
			return json_encode($json);
		}
		return view('category.index');
	}
	public function create()
	{
		return view('category.create');
	}
	public function store(Request $request)
	{
		$request->validate([
			'category_name' => 'required',
		]);
		$category                = new Category;
		$category->category_name = $request->category_name;
		$category->title         = \Str::slug($request->category_name,'-');
		$category->status        = $request->status;
		$category->save();
		return redirect()->route('categories.index')
		->with('success','Category created successfully.');
	}
	public function show($id)
	{
		$category=Category::findOrFail($id);
		return view('category.show',compact('category'));
	}
	public function edit($id)
	{
		$category =Category::findOrFail($id);
		return view('category.edit',compact('category'));
	}
	public function update(Request $request,$id)
	{
		$category       = Category::find($id);
		$validator      = Validator::make($request->all(), [
			'category_name' => 'required',
		]);
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$category                = Category::find($id);
		$category->category_name = $request->category_name;
		$category->title         = \Str::slug($request->category_name,'-');
		$category->status        = $request->status;
		$category->update();
		return redirect()->route('categories.index')
		->with('success','Category updated successfully');
	}
	public function destroy($id)
	{
		$category = Category::findOrFail($id);
		$category->delete();
		return redirect()->route('categories.index')
		->with('success','Category deleted successfully');
	}
}
