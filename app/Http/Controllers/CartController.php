<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use App\Models\Cart;
use Validator;
use Illuminate\Support\Facades\Response;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::withCount('getProductName')->get();
        $cart     = Cart::get();
        $cart_qty = Cart::getTotalQuantity();
        return view('front.layout.cart_list',compact('category','cart','cart_qty'));
    }
    public function addToCart(Request $request,$id)
    {
        try{
            $category = Category::withCount('getProductName')->get();
            $product  = Product::with('getImage')->find($id);
            $cartdata = Cart::where('product_id','=',$id)->first();

            if(!empty($cartdata)){
                $cart =Cart::find($cartdata->id);
                $cart->quantity =  $cart->quantity +1;
                $cart->save();
            }else{
                $cart             = new Cart;
                $cart->name       = $product->name;
                $cart->price      = $product->price;
                $cart->image      = $product->getImage[0]->image;
                $cart->quantity   = 1;
                $cart->product_id = $id;
                $cart->save();
            }
            $arr_msg=array('msg' => __('Add to cart'),'status' => 'success',);
            $request->session()->flash('success', $arr_msg);
                return redirect()->route('cart.index');
        }
        catch (ModelNotFoundException $exception) {
          return back()->withError($exception->getMessage())->withInput();
        }
    }
    public function update(Request $request)
    {
        $id      = $request->id;
        $cart    = Cart::find($id);
        $product = Product::find($cart->product_id);
            if(!empty($cart)){
                $status = $request->status;
                if($status == 'plus'){
                    $quantity = $cart->quantity +1;
                    if($product->quantity > 0){
                    $product->quantity = $product->quantity -1;
                    }
                }elseif($status == 'minus') {
                    $quantity = $cart->quantity -1;
                    $product->quantity = $product->quantity +1;
                }else{
                    $quantity = $request->qty;
                }
                $product->save();

                if($product->quantity > $quantity){
                    $cart->quantity = $quantity;
                    $cart->save();
                }else{
                    $array = array(
                        'status' => 'fail',
                        'msg'    => "stock not available",
                    );
                    return $array;
                }
            }

        $array = array(
            'status' => $request->status,
        );
        return $array;
    }
    public function destroy(Request $request)
    {
        $id      = $request->id;
        $cart    = Cart::find($id);
        $cart->delete();
        $arr_msg=array('msg' => __('Product deleted successfully'),'status' => 'success',);
            $request->session()->flash('success', $arr_msg);
                return redirect()->route('cart.index');
    }
    public function empty(Request $request)
    {
        $cart = Cart::get();
         foreach($cart as $k => $v){
            $c_delete =cart::find($v->id);
            $c_delete->delete();
        }
        $arr_msg = array('msg' => __('All products Cleared Successfully !'),'status' => 'success',);
        $request->session()->flash('success', $arr_msg);
        return redirect()->route('cart.index');
    }
}
