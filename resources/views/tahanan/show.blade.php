@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h4>Detail Tahanan <a href="{{ route('tahanan.index') }}"
                                           class="btn btn-outline-success btn-sm float-right">Kembali</a></h4>
                            <hr>
                        <table class="table table-bordered table-sm">
                            <tr>
                                <th width="30%">Nama Petugas</th>
                                <td>{{ $data->petugas->name }}</td>
                            </tr>
                            <tr>
                                <th>Nama WBP</th>
                                <td>{{ $data->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <th>Tempat / Tgl Lahir</th>
                                <td>{{ $data->ttl }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $data->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $data->agama }}</td>
                            </tr>
                            <tr>
                                <th>Kewarganegaraan</th>
                                <td>{{ $data->kewarganegaraan }}</td>
                            </tr>
                            <tr>
                                <th>Tindak Pidana</th>
                                <td>{{ $data->tindak_pidana }}</td>
                            </tr>
                            <tr>
                                <th>Hukuman</th>
                                <td>{{ $data->hukuman }}</td>
                            </tr>
                            <tr>
                                <th>Residivis</th>
                                <td>
                                    @if($data->residivis != "tidak")
                                        {{ $data->residivis }} - sebanyak {{ $data->berapa_residivis }}
                                    @else
                                        {{ $data->residivis }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td>{{ $data->score }} lorem</td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>{{ $data->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Diupdate</th>
                                <td>{{ $data->updated_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
