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
                        <h4>Detail User <a href="{{ route('user.index') }}"
                                           class="btn btn-outline-success btn-sm float-right">Kembali</a></h4>
                        <hr>
                        <table class="table table-bordered table-sm">
                            <tr>
                                <th width="30%">Nama</th>
                                <td>{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $data->username }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($data->is_admin)
                                        <b class="text-primary">Admin</b>
                                    @else
                                        <b class="text-success">Sipir</b>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>{{ $data->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Diupdate</th>
                                <td>{{ $data->updated_at }}</td>
                            </tr>
                            @if(!$data->is_admin)
                                <tr>
                                    <th>Konfirmasi</th>
                                    <td>
                                        @if($data->is_confirm)
                                            <button class="btn btn-success btn-sm"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Update Status Konfirmasi"
                                                    onclick="if (confirm('Jika belum konfirmasi user tidak bisa login ?')){
                                                        event.preventDefault();
                                                        document.getElementById('update-{{ $data->id }}').submit();
                                                        };">
                                                Telah dikonfirmasi
                                            </button>
                                            <form id="update-{{ $data->id }}"
                                                  action="{{ route('user.update', ['id'=>$data->id]) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_confirm" value="0">
                                            </form>
                                        @else
                                            <button class="btn btn-warning btn-sm"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Update Status Konfirmasi"
                                                    onclick="if (confirm('Aktifkan user ?')){
                                                        event.preventDefault();
                                                        document.getElementById('update-{{ $data->id }}').submit();
                                                        };">
                                                Belum dikonfirmasi
                                            </button>
                                            <form id="update-{{ $data->id }}"
                                                  action="{{ route('user.update', ['id'=>$data->id]) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_confirm" value="1">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        </table>

                        @if(!$data->is_admin)
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th width="30%">NIP</th>
                                    <td>{{ $data->username }}</td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td>{{ $data->warden->jabatan }}</td>
                                </tr>
                                <tr>
                                    <th>UPT</th>
                                    <td>{{ $data->warden->upt }}</td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <td>{{ $data->warden->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Skor</th>
                                    <td>{{ $data->warden->score }}</td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
