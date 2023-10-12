<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Phone;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','email','password',
    ];

    public function phone()
    {
        return $this->hasOne(Phone::class);
    }
}
