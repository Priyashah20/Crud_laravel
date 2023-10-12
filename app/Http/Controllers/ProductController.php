<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Category;
use File;
use Validator;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function index(Request $request){
        $product = Product::orderBy('id','DESC')->get();
        if ($request->ajax()) {
          foreach ($product as $k => $v) {
            $product[$k]['category_name'] = (isset($v->getCategoryName) && !empty($v->getCategoryName->category_name) ? $v->getCategoryName->category_name : '');
            $product[$k]['action'] =
            '<a href="'.route("products.show",$v->id).'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
            <a href="'.route("products.edit",$v->id).'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
            <a href="'.route("products.destroy",$v->id).'" class="btn btn-danger btn-sm" onclick="return confirm(`Are you sure want to delete`)"><i class="fas fa-trash-alt"></i></a>';
        }
        $recordsTotal = $product->count();
        $json['data'] = $product;
        $json['recordsTotal'] = $recordsTotal;
        return json_encode($json);
    }
    return view('products.index');
    }
    public function changeStatus(Request $request)
    {
        try
        {
          $product = Product::find($request->userid);
          $product->status = $request->status;
          $product->save();
          return response()->json(['success'=>true, 'message' => 'Status change successfully.'], 200);
        }
        catch (\Exception $exception){
          return response()->json(['success'=>false, 'message' => $exception->getMessage()], 500);
        }
    }
    public function create()
    {
        $categories = Category::where('status','=','0')->get();
        return view('products.create',compact('categories'));
    }
    public function store(Request $request)
    {
     $request->validate([
       'name'        => 'required',
       'price'       => 'required',
       'quantity'    => 'required',
       'description' => 'required',
       'image'       => 'required',
    ]);

    if($request->hasfile('image'))
    {
        foreach($request->file('image') as $image)
        {
          $name=$image->getClientOriginalName();
          $image->move(public_path('image'),$name);
          $data[] = $name;
        }
    }
    $product              = new Product;
    $product->name        = $request->name;
    $product->price       = $request->price;
    $product->quantity    = $request->quantity;
    $product->description = $request->description;
    $product->category_id = $request->category_id;
    $product->save();
    $file= new File();
    $file->filename=$data;
    foreach ($file->filename as $value) {
        Image::create(['product_id'=>$product->id,'image'=>$value]);
    }
    return redirect()->route('products.index')
    ->with('success','Product created successfully.');
    }
    public function show($id)
    {
      $image = Image::where('product_id',$id)->with('Product')->get();
      return view('products.show',compact('image'));
    }
    public function edit($id)
    {
      $product    =Product::findOrFail($id);
      $product_id = Image::with('Product')->where('product_id',$id)->get();
      $categories = Category::where('status','=','0')->get();
      return view('products.edit',compact('product','product_id','categories'));
    }
    public function update(Request $request, $id)
    {
        $product   = Product::find($id);
        $validator = Validator::make($request->all(), [
         'name'        => 'required',
         'price'       => 'required',
         'quantity'    => 'required',
         'description' =>'required',
     ]);
        if($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput();
        }
       $data=array();
        if($request->hasfile('image'))
        {
          foreach($request->file('image') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path('image'),$name);
                $data[] = $name;
            }
        }
        $product              = Product::find($id);
        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->quantity    = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->update();
        $file= new File();
        $file->filename=$data;

        foreach ( $file->filename as $value) {
          Image::create(['product_id'=>$product->id,'image'=>$value]);
        }
        return redirect()->route('products.index')->with('success','Product updated successfully');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
  }
    public function delete($id)
    {
        $product = Image::findOrFail($id);
        if ($product->delete())
        {
            return response()->json(['success'=>true, 'message' => 'Image Delete successfully.'], 200);
        }
        else{
            echo "error";
        }
    }
    public function getProduct($product_id)
    {
      return Product::find($product_id)->image;
    }
    public function getImage($image_id)
    {
      return Image::find($image_id)->product;
    }
}


