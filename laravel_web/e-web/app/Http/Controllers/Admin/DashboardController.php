<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class DashboardController extends Controller
{
    public function user()
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }

    public function view_user($id)
    {
        $user = User::find($id);
        return view('admin.user.view', compact('user'));
    }
}
