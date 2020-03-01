<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(2);
        return view('user.index', compact('users'));
    }
    
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }
    
}
