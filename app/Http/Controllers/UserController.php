<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Contracts\Session\Session;

// use Session;
use App\Models\User;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        $user = Auth::user();
        $data_karyawan = User::orderBy('id','desc')
                            ->get();
        $judul = 'karyawan';

        return view('admin.karyawan', compact('judul','data_karyawan'));
    }

    // add 
    public function add(Request $request){
        $karyawan = new User;

        $karyawan->name         = $request->nama;
        $karyawan->email        = $request->email;
        $karyawan->password     = Hash::make($request->password);
        $karyawan->telp         = $request->telp;
        $karyawan->divisi       = $request->divisi;
        $karyawan->bagian       = $request->bagian;
        $karyawan->role         = 'karyawan';

        $karyawan->save();

        toast('Data berhasil ditambahkan','success');
        return redirect('/karyawan');
    }

    // hapus
    public function delete($id){
        $user = User::find($id);
        $user -> delete();

        toast('Data Berhasil Dihapus','warning');
        return redirect('/karyawan');
    }

    // update
    public function perbaharui(Request $request, $id){
        $user = User::find($id);
        $user->name         = $request->nama;
        $user->email        = $request->email;
        $user->telp         = $request->telp;
        $user->divisi       = $request->divisi;
        $user->bagian       = $request->bagian;

        $user->update();
        toast('Data Berhasil Diperbarui','success');
        return redirect('/karyawan')->with('sukses','Selamat! Data karyawan berhasil diperbarui');
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

    // export excel
    public function export(){
        return Excel::download(new UserExport, 'users.xlsx');
    }


}
