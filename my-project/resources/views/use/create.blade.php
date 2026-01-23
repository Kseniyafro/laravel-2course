@extends('layout')

@section('content')
        <h2>Передача вещи: {{ $thing->name }}</h2>
        
        <form action="{{ route('use.store', ['thing' => $thing->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id" class="form-label">Передать пользователю *</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <option value="">Выберите пользователя</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="place_id" class="form-label">Место хранения *</label>
                <select class="form-control" id="place_id" name="place_id" required>
                    <option value="">Выберите место</option>
                    @foreach($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="amount" class="form-label">Количество *</label>
                <input type="number" class="form-control" id="amount" name="amount" 
                       value="1" min="1" required>
            </div>
            
            <button type="submit" class="btn" style="height: 45px; font-size: 16px;">Передать вещь</button>
            <a href="{{ route('things.show', ['thing' => $thing->id]) }}" class="btn" style="background-color: #6c757d; margin-left: 10px;">
                Отмена
            </a>
        </form>
    </div>
@endsection