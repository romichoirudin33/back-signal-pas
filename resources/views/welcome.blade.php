@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/calendar/simple-calendar.css') }}">
    <style>
        .news-title {
            font-size: medium;
            font-weight: bold;
            text-transform: capitalize;
            /*margin-top: 10px;*/
            margin-bottom: 0;
        }

        .news-time {
            padding-top: 5px;
            font-size: xx-small;
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
    <div class="jumbotron jumbotron-fluid bg-accent text-white shadow-lg mb-md-3 pt-5 pb-5">
        <div class="container">
            <h4>Situs Resmi Signal Pas</h4>
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item text-white"><a href="{{ url('/') }}" class="text-white">Berita</a></li>
                <li class="breadcrumb-item active text-white">Informasi Publik</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('layouts.carousel')
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>
                            Kumpulan Berita
                        </h5>
                        <hr>
                        @if($data->count() > 0)
                            @foreach($data as $i)
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <a href="{{ route('welcome', ['id' => $i->id]) }}">
                                            <img src="{{ asset('assets/image-news/'.$i->image) }}"
                                                 style="width: 100%">
                                        </a>
                                    </div>
                                    <div class="col-8 pl-0">
                                        <a href="{{ route('welcome', ['id' => $i->id]) }}">
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
                                    </div>
                                </div>
                            @endforeach
                            {{ $data->links() }}
                        @else
                            <div class="alert alert-info fade show" role="alert">
                                <strong>Info</strong> belum terdapat berita yang di posting
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-md-0 mt-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>
                            Lembaga Pemasyarakatan
                        </h5>
                        <?php $lapas = \App\Models\Lapas::where('id', '!=', 0)->inRandomOrder()->limit(5)->get() ?>
                        <ul class="list-group list-group-flush">
                            @foreach($lapas as $l)
                            <li class="list-group-item">
                                <a href="" class="text-dark">
                                    {{ $l->nama }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card shadow-sm mt-3 d-none d-md-block">
                    <div class="card-body p-4">
                        <div id="calendar" class="calendar-container"></div>
                    </div>
                </div>
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <iframe width="300" height="300" src="https://widget.jpnn.com/headline/potrait" frameborder="0" allowfullscreen="allowfullscreen" scrolling="no"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="{{ asset('assets/calendar/jquery.simple-calendar.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#calendar").simpleCalendar({
                fixedStartDay: 0, // begin weeks by sunday
                disableEmptyDetails: true,
                events: [

                ],
            });
        });
    </script>
@endsection
