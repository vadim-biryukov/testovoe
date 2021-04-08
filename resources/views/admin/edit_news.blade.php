@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Панель администратора сайта') }}</div>
                    @if(Session::has('info'))
                        <div class="alert alert-success">
                            <button type="button"class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{Session::get('info')}}
                        </div>
                    @endif

                    @foreach($news_title as $news)
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.edit_news') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <input style="display: none;" id="header" type="text" name="id" value="{{$news->id}}">
                                <label for="header" class="col-md-4 col-form-label text-md-right">{{ __('Заголовок') }}</label>

                                <div class="col-md-6">
                                    <input id="header" type="text" class="form-control @error('header') is-invalid @enderror" name="header" value="{{ Request::old('header') ?: $news->header }}" required autocomplete="header" autofocus>

                                    @error('header')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Описание новости') }}</label>

                                <div class="col-md-6">
                                    <textarea style='height:150px;' id="text" type="text" class="form-control @error('text') is-invalid @enderror" name="text"  required autocomplete="text" autofocus>{{ Request::old('text') ?: $news->text }}</textarea>

                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('Изображение новости') }}</label>

                                <div class="col-md-6" >
                                    <input type="file" name="img"  style='padding: 3px;'  value={{ Request::old('img') ?: $news->img }} class="form-control @error('img') is-invalid @enderror">
                                    <input style="display: none;"  type="text" name="imgold" value={{ Request::old('img') ?: $news->img }} >
                                    @error('img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sorting" class="col-md-4 col-form-label text-md-right">{{ __('Приоритет новости') }}</label>

                                <div class="col-md-6">
                                    <input id="sorting" type="text" class="form-control @error('sorting') is-invalid @enderror" name="sorting" value="{{ Request::old('sorting') ?: $news->sorting }}" required autocomplete="sorting" autofocus>

                                    @error('sorting')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="news_types_id" class="col-md-4 col-form-label text-md-right">{{ __('Тип новости') }}</label>

                                <div class="col-md-6">
                                    <select id="news_types_id" type="text" class="form-control @error('news_types_id') is-invalid @enderror" name="news_types_id" value="{{ Request::old('sorting') ?: $news->news_types_id }}" required autocomplete="news_types_id" autofocus>
                                        <option disabled>Выберите тип новости</option>

                                        @foreach($type_title as $name)
                                            @if($news->news_types_id==$name->id){
                                            <option selected value="{{$name->id}}">{{$name->title}}</option>
                                        }
                                            @else{
                                            <option value="{{$name->id}}">{{$name->title}}</option>
                                        }
                                            @endif

                                        @endforeach
                                    </select>

                                    @error('news_types_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="day_news"  class="col-md-4 col-form-label text-md-right">{{ __('Новость дня') }}</label>

                                <div class="col-md-6">
                                    @if($news->day_news=='1')<input style="margin-top: 10px;" checked="checked" type="checkbox" value="1" name="day_news" class="form-control @error('day_news') is-invalid @enderror">
                                    @else<input style="margin-top: 10px;" type="checkbox" value="1" name="day_news" class="form-control @error('day_news') is-invalid @enderror">

                                    @endif
                                    @error('day_news')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Редактировать новость') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                        <hr>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection
