@extends('_common._title')

@section('form')
    @if (session('sessionMessage'))
        <div class="alert alert-success" role="alert">
            {{ session('sessionMessage') }}
        </div>
    @endif
    <a href="{{ route('messages') }}">Вернуться к просмотру всех сообщений</a>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <div class="col">Тема <strong>{{ $message->name }}</strong></div>
                <div class="col text-right">№ сообщения: {{ $message->id }}</div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Текст сообщения:</h5>
            <p class="card-text border border-left-0 border-right-0 border-top-0 mb-3 pb-3">{{ $message->message }}</p>

            <div class="text-center">
                @if ($previusID != NULL)
                    <a class="btn btn-info mx-1" href="{{ route('messages.show', $previusID) }}" title="предыдущее сообщение">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                @endif
                    @if($message->user_id == Auth::id())
                <a class="btn btn-info mx-1" href="{{ route('messages.edit', $message->id) }}" title="изменить">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                @include('_common._deleteButtonConfirmation')
                    @else

                    @endif

                @if ($nextID != NULL)
                    <a class="btn btn-info mx-1" href="{{ route('messages.show', $nextID) }}" title="следующее сообщение">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <div class="panel-footer">
                <div class="label label-info">Создано: {{ $message->created_at }}</div>
                <div class="label label-info">
                    @if ($message->created_at != $message->updated_at)
                        Обновлено: {{ $message->updated_at }}
                    @else
                        Изменений не было.
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
