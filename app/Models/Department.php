<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory;
    protected $table ='department';
    protected $guarded = ['id'];
    protected $fillable = ['name','title','semester','status'];
    public function scopeNotDeleted($value)
    {
        $value->where('status','!=','2');
    }
    public function scopeActive($value)
    {
        $value->where('status','=','0');
    }
    public function getStudent()
    {
        return $this->hasMany(Students::class,'department_id');
    }
}
