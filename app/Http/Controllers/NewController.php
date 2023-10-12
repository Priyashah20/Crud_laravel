<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;

class NewController extends Controller
{
    public function getRoles($admin_id)
    {
        return Admin::find($admin_id)->roles;
    }
    public function getAdmins($role_id)
    {
        return Role::find($role_id)->admins;
    }
}
