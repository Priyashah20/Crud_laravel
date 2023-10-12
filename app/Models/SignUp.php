<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//class SignUp extends Authenticatable
class SignUp extends Model
{
    use HasFactory;
    protected $table ='signup';
    protected $guarded = ['id'];
    protected $fillable = ['name','email','phone','password'];
}
