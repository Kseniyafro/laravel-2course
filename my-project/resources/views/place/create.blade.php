@extends('layout')

@section('content')
    <div class="auth-form">
        <h2>Создание новой вещи</h2>
        <form action="{{ route('things.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Название вещи *</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <small class="form-text">Минимум 3 символа</small>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                <small class="form-text">Максимум 500 символов</small>
            </div>
            <div class="form-group">
                <label for="wrnt" class="form-label">Гарантия</label>
                <input type="date" class="form-control" id="wrnt" name="wrnt">
            </div>
            <button type="submit" class="btn" style="height: 45px; font-size: 16px;">Создать вещь</button>
            <a href="{{ route('things.index') }}" class="btn" style="background-color: #6c757d; margin-left: 10px;">
                Отмена
            </a>
        </form>
    </div>
@endsection