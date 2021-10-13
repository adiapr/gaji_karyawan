<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $user = Auth::user();
        return view('admin.index', compact('user'));
    }
}
