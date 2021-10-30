<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;

use Illuminate\Http\Request;
use App\Imports\GajiImport;
use App\Models\Gaji;
use App\Models\User;
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

    // update
    public function update(Request $request, $id){
        $gaji = Gaji::find($id);
        $gaji->nama_karyawan    = $request->nama;
        $gaji->email            = $request->email;
        $gaji->bonus            = $request->bonus;
        // $gaji->tanggal          = date('Y-m-d');
        $gaji->tunjangan        = $request->tunjangan;
        $gaji->pot_hadir        = $request->pot_hadir;
        $gaji->pot_telat        = $request->pot_telat;
        $gaji->penyesuaian      = $request->penyesuaian;
        $gaji->tgl_merah        = $request->tgl_merah;
        $gaji->produktivitas    = $request->produktivitas;
        $gaji->total_gaji       = ($request->gp)+($request->bonus)+($request->tunjangan)-($request->pot_hadir)-($request->pot_telat)-($request->penyesuaian)-($request->tgl_merah)-($request->produktivitas);

        $gaji->update();
        toast('Data Berhasil Diperbarui', 'success');
        return redirect('/admin/kelola-gaji');
    }

    // tambah
    public function add(Request $request){
        $gaji = new Gaji;

        // validasi agar periode tidak sama
        $find = Gaji::where([
            ['nama_karyawan',   '=', $request->nama],
            ['email',           '=', $request->email],
            ['tanggal',         '=', date('Y-m-d')]
        ])->first();

         $carinama = User::where([
             ['name',       '=', $request->nama]
         ])->get();

        if($find){
            return redirect('/admin/kelola-gaji')->with('gagal','Maaf! Data gaji gagal ditambahkan (data sudah ada), mohon cek kembali');
        }

        if(!$carinama){
            return redirect('/admin/kelola-gaji')->with('gagal','Maaf! Data gaji gagal karena nama, mohon cek kembali');
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


    // coba membuat search 
    public function search(){
        return view('search');
    }

    // autocomplete 
    public function autocomplete(Request $request){
        $datas = User::select("name")
                        ->where("name","LIKE","%{$request->name}%")
                        ->get();
        
    return response()->json($datas);
    }

}
