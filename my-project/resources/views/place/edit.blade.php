@extends('layout')

@section('content')
    <div class="auth-form">
        <h2>Редактирование места: {{ $place->name }}</h2>
        
        <form action="{{ route('places.update', ['place' => $place->id]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name" class="form-label">Название места *</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="{{ old('name', $place->name) }}" required>
            </div>
            
            <div class="form-group">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $place->description) }}</textarea>
            </div>
            
            <div class="form-group">
                <div class="form-check" style="margin-bottom: 10px;">
                    <input type="checkbox" class="form-check-input" id="repair" name="repair" 
                           {{ $place->repair ? 'checked' : '' }}>
                    <label class="form-check-label" for="repair">Ремонт/мойка (специальное место)</label>
                </div>
                
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="work" name="work"
                           {{ $place->work ? 'checked' : '' }}>
                    <label class="form-check-label" for="work">В работе (активно используется)</label>
                </div>
            </div>
            
            <button type="submit" class="btn" style="height: 45px; font-size: 16px;">Сохранить изменения</button>
            <a href="{{ route('places.show', ['place' => $place->id]) }}" class="btn" style="background-color: #6c757d; margin-left: 10px;">
                Отмена
            </a>
        </form>
    </div>
@endsection