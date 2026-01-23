@extends('layout')

@section('content')
    <h1>Список вещей</h1>
    @auth
        <a href="{{ route('things.create') }}" class="btn" style="margin-bottom: 20px;">
            Создать новую вещь
        </a>
    @endauth
    
    @if($things->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Гарантия до</th>
                    <th>Хозяин</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($things as $thing)
                    <tr>
                        <td>
                            <a href="{{ route('things.show', ['thing' => $thing->id]) }}">
                                {{ $thing->name }}
                            </a>
                        </td>
                        <td>
                            {{ Str::limit($thing->description, 30) }}
                        </td>
                        
                        <td>
                                {{ $thing->wrnt }}
                        </td>
                        
                        <td>
                            {{ $thing->owner->name }}
                        </td>
                        
                        <td>
                            <a href="{{ route('things.show', ['thing' => $thing->id]) }}" class="btn btn-sm">
                                Просмотр
                            </a>
                            @auth
                                @if($thing->master === auth()->id())
                                    <a href="{{ route('things.edit', ['thing' => $thing->id]) }}" class="btn btn-sm">
                                        Редактировать
                                    </a>
                                    <form action="{{ route('things.destroy', ['thing' => $thing->id]) }}" 
                                          method="POST" 
                                          style="display: inline-block;"
                                          onsubmit="return confirm('Вы уверены что хотите удалить эту вещь?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" style="background-color: #dc3545; color: white; height: 45px; font-size: 16px;">
                                            Удалить
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            <p>Вещей пока нет. @auth Создайте первую вещь! @else Войдите чтобы создать вещь. @endauth</p>
        </div>
    @endif
@endsection