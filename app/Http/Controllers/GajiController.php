<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;

use Illuminate\Http\Request;
use App\Imports\GajiImport;
use App\Models\Gaji;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;;

class GajiController extends Controller
{
    // index
    public function index(){
        $gaji = Gaji::All();
        return view('admin.rekap-gaji', compact('gaji'));
    }

    // hapus
    public function delete($id){
        $gaji = Gaji::find($id);
        $gaji -> delete();

        toast('Data Berhasil Dihapus','warning');
        return redirect('/admin/kelola-gaji');
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
        $import = new GajiImport;
        $import->import(public_path('/file_user/'.$nama_file));
        // Excel::import(new UserImport, public_path('/file_user/'.$nama_file));

        // Validasi vaiure
        // dd($import->failures());
        if($import->failures()->isNotEmpty()){
            return back()->withFailures($import->failures());
        }

        // kembalikan
        return redirect('/admin/kelola-gaji')->with('sukses','Selamat! Data gaji berhasil diimport');
    }

}
