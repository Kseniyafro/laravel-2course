@extends('layout')

@section('content')
    <div class="auth-form">
        <h2>Создание нового места хранения</h2>
        
        <form action="{{ route('places.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Название места *</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <small class="form-text">Минимум 3 символа</small>
            </div>
            
            <div class="form-group">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                <small class="form-text">Максимум 500 символов</small>
            </div>
            
            <div class="form-group">
                <div class="form-check" style="margin-bottom: 10px;">
                    <input type="checkbox" class="form-check-input" id="repair" name="repair">
                    <label class="form-check-label" for="repair">Ремонт/мойка</label>
                </div>
                
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="work" name="work">
                    <label class="form-check-label" for="work">В работе</label>
                </div>
            </div>
            
            <button type="submit" class="btn" style="height: 45px; font-size: 16px;">Создать место</button>
            <a href="{{ route('places.index') }}" class="btn" style="background-color: #6c757d; margin-left: 10px;">
                Отмена
            </a>
        </form>
    </div>
@endsection