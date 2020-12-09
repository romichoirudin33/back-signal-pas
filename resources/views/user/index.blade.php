@extends('layouts.app')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                        <h4>
                            User Aplikator
                            <div class="float-right">
                                <div class="dropdown">
                                    <button class="btn btn-outline-info btn-sm dropdown-toggle"
                                            type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-fill"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z"/>
                                        </svg>
                                        Pengaturan
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <h6 class="dropdown-header">Filter</h6>
                                        <a class="dropdown-item" href="{{ route('user.index', ['jenis'=> 'root']) }}">Root</a>
                                        <a class="dropdown-item" href="{{ route('user.index', ['jenis'=> 'admin']) }}">User
                                            Admin</a>
                                        <a class="dropdown-item" href="{{ route('user.index', ['jenis'=> 'sipir']) }}">User
                                            Sipir</a>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header">Export</h6>
                                        <a class="dropdown-item" target="_blank"
                                           href="{{ route('user.index', ['export' => 'xls','jenis' => request('jenis')]) }}">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download"
                                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                <path fill-rule="evenodd"
                                                      d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                            </svg>
                                            Excel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Konfirmasi</th>
                                        <th class="text-center">Score</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $i)
                                        <tr>
                                            <td>
                                                {{ $i->name }}<br>
                                                <small class="text-black-50">{{ $i->email }}</small>
                                            </td>
                                            <td>{{ $i->username }}</td>
                                            <td class="text-center">
                                                @if($i->is_admin)
                                                    <b class="text-primary">Admin</b>
                                                @else
                                                    <b class="text-success">Petugas</b>
                                                @endif
                                                    <br>
                                                    <small class="text-black-50">{{ $i->lapas ? $i->lapas->nama : '-' }}</small>
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
                                                                    document.getElementById('edit-{{ $i->id }}').click();
                                                                    };">
                                                            Telah dikonfirmasi
                                                        </button>
                                                        <a id="edit-{{ $i->id }}" href="{{ route('user.edit', ['id' => $i->id]) }}"></a>
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
                                                                    document.getElementById('edit-{{ $i->id }}').click();
                                                                    };">
                                                            Belum dikonfirmasi
                                                        </button>
                                                        <a id="edit-{{ $i->id }}" href="{{ route('user.edit', ['id' => $i->id]) }}"></a>
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
                                                @if(!$i->is_admin)
                                                    {{ $i->warden['score'] }}
                                                    @if($i->warden['score'] != "")
                                                        <br>
                                                        @if($i->warden['score'] < 45 )
                                                            <span class="badge badge-danger">Rendah</span>
                                                        @elseif($i->warden['score'] <= 135 )
                                                            <span class="badge badge-warning">Sedang</span>
                                                        @else
                                                            <span class="badge badge-success">Tinggi</span>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('user.show', ['id'=> $i->id]) }}"
                                                   data-toggle="tooltip"
                                                   title="Lihat detail"
                                                   class="btn btn-outline-primary btn-sm">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                                        <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Hapus"
                                                        onclick="if (confirm('Anda yakin akan menghapus data ini ?')){
                                                            event.preventDefault();
                                                            document.getElementById('delete-{{ $i->id }}').submit();
                                                            };">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
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

@section('js')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>
@endsection
