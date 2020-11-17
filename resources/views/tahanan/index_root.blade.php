@extends('layouts.app')

@section('css')
    <style>
        th {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-2 mt-md-0">
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
                            Tahanan dan WBP <br>
                            <small class="text-black-50">Seluruh Lapas</small>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <form action="" id="form-search">
                                            <div class="form-group">
                                                <label for="title">Lapas</label>
                                                <select name="lapas_id" class="form-control form-control-sm">
                                                    <option
                                                        value="{{ request('lapas_id') }}">{{ $nama_lapas }}</option>
                                                    @foreach($lapas as $i)
                                                        <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pencarian</label>
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                           class="form-control form-control-sm text-sm-left"
                                                           name="key" id="key" value="{{ request('key') }}"
                                                           placeholder="Masukkan nama tahanan">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary btn-sm"
                                                                type="submit" id="btn-search">
                                                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                                 class="bi bi-search" fill="currentColor"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                      d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                                                <path fill-rule="evenodd"
                                                                      d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        {{ $data->links() }}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-md-right">
                                            <a class="btn btn-outline-secondary" target="_blank"
                                               href="{{ route('tahanan.index', ['export' => 'xls']) }}">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                     class="bi bi-download"
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
                                @if($data->count() > 0)
                                    <table class="table table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th>Nama Petugas</th>
                                            <th>Nama WBP</th>
                                            <th class="text-center">Residivis</th>
                                            <th>Kelas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $i)
                                            <?php $i['petugas']['lapas_id'] != 0 ? $lapas = \App\Models\Lapas::where('id', $i['petugas']['lapas_id'])->first()->nama : $lapas = '-'; ?>
                                            <tr>
                                                <td>
                                                    {{ $i['petugas']['name'] }} <br>
                                                    <small class="text-secondary">{{ $lapas }}</small>
                                                </td>
                                                <td>
                                                    <a href="{{ route('tahanan.show', ['id'=>$i->id]) }}">
                                                        {{ $i->nama_lengkap }}
                                                    </a>
                                                    <br>
                                                    <small>{{ $i->ttl }}</small>
                                                </td>
                                                <td class="text-center">
                                                    <b>{{ $i->residivis }}</b>
                                                    <br>
                                                    <small>{{ $i->jenis_kelamin }}</small>
                                                </td>
                                                <td>{{ $i->score }}</td>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#btn-search').click(function (event) {
                var cari = $('#key').val();
                if (cari.length < 5) {
                    alert('Nama tahanan minimal dimasukkan 5 karakter !!');
                    event.preventDefault();
                    return false;
                } else {
                    event.preventDefault();
                    $('#form-search').submit();
                }
            });
        });
    </script>
@endsection
