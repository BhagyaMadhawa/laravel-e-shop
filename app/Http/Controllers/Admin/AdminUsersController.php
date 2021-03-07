<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use Auth;

class AdminUsersController extends Controller
{
    public function index(){
        $users = User::paginate(3);
        //dump($users);
        return view('admin.displayusers', ['users' => $users]);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
