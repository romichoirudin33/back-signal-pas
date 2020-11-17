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
                    <div class="text-center">
                        <img src="{{ asset('assets/images/icon.png') }}" style="max-width: 100%; height: 200px" class="mt-3 mb-3">
                        <h3 class="mb-4">
                            Sistem Indentifikasi Gangguan Keamanan dan Laporan Pemasyarakatan
                        </h3>
                        Selamat datang, <b>{{ Auth::user()->name }}</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
