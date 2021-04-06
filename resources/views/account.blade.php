@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Личный кабинет пользователя') }}</div>

                @if(Session::has('info'))
                    <div class="alert alert-success">
                        <button type="button"class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{Session::get('info')}}
                    </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="form-group row">
                            <label for="login_user" class="col-md-4 col-form-label text-md-right">{{ __('Логин') }}</label>

                            <div class="col-md-6">
                                <label class="col-form-label ">{{Auth::user()->login_user}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fio" class="col-md-4 col-form-label text-md-right">{{ __('ФИО') }}</label>

                            <div class="col-md-6">
                                <label class="col-form-label ">{{ Auth::user()->fio }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <label class="col-form-label ">{{Auth::user()->email}}</label>
                            </div>
                        </div>









                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('auth.edit') }}"><button class="btn btn-primary" type="submit">Редактировать профиль</button></a>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
