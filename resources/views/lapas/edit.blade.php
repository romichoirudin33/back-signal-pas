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
                        <form action="{{ route('lapas.update', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Nama Lembaga</label>
                                <input type="text" name="nama" class="form-control" value="{{ $data->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Kepala Lembaga</label>
                                <input type="text" name="kepala" class="form-control" value="{{ $data->kepala }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Kontak</label>
                                <input type="text" name="kontak" class="form-control" value="{{ $data->kontak }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Alamat Lembaga</label>
                                <textarea name="alamat" class="form-control" rows="5">{{ $data->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-success btn-sm " type="submit">
                                    Submit
                                </button>
                                <a href="{{ route('lapas.index') }}" class="btn btn-outline-secondary btn-sm">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
