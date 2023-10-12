<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Validator;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $cart      = Cart::get();
        $cart_qty  = Cart::getTotalQuantity();
        $orderItem = OrderItem::get();
        return view('front.layout.order',compact('cart','cart_qty','orderItem'));
    }

    public function order(Request $request)
    {
        try {
            $request->validate([
                'name'      =>'required',
                'email'     =>'required',
                'phone'     =>'required',
                'address'   =>'required',
            ]);

            $order            = new Order;
            $order->name      = $request->name;
            $order->email     = $request->email;
            $order->phone     = $request->phone;
            $order->address   = $request->address;
            $order->save();

            $cart=Cart::all();
            foreach ($cart as $key => $value) {
                OrderItem::create([
                   'order_id'      => $order->id,
                   'product_id'    => $value->product_id,
                   'qty'           => $value->quantity,
                   'price'         => $value->price,
                   'total_price'   => ($value->price) * $value->quantity,
                   'status'        => '0',
                ]);
            }

            $myEmail = 'priya.shah@iflair.com';

            $order = [
                'name'        => $order->name,
                'qty'         => $value->quantity,
                'price'       => $value->price,
                'total_price' =>($value->price) * $value->quantity,
                'title'       => 'Thank you for shopping. Your order will deliever soon.',
            ];
            //dd($order);
           //return view('emails.ordermail',compact('order'));
            Mail::to($myEmail)->send(New OrderMail($order));
            $arr_msg=array('msg' => 'Order created successfully','status' => 'success',);
            $request->session()->flash('success', $arr_msg);
            return redirect()->route('order.index');
        }catch (ModelNotFoundException $exception) {
          return back()->withError($exception->getMessage())->withInput();
        }
       // Mail::to('priya.shah@iflair.com')->send(New OrderMail($order));
    }
}
