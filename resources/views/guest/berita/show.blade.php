@extends('layouts.app')

@section('css')
    <style>
        a:hover {
            text-decoration: none;
        }

        .news-title {
            font-size: x-large;
            font-weight: bold;
            text-transform: capitalize;
            margin-bottom: 0;
        }

        .news-time {
            margin-top: 5px;
            font-size: x-small;
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
            <div class="col-md-7">
                <div class="card shadow-sm mb-5">
                    <div class="card-body">
                        <h5 class="news-title">
                            {{ $data->title }}
                        </h5>
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
                            {{ $data->updated_at }}
                        </p>
                        <img src="{{ asset('assets/image-news/'.$data->image) }}" class="img-thumbnail mb-3" style="width: 100%">

                        <?= $data->content ?>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url()->previous() }}">Lihat berita lainnya .... </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
