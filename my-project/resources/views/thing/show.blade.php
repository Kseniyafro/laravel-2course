@extends('layout')

@section('content')
    <div class="main-content">
        <h1>{{ $thing->name }}</h1>
        <div class="thing-info">
            <div style="margin-bottom: 20px;">
                <h3>Описание:</h3>
                <p>{{ $thing->description }}</p>
            </div>
            <div style="margin-bottom: 20px;">
                <h3>Гарантия/срок годности:</h3>
                <p>До {{ $thing->wrnt }}</p>
            </div>
            
            <div style="margin-bottom: 20px;">
                <h3>Хозяин вещи:</h3>
                <p>{{ $thing->owner->name }}</p>
            </div>
            @auth
                @if($thing->master === auth()->id())
                    <div style="margin-top: 30px;">
                        <a href="{{ route('things.edit', ['thing' => $thing->id]) }}" class="btn">
                            Редактировать
                        </a>
                        @if($thing->master === auth()->id())
                            <a href="{{ route('use.create', ['thing' => $thing->id]) }}" class="btn" style="background-color: #17a2b8; color: white; margin-left: 10px;">
                                Передать другому пользователю
                            </a>
                        @endif
                        <form action="{{ route('things.destroy', ['thing' => $thing->id]) }}" 
                              method="POST" 
                              style="display: inline-block; margin-left: 10px;"
                              onsubmit="return confirm('Вы уверены что хотите удалить эту вещь?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background-color: #dc3545; color: white; height: 45.6px; font-size: 16px;">
                                Удалить
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
            <div style="margin-top: 30px;">
                <a href="{{ route('things.index') }}" class="btn" style="background-color: #6c757d;">
                    Вернуться к списку вещей
                </a>
            </div>
        </div>
    </div>
@endsection