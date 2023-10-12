<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = ['id'];
    protected $fillable = [
        'category_name',
        'status',
        'title',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function getProductName()
    {
        return $this->hasMany(Product::class,'category_id');
    }
    public function scopeActive($q){
        $q->where('status','=','0');
    }
}
