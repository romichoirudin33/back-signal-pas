@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">{{ __('Edit User') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('user.update', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Nama Pengguna</label>
                                <input type="text" class="form-control" value="{{ $data->name }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Email</label>
                                <input type="text" class="form-control" value="{{ $data->email }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Lapas</label>
                                <select name="lapas_id" class="form-control @error('lapas') is-invalid @enderror">
                                    <option value="{{ $data->lapas_id }}">{{ $data->lapas->nama }}</option>
                                    @foreach($lapas as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                    @endforeach
                                </select>
                                @error('lapas')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="is_confirm" class="custom-control-input" id="customSwitch1" {{ $data->is_confirm ? 'checked' : '' }} >
                                    <label class="custom-control-label" for="customSwitch1">Aktifkan User</label>
                                </div>
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
