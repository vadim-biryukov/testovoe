
@section('messages_section')
    <section class="messages mb-4">
        <div class="text-right"><b>Всего сообщений:</b> <i class="badge">{{ $countOfMessages }}</i></div>
        @foreach ($allMessages as $oneMessage)
            <a name='{{ $oneMessage->id }}'></a>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('messages.show', $oneMessage->id) }}">
                                #{{ $oneMessage->id }} {{ $oneMessage->name }}
                            </a>
                        </div>
                        <div class="col text-right label label-info">{{ $oneMessage->created_at }} {{ $oneMessage->user }}<!-- 17:11:11 / 01.02.2001 --></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-10 col-lg-11 border border-left-0 border-bottom-0 border-top-0">
                            {{ $oneMessage->message }}
                    </div>
                </div>
            </div>
            </div>
        @endforeach

        {{ $allMessages->render() }}

    </section>
@endsection
