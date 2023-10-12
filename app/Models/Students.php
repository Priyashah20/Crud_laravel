<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $table ='students';
    protected $guarded = ['id'];
    protected $fillable = ['firstname','lastname','email','mobile','gender','image','status','address','city','semester','hobby','state'
    ];

    public function getDepartment()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
}
