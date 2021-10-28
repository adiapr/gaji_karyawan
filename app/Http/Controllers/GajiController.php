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
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index(){
        $gaji = Gaji::orderBy('id','desc')
                    ->get();
        return view('admin.rekap-gaji', compact('gaji'));
    }

    // hapus
    public function delete($id){
        $gaji = Gaji::find($id);
        $gaji -> delete();

        toast('Data Berhasil Dihapus','warning');
        return redirect('/admin/kelola-gaji');
    }

    // tambah
    public function add(Request $request){
        $gaji = new Gaji;

        $find = Gaji::where([
            'nama_karyawan' => $request->nama,
            'email'         => $request->email,
            'tanggal'       => $request->tanggal
        ])->first();

        if($find){
            toast('Data gagal ditambahkan','danger');
            return redirect('/admin/kelola-gaji');
        }

        $gaji->nama_karyawan= $request->nama;
        $gaji->gp           = $request->gp;
        $gaji->email        = $request->email;
        $gaji->bonus        = $request->bonus;
        $gaji->tanggal      = date('Y-m-d');
        $gaji->tunjangan    = $request->tunjangan;
        $gaji->pot_hadir    = $request->pot_hadir;
        $gaji->pot_telat    = $request->pot_telat;
        $gaji->penyesuaian  = $request->penyesuaian;
        $gaji->tgl_merah    = $request->tgl_merah;
        $gaji->produktivitas= $request->produktivitas;
        $gaji->total_gaji   = ($request->gp)+($request->bonus)+($request->tunjangan)-($request->pot_hadir)-($request->pot_telat)-($request->penyesuaian)-($request->tgl_merah)-($request->produktivitas);

        $gaji->save();

        toast('Data berhasil ditambahkan','success');
        return redirect('/admin/kelola-gaji');

    }

    // autocomplete
    public function autocomplete(Request $request){
        $search = $request->cari;
        $data_gaji = DB::table('users')
                        ->join('name')
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
