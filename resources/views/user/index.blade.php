@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
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
                        <h4>Data User</h4>

                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-sm ">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Konfirmasi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $i)
                                        <tr>
                                            <td>{{ $i->name }}</td>
                                            <td>{{ $i->username }}</td>
                                            <td>{{ $i->email }}</td>
                                            <td class="text-center">
                                                @if($i->is_admin)
                                                    <b class="text-primary">Admin</b>
                                                @else
                                                    <b class="text-success">Sipir</b>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(!$i->is_admin)
                                                    @if($i->is_confirm)
                                                        <button class="btn btn-success btn-sm"
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="Update Status Konfirmasi"
                                                                onclick="if (confirm('Jika belum konfirmasi user tidak bisa login ?')){
                                                                    event.preventDefault();
                                                                    document.getElementById('update-{{ $i->id }}').submit();
                                                                    };">
                                                            Telah dikonfirmasi
                                                        </button>
                                                        <form id="update-{{ $i->id }}"
                                                              action="{{ route('user.update', ['id'=>$i->id]) }}"
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
                                                                    document.getElementById('update-{{ $i->id }}').submit();
                                                                    };">
                                                            Belum dikonfirmasi
                                                        </button>
                                                        <form id="update-{{ $i->id }}"
                                                              action="{{ route('user.update', ['id'=>$i->id]) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="is_confirm" value="1">
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('user.show', ['id'=> $i->id]) }}"
                                                   data-toggle="tooltip"
                                                   title="Lihat detail"
                                                   class="btn btn-outline-primary btn-sm">
                                                    Lihat
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Hapus"
                                                        onclick="if (confirm('Anda yakin akan menghapus data ini ?')){
                                                            event.preventDefault();
                                                            document.getElementById('delete-{{ $i->id }}').submit();
                                                            };">
                                                    Hapus
                                                </button>
                                                <form id="delete-{{ $i->id }}"
                                                      action="{{ route('user.destroy', ['id'=>$i->id]) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
        </div>
    </div>
@endsection
