<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table ='cart';
    protected $guarded = ['id'];
    protected $fillable = ['name','price','image','quantity'];

    public function getProduct()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public static function getTotalQuantity()
    {
        /*$cart = Cart::get();
        return $cart;*/
        $items = Cart::get();
        return $items->sum('quantity');
    }
}
