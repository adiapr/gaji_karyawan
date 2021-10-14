@extends('admin.pages.master')

@section('title')
    Data Karyawan
@endsection

@section('menu1')
    Karyawan
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
                                        <form action="{{ route('karyawan.add') }}" method="post">
                                            {{ csrf_field() }}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Data</b></h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Nama</label>
                                                        <input type="text" required name="nama" class="form-control form-control-sm" id="smallInput" placeholder="Masukkan data karyawan">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Email</label>
                                                        <input type="text" required name="email" class="form-control form-control-sm" id="smallInput" placeholder="ex. nama@mangrovecorp.id">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Password</label>
                                                        <input type="text" required name="password" class="form-control form-control-sm" id="smallInput" placeholder="Masukkan password">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Telp</label>
                                                        <input type="number" required name="telp" class="form-control form-control-sm" id="smallInput" placeholder="Masukkan telephone/whatsapp">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Divisi</label>
                                                        <select name="divisi" required class="form-control form-control-sm" id="smallInput">
                                                            <option value="">-- Pilih Divisi --</option>
                                                            <option value="Makenliving">MakenLiving</option>
                                                            <option value="Jagoancoding">Jagoancoding</option>
                                                            <option value="Kaos Mangrove">Kaos Mangrove</option>
                                                            <option value="Mangrove Inspiration">Mangrove Inspiration</option>
                                                            <option value="Mangrove Gejayan">Mangrove Gejayan</option>
                                                        </select>
                                                        {{-- <input type="text" name="nama" class="form-control form-control-sm" id="smallInput"> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="smallInput">Bagian</label>
                                                        <input type="text" required name="bagian" class="form-control form-control-sm" id="smallInput">
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
                                        <form method="post" action="karyawan/import_excel" enctype="multipart/form-data">
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
                                        <th>Telp</th>
                                        <th>Divisi</th>
                                        <th>Bagian</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1
                                    @endphp
                                    @foreach ($data_karyawan as $karyawan)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $karyawan->name }}</td>
                                        <td>{{ $karyawan->email }}</td>
                                        <td>{{ $karyawan->telp }}</td>
                                        <td>{{ $karyawan->divisi }}</td>
                                        <td>{{ $karyawan->bagian }}</td>
                                        <td>
                                            <form action="{{ route('karyawan.hapus', $karyawan->id) }}" method="post">
                                            <div style="width:150px">
                                                <a href="" data-toggle="modal"  data-target="#edit{{ $karyawan->id }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-tasks"></i> Edit
                                                </a>
                                                {{-- hapus data --}}
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onClick="return confirm('Anda yakin ?')">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                            </div>
                                            </form>
                                            <div class="modal fade" id="edit{{ $karyawan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><b>Edit Data Karyawan</b></h5>
                                                    </div>
                                                    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="post">
                                                        {{ csrf_field() }}
                                                    <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="smallInput">Nama</label>
                                                                <input type="text" name="nama" class="form-control form-control-sm" id="smallInput" value="{{ $karyawan->name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="smallInput">Email</label>
                                                                <input type="text" name="email" class="form-control form-control-sm" id="smallInput" value="{{ $karyawan->email }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="smallInput">Telp</label>
                                                                <input type="text" name="telp" class="form-control form-control-sm" id="smallInput" value="{{ $karyawan->telp }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="smallInput">Divisi</label>
                                                                <input type="text" name="divisi" class="form-control form-control-sm" id="smallInput" value="{{ $karyawan->divisi }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="smallInput">Bagian</label>
                                                                <input type="text" name="bagian" class="form-control form-control-sm" id="smallInput" value="{{ $karyawan->bagian }}">
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Update Data</button>
                                                    </div>
                                                </form>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
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
