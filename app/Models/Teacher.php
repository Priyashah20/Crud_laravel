<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='teacher';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['firstname','lastname','email','mobile','subject','image','gender','status',
    ];

    public function scopeDeleted($q){
        $q->where('status','!=','2');
    }
     public function scopeActive($q){
        $q->where('status','=','0');
    }

}
