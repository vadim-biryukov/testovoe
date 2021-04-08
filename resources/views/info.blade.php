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

                        <form id="like" method="post" action="{{('info')}}">
                            <input type="text" style="display: none" value="{{$id=$read->id}}" name='news_id'>

                            <input class="btn btn-primary" style="margin: 25px 40%;" type="button"
                                   value="Мне понравилось" >

                        </form>


                        <label style="width: 100%; text-align: center;">Новость понравилась:{{$count_like}}</label>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
