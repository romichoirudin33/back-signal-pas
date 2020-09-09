@extends('layouts.app')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap4.min.css" rel="stylesheet">
    <style>
        th {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
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
                            Data Tahanan dan WBP
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
                                        <h6 class="dropdown-header">Export</h6>
                                        <a class="dropdown-item" target="_blank"
                                           href="{{ route('tahanan.index', ['export' => 'xls']) }}">
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
                                @if($data->count() > 0)
                                    <table class="table table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th>Nama Petugas</th>
                                            <th>Nama WBP</th>
                                            <th>Tempat / Tgl Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Residivis</th>
                                            <th>Kelas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $i)
                                            <tr>
                                                <td>{{ $i->petugas->name }}</td>
                                                <td>
                                                    <a href="{{ route('tahanan.show', ['id'=>$i->id]) }}">
                                                        {{ $i->nama_lengkap }}
                                                    </a>
                                                </td>
                                                <td>{{ $i->ttl }}</td>
                                                <td>{{ $i->jenis_kelamin }}</td>
                                                <td>{{ $i->residivis }}</td>
                                                <td>{{ $i->score }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info fade show" role="alert">
                                        <strong>Info</strong> Data kosong
                                    </div>
                                @endif
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
