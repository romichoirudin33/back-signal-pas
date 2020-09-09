@extends('layouts.app')

@section('css')
    <style>
        a:hover {
            text-decoration: none;
        }

        .news-title {
            font-size: medium;
            font-weight: bold;
            text-transform: capitalize;
            margin-top: 10px;
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

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
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
        </div>
    </div>
@endsection
