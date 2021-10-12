<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;

// use Session;
use App\Models\User;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $user = Auth::user();
        $data_karyawan = User::All();
        $judul = 'karyawan';

        return view('admin.karyawan', compact('judul','data_karyawan'));
    }

    // hapus
    public function delete($id){
        $user = User::find($id);
        $user -> delete();

        toast('Data Berhasil Dihapus','warning');
        return redirect('/karyawan');
    }

    // import excel
    public function import_excel(Request $request){

        // validasi file excel
        $this->validate($request,[
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // tangkap file excel
        $file = $request-> file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder user dalam public
        $file->move('file_user', $nama_file);

        // imoport data excelnya
        $import = new UserImport;
        $import->import(public_path('/file_user/'.$nama_file));
        // Excel::import(new UserImport, public_path('/file_user/'.$nama_file));

        // Validasi vaiure
        // dd($import->failures());
        if($import->failures()->isNotEmpty()){
            return back()->withFailures($import->failures());
        }

        // kembalikan
        return redirect('/karyawan')->with('sukses','Selamat! Data karyawan berhasil diimport');
    }


}
