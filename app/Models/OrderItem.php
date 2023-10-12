<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table ='orderitem';
    protected $guarded = ['id'];
    protected $fillable = ['order_id','product_id','qty','price','total_price','status'];
}
