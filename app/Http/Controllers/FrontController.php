<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use App\Models\Cart;

class FrontController extends Controller
{
    public function index(Request $request){
    $category = Category::withCount('getProductName')->get();
    $product  = Product::with('getImage')->get();
    $cart_qty = Cart::getTotalQuantity();
    $price = Product::where('price','<',500)->first();
    return view('front.home',compact('category','product','cart_qty','price'));
    }

    public function category_list(Request $request){
        $category = Category::with('getProductName')->find($request->id);
        $product_html = '';
        if(isset($category) && !empty($category->getProductName)) {
            foreach($category->getProductName as $k=>$v){
                $product_html .= '<div class="col-sm-4">';
                    $product_html .= '<div class="product-image-wrapper">';
                        $product_html .= '<div class="single-products">';
                            $product_html .= '<div class="productinfo text-center">';
                                foreach($v->getImage as $k1=>$v1){
                                    $product_html .='<img src="'.asset('image/'.$v1->image).'" alt=" "height="200px" width="200px" />';
                                 }
                                $product_html .= '<h2>'.$v->price.'</h2>';
                                $product_html .= '<p>'.$v->name.'</p>';
                                $product_html .= ' <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
                            $product_html .= '</div>';
                        $product_html .= '</div>';
                        $product_html .= '<div class="choose">';
                            $product_html .= '<ul class="nav nav-pills nav-justified">';
                            $product_html .= '<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>';
                            $product_html .= '<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>';
                            $product_html .= '</ul>';
                        $product_html .= '</div>';
                    $product_html .= '</div>';
                $product_html .= '</div>';
            }
            $final = array(
                'result'  => $product_html,
                'success' => "Product list success",
            );
            return $final;
        }
    }

    public function search(Request $request){
        $search = $request->search;
        $product = Product::where('name', 'like', '%' . $search. '%')->get();
        $product_html = '';
        if(isset($product) && !empty($product)) {
            foreach($product as $k=>$v){
                $product_html .= '<div class="col-sm-4">';
                    $product_html .= '<div class="product-image-wrapper">';
                        $product_html .= '<div class="single-products">';
                            $product_html .= '<div class="productinfo text-center">';
                                foreach($v->getImage as $k1=>$v1){
                                    $product_html .='<img src="'.asset('image/'.$v1->image).'" alt=" "height="200px" width="200px" />';
                                 }
                                $product_html .= '<h2>'.$v->price.'</h2>';
                                $product_html .= '<p>'.$v->name.'</p>';
                                $product_html .= ' <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
                            $product_html .= '</div>';
                        $product_html .= '</div>';
                        $product_html .= '<div class="choose">';
                            $product_html .= '<ul class="nav nav-pills nav-justified">';
                            $product_html .= '<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>';
                            $product_html .= '<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>';
                            $product_html .= '</ul>';
                        $product_html .= '</div>';
                    $product_html .= '</div>';
                $product_html .= '</div>';
            }
            $final = array(
                'result'  => $product_html,
                'success' => "Product list success",
            );
            return $final;
        }
    }

    public function price(Request $request){
        $min      = $request->min;
        $max      = $request->max;
        $product  = Product::whereBetween('price', [$min, $max])->get();

        $product_html = '';
        if(isset($product) && !empty($product)) {
            foreach($product as $k=>$v){
                $product_html .= '<div class="col-sm-4">';
                    $product_html .= '<div class="product-image-wrapper">';
                        $product_html .= '<div class="single-products">';
                            $product_html .= '<div class="productinfo text-center">';
                                foreach($v->getImage as $k1=>$v1){
                                    $product_html .='<img src="'.asset('image/'.$v1->image).'" alt=" "height="200px" width="200px" />';
                                 }
                                $product_html .= '<h2>'.$v->price.'</h2>';
                                $product_html .= '<p>'.$v->name.'</p>';
                                $product_html .= ' <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
                            $product_html .= '</div>';
                        $product_html .= '</div>';
                        $product_html .= '<div class="choose">';
                            $product_html .= '<ul class="nav nav-pills nav-justified">';
                            $product_html .= '<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>';
                            $product_html .= '<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>';
                            $product_html .= '</ul>';
                        $product_html .= '</div>';
                    $product_html .= '</div>';
                $product_html .= '</div>';
            }
            $product = array(
                'result' => $product_html,
                'status' => 'success',
            );
            }
            else{
            $product_html .= '<h1>No products</h1>';
               $product = array(
                'result' => $product_html,
                'status' => 'fail',
            );
            }
            return $product;
    }
}

