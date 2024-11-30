<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showListLandlord() {
        $users = User::where('role', 1)->get();
        return view('admin-main.users.listLandlord', compact('users'));
    }

    public function showListRenter() {
        $users = User::where('role', 2)->get();
        return view('admin-main.users.listRenter', compact('users'));
    }

    

}