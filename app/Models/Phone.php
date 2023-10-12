<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Phone extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone'
    ];
    public function getUser()
    {
       // return $this->belongsTo('App\User','user_id');
        return $this->belongsTo(User::class,'user_id');
    }
}
