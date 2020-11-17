@extends('layouts.app')

@section('css')
    <style>
        input[type=file] {
            opacity: 0;
        }

        #top_box {
            width: 100%;
            padding-top: 75%; /* 1:1 Aspect Ratio */
            position: relative;
        }

        #box-image {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            /*width: 100%;*/
            /*height: 200px;*/
            overflow: hidden;
            /*margin: 10px;*/
            /*position: relative;*/
        }

        #box-image img {
            position: absolute;
            left: -100%;
            right: -100%;
            top: -100%;
            bottom: -100%;
            margin: auto;
            width: 100%;
            height: auto;
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

                        <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group" id="top_box">
                                        <div class="border" id="box-image">
                                            <img src="{{ asset('assets/image-news/klik_to_upload.png') }}"
                                                 id="image-preview">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="publish">publish</option>
                                            <option value="draft">draft</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Lapas</label>
                                        <select name="lapas_id" class="form-control" required>
                                            <option value="">Pilih</option>
                                            @foreach($lapas as $i)
                                                <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="title">Judul Berita</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="contents" class="form-control" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-outline-success btn-sm " type="submit">
                                            Submit
                                        </button>
                                        <a href="{{ route('news.index') }}" class="btn btn-outline-secondary btn-sm">
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="foto_caption" name="images"
                                   accept="image/*">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({selector: 'textarea'});

        $('#foto_caption').on('change', function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-preview')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        $("#box-image").on('click', function () {
            $("#foto_caption").click();
        });
    </script>
@endsection
