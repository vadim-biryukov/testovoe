@section('messages_section')
    <section class="messages mb-4">

        @foreach ($allMessages as $oneMessage)
            <a name='{{ $oneMessage->id }}'></a>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('messages.show', $oneMessage->id) }}">
                                #{{ $oneMessage->id }} / {{ $oneMessage->name }} / {{ $oneMessage->phone }} / {{ $oneMessage->username }}
                            </a>
                        </div>
                        <div class="col text-right label label-info">{{ $oneMessage->created_at }} <!-- 17:11:11 / 01.02.2001 --></div>
                        </div>
                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-10 col-lg-11 border border-left-0 border-bottom-0 border-top-0">
                            {{ $oneMessage->message }}
                        </div>
                        @if($oneMessage->user_id == Auth::id())
                        <div class="col-2 col-lg-1 text-center">
                            <a class="btn btn-info mb-3" href="{{ route('messages.edit', $oneMessage->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            @include('_common._deleteButtonConfirmation', array('message' => $oneMessage))
                        </div>
                        @else

                        @endif

                    </div>
                </div>
            </div>
        @endforeach

        {{ $allMessages->render() }}

    </section>
@endsection
