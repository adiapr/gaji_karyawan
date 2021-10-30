<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user   = auth::user();
        $data_karyawan1 = User::groupBy('divisi')
                            ->select('divisi', \DB::raw('count(*) as total'))
                            ->get();
        return view('admin.index', compact('data_karyawan1'));
    }

    public function tables(){
        return view('admin.tables');
    }

    public function dynamictables(){
        return view('admin.datatables');
    }
}
