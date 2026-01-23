@extends('layout')

@section('content')
    <div class="main-content">
        <h1>{{ $place->name }}</h1>
        
        <div style="margin-bottom: 20px;">
            @if($place->repair)
                <span class="badge" style="background-color: #dc3545; color: white; padding: 5px 10px; margin-right: 5px;">
                    Ремонт/мойка
                </span>
            @endif
            
            @if($place->work)
                <span class="badge" style="background-color: #ffc107; color: black; padding: 5px 10px;">
                    В работе
                </span>
            @endif
        </div>
        
        <div style="margin-bottom: 20px;">
            <h3>Описание:</h3>
            <p>{{ $place->description }}</p>
        </div>
        
        @auth
            <div style="margin-top: 30px;">
                <a href="{{ route('places.edit', ['place' => $place->id]) }}" class="btn">
                    Редактировать
                </a>
                
                <form action="{{ route('places.destroy', ['place' => $place->id]) }}" 
                      method="POST" 
                      style="display: inline-block; margin-left: 10px;"
                      onsubmit="return confirm('Вы уверены что хотите удалить это место?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background-color: #dc3545; color: white; height: 45px; font-size: 16px;">
                        Удалить
                    </button>
                </form>
            </div>
        @endauth
        
        <div style="margin-top: 30px;">
            <a href="{{ route('places.index') }}" class="btn" style="background-color: #6c757d;">
                Вернуться к списку мест
            </a>
        </div>
    </div>
@endsection