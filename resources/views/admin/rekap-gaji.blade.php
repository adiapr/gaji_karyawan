@extends('admin.pages.master')

@section('title')
    Kelola  Gaji
@endsection

@section('menu1')
    Gaji
@endsection



@section('content')
    @include('sweetalert::alert')

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <h4 class="card-title">Basic</h4> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-sm" data-toggle="modal"  data-target="#modalTambah"><i class="fa fa-plus-circle"></i>  Tambah Data</button>
                                <!-- Modal Input karyawan -->
                                <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">

                                    <div class="modal-content">
                                        <form action="{{ route('gaji.add') }}" method="post">
                                            {{ csrf_field() }}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Data</b></h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Nama</label>
                                                        {{-- <form action="" method="post"> --}}
                                                            <input type="text" required name="nama" class="form-control form-control-sm typeahead" id="smallInput" placeholder="Masukkan data karyawan">
                                                        {{-- </form> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="smallInput">Email</label>
                                                        <input type="email" required name="email" id='email' class="form-control form-control-sm" id="smallInput" placeholder="nama@server.com">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Gaji Pokok</label>
                                                        <input type="number" required name="gp" class="form-control form-control-sm" id="smallInput" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Bonus</label>
                                                        <input type="number" name="bonus" class="form-control form-control-sm" id="smallInput">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Tunjangan</label>
                                                        <input type="number" name="tunjangan" class="form-control form-control-sm" id="smallInput">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Potongan Hadir</label>
                                                        <input type="number" name="pot_hadir" class="form-control form-control-sm" id="smallInput">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="smallInput">Potongan Telat</label>
                                                        <input type="number" name="pot_telat" class="form-control form-control-sm" id="smallInput">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Penyesuaian</label>
                                                        <input type="number" name="penyesuaian" class="form-control form-control-sm" id="smallInput">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Tanggal Merah</label>
                                                        <input type="number" name="tgl_merah" class="form-control form-control-sm" id="smallInput">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Produktivitas</label>
                                                        <input type="number" name="produktivitas" class="form-control form-control-sm" id="smallInput">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                        </div>
                                        </form>
                                    </div>

                                    </div>
                                </div>

                                <button class="btn btn-success btn-sm" data-toggle="modal"  data-target="#importExcel"><i class="fa fa-file-excel"></i>  Import Excel</button>
                                <!-- Modal Inport Excel-->
                                <div class="modal fade" id="importExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import dari excel</h5>
                                        </div>
                                        <form method="post" action="/gaji/import_excel" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label>Upload dari excel</label><br>
                                                    <input type="file" name="file" class="form-control" required="required">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Import Sekarang</button>
                                            </div>
                                        </form>

                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-warning btn-sm  pull-right"><i class="fa fa-download"></i>  Download Format</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{-- notifikasi form validasi --}}
                                @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                                @endif

                                {{-- notifikasi sukses --}}
                                @if ($success = Session::get('sukses'))
                                <div class="alert alert-success mt-4">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $success }}</strong>
                                </div>
                                @endif

                                {{-- notifikasi gagal, data sama --}}
                                @if ($success = Session::get('gagal'))
                                <div class="alert alert-danger mt-4">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong style="color:red">{{ $success }}</strong>
                                </div>
                                @endif

                                {{-- notifikasi jika error data excel --}}
                                @if (isset($errors) && $errors->any())
                                    @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger mt-4" style="color:red;">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {{ $error }}
                                    </div>
                                    @endforeach
                                @endif

                                {{-- memunculkan notfikasi kesalahan setiap baris --}}
                                @if (session()->has('failures'))
                                    <div class="alert alert-danger mt-4" style="color:red;">
                                        <b>Ada kesalahan saat memaasukkan data</b><br><br>
                                        <div class="row" style="border-bottom:solid 1px red">
                                            <div class="col-3"><strong>Baris</strong></div>
                                            <div class="col-3"><strong>Bagian</strong></div>
                                            <div class="col-3"><strong>Alasan</strong></div>
                                            <div class="col-3"><strong>Data</strong></div>
                                        </div>
                                        @foreach (session()->get('failures') as $validation)
                                        <div class="row">
                                            <div class="col-3">{{ $validation->row() }}</div>
                                            <div class="col-3">{{ $validation->attribute() }}</div>
                                            <div class="col-3">
                                                @foreach ($validation->errors() as $e)
                                                    <li>{{ $e }}</li>
                                                @endforeach
                                            </div>
                                            <div class="col-3">{{ $validation->values()[$validation->attribute()] }}</div>
                                        </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Periode</th>
                                        {{-- <th>Gaji Pokok</th>
                                        <th>Tunjangan</th>
                                        <th>Bonus</th>
                                        <th>Potongan Hadir</th>
                                        <th>Potongan Telat</th>
                                        <th>Penyesuaian</th>
                                        <th>Tanggal Merah</th>
                                        <th>Produktivitas</th> --}}
                                        <th>Total Gaji</th>
                                        {{-- <th>Opsi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1
                                    @endphp
                                    @foreach ($gaji as $gajii)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <a href="" data-toggle="modal"  data-target="#editkaryawan{{ $gajii->id }}"><b>{{ $gajii->nama_karyawan }}</b></a>
                                            <div class="modal fade" id="editkaryawan{{ $gajii->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><b>Edit Data Karyawan</b></h5>
                                                    </div>
                                                    <form action="{{ route('gaji.update', $gajii->id) }}" method="post">
                                                        {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Nama</label>
                                                                    <input type="text" required name="nama" id='nama' class="form-control form-control-sm" id="smallInput" value="{{ $gajii->nama_karyawan }}" placeholder="Masukkan data karyawan">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Email</label>
                                                                    <input type="email" required name="email" id='email' class="form-control form-control-sm" id="smallInput" value="{{ $gajii->email }}" placeholder="nama@server.com">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Gaji Pokok</label>
                                                                    <input type="number" required name="gp" class="form-control form-control-sm" id="smallInput" placeholder="" value="{{ $gajii->gp }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Bonus</label>
                                                                    <input type="number" name="bonus" class="form-control form-control-sm" id="smallInput" value="{{ $gajii->bonus }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Tunjangan</label>
                                                                    <input type="number" name="tunjangan" class="form-control form-control-sm" id="smallInput" value="{{ $gajii->tunjangan }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Potongan Hadir</label>
                                                                    <input type="number" name="pot_hadir" class="form-control form-control-sm" id="smallInput" value="{{ $gajii->pot_hadir }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Potongan Telat</label>
                                                                    <input type="number" name="pot_telat" class="form-control form-control-sm" id="smallInput" value="{{ $gajii->pot_telat }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Penyesuaian</label>
                                                                    <input type="number" name="penyesuaian" class="form-control form-control-sm" id="smallInput" value="{{ $gajii->penyesuaian }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Tanggal Merah</label>
                                                                    <input type="number" name="tgl_merah" class="form-control form-control-sm" id="smallInput" value="{{ $gajii->tgl_merah }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="smallInput">Produktivitas</label>
                                                                    <input type="number" name="produktivitas" class="form-control form-control-sm" id="smallInput" value="{{ $gajii->produktivitas }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm btn-pull-left" data-dismiss="modal">Close</button>
                                                        <form action="{{ route('gaji.hapus', $gajii->id) }}" method="post">
                                                                {{-- hapus data --}}
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm" onClick="return confirm('Anda yakin ?')">
                                                                        <i class="fa fa-trash"></i> Hapus
                                                                    </button>
                                                            
                                                            </form>
                                                    
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-tasks"></i> Update Data</button>
                                                    </div>
                                                </form>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $gajii->email }}</td>
                                        <td>{{ $gajii->tanggal }}</td>
                                        {{-- <td>{{ number_format($gajii->gp,0,',','.') }}</td>
                                        <td>{{ number_format($gajii->tunjangan,0,',','.') }}</td>
                                        <td>{{ number_format($gajii->bonus,0,',','.') }}</td>
                                        <td>{{ number_format($gajii->pot_hadir,0,',','.') }}</td>
                                        <td>{{ number_format($gajii->pot_telat,0,',','.') }}</td>
                                        <td>{{ number_format($gajii->penyesuaian,0,',','.') }}</td>
                                        <td>{{ number_format($gajii->tgl_merah,0,',','.') }}</td>
                                        <td>{{ number_format($gajii->produktivitas,0,',','.') }}</td> --}}
                                        <td>Rp.{{ number_format($gajii->total_gaji,0,',','.') }},-</td>
                                        {{-- <td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection
