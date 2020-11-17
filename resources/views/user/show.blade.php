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
                                <td>
                                    {{ $data->username }}
                                    <div class="float-right">
                                        <button class="btn btn-info btn-sm"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Reset Password ini"
                                                onclick="if (confirm('Password akan di reset menjadi 123456 ?')){
                                                    event.preventDefault();
                                                    document.getElementById('update-{{ $data->id }}').submit();
                                                    };">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bootstrap-reboot" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M1.161 8a6.84 6.84 0 1 0 6.842-6.84.58.58 0 0 1 0-1.16 8 8 0 1 1-6.556 3.412l-.663-.577a.58.58 0 0 1 .227-.997l2.52-.69a.58.58 0 0 1 .728.633l-.332 2.592a.58.58 0 0 1-.956.364l-.643-.56A6.812 6.812 0 0 0 1.16 8zm5.48-.079V5.277h1.57c.881 0 1.416.499 1.416 1.32 0 .84-.504 1.324-1.386 1.324h-1.6zm0 3.75V8.843h1.57l1.498 2.828h1.314L9.377 8.665c.897-.3 1.427-1.106 1.427-2.1 0-1.37-.943-2.246-2.456-2.246H5.5v7.352h1.141z"/>
                                            </svg>
                                            Reset Password
                                        </button>
                                        <form id="update-{{ $data->id }}"
                                              action="{{ route('user.update', ['id'=>$data->id]) }}"
                                              method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="password" value="{{ \Illuminate\Support\Facades\Hash::make('123456') }}">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($data->is_admin and $data->lapas_id == 0)
                                        <b class="text-primary">Root</b>
                                    @elseif($data->is_admin)
                                        <b class="text-secondary">Admin</b>
                                    @else
                                        <b class="text-success">Petugas</b>
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
                                    <td>
                                        {{ $data->warden->score }}
                                        @if($data->warden['score'] != "")
                                            @if($data->warden['score'] < 45 )
                                                <span class="badge badge-danger">Rendah</span>
                                            @elseif($data->warden['score'] <= 135 )
                                                <span class="badge badge-warning">Sedang</span>
                                            @else
                                                <span class="badge badge-success">Tinggi</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
