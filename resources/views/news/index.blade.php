@extends('layouts.app')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
{{--    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}
    <link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap4.min.css" rel="stylesheet">
    <style>
        a:hover {
            text-decoration: none;
        }

        .news-title {
            font-size: medium;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 0;
        }

        .news-time {
            font-size: smaller;
            color: #979a9e;
        }

        .news-content {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
    </style>
@endsection

@section('jumbotron')
    <div class="jumbotron jumbotron-fluid text-white shadow-lg mb-md-3 pt-5 pb-5" style="background-color: #d81728;">
        <div class="container">
            <h4>Situs Resmi Signal Pas</h4>
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item text-white"><a href="{{ url('/') }}" class="text-white">Berita</a></li>
                <li class="breadcrumb-item active text-white">Kumpulan Berita</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php $auth = Auth::user(); ?>
                        @if($auth->is_admin and $auth->lapas_id == 0)
                            <form action="">
                                <div class="form-group">
                                    <label>Filter</label>
                                    <select name="lapas" class="form-control" onchange="this.form.submit()">
                                        <option value="">Pilih Nama Lapas</option>
                                        @foreach($lapas as $i)
                                            <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        @else
                            <p>
                                Berikut berita yang ada di lapas anda
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
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
                            Berita
                            <div class="float-right">
                                <a href="{{ route('news.create') }}" class="btn btn-outline-info btn-sm">
                                    Tambah
                                </a>
                            </div>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                @if($data->count() > 0)
                                    {{ $data->links() }}
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Detail Berita</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $i)
                                            <tr>
                                                <td width="30%">
                                                    <a href="{{ route('news.show', ['id' => $i->id]) }}">
                                                        <img src="{{ asset('assets/image-news/'.$i->image) }}"
                                                             style="width: 100%">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('news.show', ['id' => $i->id]) }}">
                                                        <h5 class="news-title">{{ $i->title }}</h5>
                                                        <p class="news-time">
                                                            Diperbarui
                                                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                                 class="bi bi-clock" fill="currentColor"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                      d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                                                                <path fill-rule="evenodd"
                                                                      d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                                            </svg>
                                                            {{ $i->updated_at }}
                                                        </p>
                                                    </a>
                                                    <a href="{{ route('news.edit', ['id'=> $i->id]) }}"
                                                       data-toggle="tooltip"
                                                       title="Edit Berita"
                                                       class="btn btn-outline-primary btn-sm">
                                                        Edit
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
                                                          action="{{ route('news.destroy', ['id'=>$i->id]) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
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
{{--    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>--}}
    <script type="text/javascript">
        $(document).ready(function () {
            // $('.table').DataTable({order: false});
        });
    </script>
@endsection
