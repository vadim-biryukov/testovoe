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

                        {{ __('Добро пожаловать,') }}
                        {{ Auth::user()->fio }}
                        !

                        @foreach($news as $day)
                            @if ($day->day_news==1)
                                    <h1>Новость дня</h1>
                                <a href="/info/{{$day->id}}"><h3>{{$day->header}}</h3></a>
                                <p>Создана:{{$day->created_at}}</p>
                                <p>Отредактирована:{{$day->updated_at}}</p>
                                <a href="/info/{{$day->id}}"><img width="100%"
                                                                  src="{{ asset('storage/folder/'.$day->img) }}"></a>
                                <a href="/info/{{$day->id}}"><input class="btn btn-primary" style="margin: 25px 40%;"
                                                                    type="button"
                                                                    value="Подробнее"></a>

                            @endif
                        @endforeach
                        <h1>Остальные новости</h1>
                        @foreach($news as $news)
                            @if ($news->day_news!=1)
                                <a href="/info/{{$news->id}}"><h3>{{$news->header}}</h3></a>
                                <p>Создана:{{$news->created_at}}</p>
                                <p>Отредактирована:{{$news->updated_at}}</p>
                                <a href="/info/{{$news->id}}"><img width="100%"
                                                                   src="{{ asset('storage/folder/'.$news->img) }}"></a>
                                <a href="/info/{{$news->id}}"><input class="btn btn-primary" style="margin: 25px 40%;"
                                                                     type="button"
                                                                     value="Подробнее"></a>

                            @endif
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
