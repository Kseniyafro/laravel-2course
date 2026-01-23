@extends('layout')

@section('content')
    <div class="auth-form">
        <h2>Редактирование вещи: {{ $thing->name }}</h2>
        <form action="{{ route('things.update', ['thing' => $thing->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="form-label">Название вещи *</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="{{ old('name', $thing->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $thing->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="wrnt" class="form-label">Гарантия/срок годности</label>
                <input type="date" class="form-control" id="wrnt" name="wrnt" 
                       value="{{ $thing->wrnt }}">
            </div>
            <button type="submit" class="btn" style="height: 45px; font-size: 16px;">Сохранить изменения</button>
            <a href="{{ route('things.show', ['thing' => $thing->id]) }}" class="btn" style="background-color: #6c757d; margin-left: 10px;">
                Отмена
            </a>
        </form>
    </div>
@endsection