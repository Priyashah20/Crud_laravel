<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','price','status','quantity','description','image','category_id'
    ];
    public function getImage()
    {
        return $this->hasMany(Image::class,'product_id');
        //return $this->hasMany(Image::class,'product_id','product.id');
    }
    public function getCategoryName()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
