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


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
