@section('form')
    <form action="{{ route("messages.store") }}" method="POST"
          id="id-form_messages">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('sessionMessage'))
            <div class="alert alert-success" role="alert">
                {{ session('sessionMessage') }}
            </div>
        @endif

        @csrf
        {{-- @method('PUT') --}}
        <div class="form-group">
            <label for="name">Тема: *</label>
            <input class="form-control" placeholder="Тема" name="name"
                   value="{{ old('name') }}"  type="text" id="name">
        </div>
        <div class="form-group">
            <label for="email">Номер телефона:</label>
            <input class="form-control" placeholder="+7 (   )     -    -" value="" name="phone" type="increments" id="phone">
        </div>

        <div class="form-group">
            <label for="message">Сообщение: *</label>
            <textarea class="form-control" rows="5" placeholder="Введите сообщение"
                      name="message" cols="50" id="message"{{ old('message') }}></textarea>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Добавить"/>
        </div>
            <div class="text-right"><b>Всего сообщений:</b> <i class="badge">{{ $countOfMessages }}</i></div>

    </form>
@endsection
