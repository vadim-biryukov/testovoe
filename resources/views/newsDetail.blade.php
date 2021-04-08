@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Новости сайта') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h1>{{$read->header}}</h1>
                        <img width="100%" src="{{ asset('storage/folder/'.$read->img) }}">
                        <p>Создана:{{$read->created_at}}</p>
                        <p>Отредактирована:{{$read->updated_at}}</p>
                        <label>{{$type_title}}</label><br>
                        <label>{{$read->text}}</label>


                        <div class="card-body">
                            <form method="POST" action="{{ route('newsDetail') }}">
                                @csrf

                                <div class="form-group row" style="display: none;">

                                    <div class="col-md-6">
                                        <input id="news_id" type="text"
                                               class="form-control @error('news_id') is-invalid @enderror" name="news_id"
                                               value="{{$read->id}}" required autocomplete="email" autofocus>

                                        @error('news_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <button style="margin: 25px 35%; width:200px; " type="submit" class="btn btn-primary">
                                    {{ __('Мне понравилось') }}
                                </button>
                            </form>
                        </div>

                        <label style="width: 100%; text-align: center;">Новость понравилась:{{$count_like}}</label>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
