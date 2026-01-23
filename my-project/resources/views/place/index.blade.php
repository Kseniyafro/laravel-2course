@extends('layout')

@section('content')
    <h1>Список мест хранения</h1>
    
    @auth
        <a href="{{ route('places.create') }}" class="btn" style="margin-bottom: 20px;">
            Создать новое место
        </a>
    @endauth
    
    @if($places->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($places as $place)
                    <tr>
                        <td>
                            <a href="{{ route('places.show', ['place' => $place->id]) }}">
                                {{ $place->name }}
                            </a>
                        </td>
                        <td>
                            {{ $place->description }}
                        </td>
                        
                        <td>
                            @if($place->repair)
                                <span class="badge" style="background-color: #dc3545; color: white;">Ремонт/мойка</span>
                            @endif
                            
                            @if($place->work)
                                <span class="badge" style="background-color: #ffc107; color: black;">В работе</span>
                            @endif
                            
                            @if(!$place->repair && !$place->work)
                                <span class="badge" style="background-color: #28a745; color: white;">Склад</span>
                            @endif
                        </td>
                        
                        <td>
                            <a href="{{ route('places.show', ['place' => $place->id]) }}" class="btn btn-sm">
                                Просмотр
                            </a>
                            
                            @auth
                                <a href="{{ route('places.edit', ['place' => $place->id]) }}" class="btn btn-sm">
                                    Редактировать
                                </a>
                                <form action="{{ route('places.destroy', ['place' => $place->id]) }}" 
                                      method="POST" 
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Вы уверены что хотите удалить это место?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background-color: #dc3545; color: white; height: 45px; font-size: 16px;">
                                        Удалить
                                    </button>
                                </form>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            <p>Мест хранения пока нет. @auth Создайте первое место! @else Войдите чтобы создать место. @endauth</p>
        </div>
    @endif
@endsection