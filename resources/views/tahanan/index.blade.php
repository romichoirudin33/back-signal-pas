@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                        <h4>Data Tahanan</h4>

                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                @if($data->count() > 0)
                                    <table class="table table-striped table-sm ">
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
                                    <div class="alert alert-success fade show" role="alert">
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
